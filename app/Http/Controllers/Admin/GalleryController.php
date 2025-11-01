<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ImageHelper;
use App\Services\GalleryService;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    protected $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }
    public function index()
    {
        $q = request()->query('q');
        $query = GalleryImage::query();
        if ($q) {
            $query->where('caption', 'like', '%' . $q . '%');
        }
        $images = $query->latest()->paginate(20)->withQueryString();

        // get distinct captions for dropdown filter; if q is present, limit captions to matching ones
        $captionsQuery = GalleryImage::whereNotNull('caption')->where('caption','<>','');
        if ($q) {
            $captionsQuery->where('caption', 'like', '%' . $q . '%');
        }
        $captions = $captionsQuery->select('caption')->distinct()->orderBy('caption')->pluck('caption');

        // If AJAX request, return rendered partials
        if (request()->ajax() || request()->wantsJson()) {
            $grid = view('admin._gallery_grid', ['images' => $images])->render();
            $pagination = view('admin._gallery_pagination', ['images' => $images])->render();
            return response()->json(['html' => $grid, 'pagination' => $pagination]);
        }

        return view('admin.gallery', compact('images','captions'));
    }

    public function create()
    {
        if (request()->ajax() || request()->wantsJson()) {
            return view('admin._gallery_form');
        }
        return view('admin.gallery_create');
    }

    public function store(Request $request)
    {
        // Support multiple images via input name images[] or single image
        $items = [];
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                if (!$file->isValid()) continue;
                // Compress and save gallery image
                $path = ImageHelper::compressAndSave($file, 'gallery', 2048, 90);
                $items[] = GalleryImage::create(['path' => $path, 'caption' => $request->input('caption')]);
            }
        } else {
            $data = $request->validate([
                'image' => 'required|image|max:10240',  // Increased to 10MB
                'caption' => 'nullable|string',
            ]);
            // Compress and save gallery image
            $path = ImageHelper::compressAndSave($request->file('image'), 'gallery', 2048, 90);
            $items[] = GalleryImage::create(['path' => $path, 'caption' => $data['caption'] ?? null]);
        }

        // Clear gallery cache after upload
        $this->galleryService->clearCache();

        if ($request->ajax() || $request->wantsJson()) {
            $rows = [];
            foreach ($items as $img) {
                $inner = view('admin._gallery_item', ['image' => $img])->render();
                // wrap with checkbox so admin listing can select newly uploaded items
                $wrapped = '<div class="group">';
                $wrapped .= '<label class="block">';
                $wrapped .= '<div class="relative">';
                $wrapped .= '<input type="checkbox" data-bulk value="' . $img->id . '" class="absolute top-2 left-2 z-20 form-checkbox h-4 w-4 text-emerald-600 bg-white rounded">';
                $wrapped .= $inner;
                $wrapped .= '</div></label></div>';
                $rows[] = $wrapped;
            }
            return response()->json(['message' => 'Uploaded', 'rows' => $rows, 'items' => $items], 201);
        }

        return redirect()->route('admin.gallery.index');
    }

    public function destroy(GalleryImage $gallery)
    {
        ImageHelper::delete($gallery->path);
        $id = $gallery->id;
        $gallery->delete();
        
        // Clear gallery cache
        $this->galleryService->clearCache();
        
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['message' => 'Deleted', 'deleted' => [$id]]);
        }
        return redirect()->route('admin.gallery.index');
    }

    public function update(Request $request, GalleryImage $gallery)
    {
        $data = $request->validate(['caption' => 'nullable|string|max:255']);
        $gallery->caption = $data['caption'] ?? null;
        $gallery->save();
        
        // Clear gallery cache
        $this->galleryService->clearCache();
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Updated', 'id' => $gallery->id, 'caption' => $gallery->caption]);
        }
        return redirect()->route('admin.gallery.index');
    }

    /**
     * Download a single gallery image file
     */
    public function download(GalleryImage $gallery)
    {
        $path = $gallery->path;
        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404);
        }
        return Storage::disk('public')->download($path, basename($path));
    }

    /**
     * Bulk download selected images as a zip
     */
    public function bulkDownload(Request $request)
    {
        $ids = $request->input('ids');
        if (is_string($ids)) $ids = array_filter(explode(',', $ids));
        if (!is_array($ids) || count($ids) === 0) return response()->json(['message' => 'No ids provided'], 422);

        $images = GalleryImage::whereIn('id', $ids)->get();
        if ($images->isEmpty()) return response()->json(['message' => 'No files found'], 404);

        $zipName = 'gallery_export_' . time() . '.zip';
        $tempPath = storage_path('app/temp/' . $zipName);
        $tempDir = dirname($tempPath);
        if (!is_dir($tempDir)) {
            if (!@mkdir($tempDir, 0755, true)) {
                $msg = 'Failed to create temp directory for zip.';
                if ($request->wantsJson() || $request->ajax()) return response()->json(['message' => $msg], 500);
                return redirect()->back()->with('error', $msg);
            }
        }

        if (!class_exists('\ZipArchive')) {
            $msg = 'Zip extension is not available on the server.';
            if ($request->wantsJson() || $request->ajax()) return response()->json(['message' => $msg], 500);
            return redirect()->back()->with('error', $msg);
        }

        $zip = new \ZipArchive();
        if ($zip->open($tempPath, \ZipArchive::CREATE) !== true) {
            $msg = 'Failed to create zip file.';
            if ($request->wantsJson() || $request->ajax()) return response()->json(['message' => $msg], 500);
            return redirect()->back()->with('error', $msg);
        }

        foreach ($images as $img) {
                // use storage disk path so Storage::fake() paths are honored in tests
                try {
                    $filePath = Storage::disk('public')->path(ltrim($img->path, '/'));
                } catch (\Throwable $e) {
                    // fallback to conventional storage path
                    $filePath = storage_path('app/public/' . ltrim($img->path, '/'));
                }
                if (file_exists($filePath)) {
                    // try regular addFile first
                    try {
                        $ok = $zip->addFile($filePath, basename($img->path));
                        if ($ok === false) {
                            // fallback: read contents and add from string
                            $content = Storage::disk('public')->get(ltrim($img->path, '/'));
                            $zip->addFromString(basename($img->path), $content);
                        }
                    } catch (\Throwable $e) {
                        try {
                            $content = Storage::disk('public')->get(ltrim($img->path, '/'));
                            $zip->addFromString(basename($img->path), $content);
                        } catch (\Throwable $_) {
                            // ignore this file
                        }
                    }
                } else {
                    // if path doesn't exist on filesystem, try to read from storage and add
                    try {
                        $content = Storage::disk('public')->get(ltrim($img->path, '/'));
                        if ($content !== null) $zip->addFromString(basename($img->path), $content);
                    } catch (\Throwable $_) {}
                }
        }
        try {
            foreach ($images as $img) {
                $filePath = storage_path('app/public/' . ltrim($img->path, '/'));
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($img->path));
                }
            }
            $zip->close();
            if ($request->wantsJson() || $request->ajax()) {
                // Read file contents and return as response so AJAX callers receive the blob
                $content = file_get_contents($tempPath);
                $headers = [
                    'Content-Type' => 'application/zip',
                    'Content-Disposition' => 'attachment; filename="' . $zipName . '"'
                ];
                // remove temp file after reading
                try { @unlink($tempPath); } catch (\Throwable $_) {}
                return response($content, 200, $headers);
            }
            return response()->download($tempPath, $zipName)->deleteFileAfterSend(true);
        } catch (\Throwable $e) {
            // clean up
            try { $zip->close(); } catch (\Throwable $_) {}
            try { if (file_exists($tempPath)) @unlink($tempPath); } catch (\Throwable $_) {}
            $msg = 'Failed to build zip file.';
            if ($request->wantsJson() || $request->ajax()) return response()->json(['message' => $msg], 500);
            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * Bulk delete gallery images by ids
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (is_string($ids)) $ids = array_filter(explode(',', $ids));
        if (!is_array($ids) || count($ids) === 0) {
            if ($request->wantsJson() || $request->ajax()) return response()->json(['message' => 'No ids provided'], 422);
            return redirect()->back()->with('error', 'No images selected');
        }

        $images = GalleryImage::whereIn('id', $ids)->get();
        foreach ($images as $img) {
            try { ImageHelper::delete($img->path); } catch (\Throwable $e) {}
            $img->delete();
        }

        // Clear gallery cache after bulk delete
        $this->galleryService->clearCache();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Deleted', 'deleted' => $images->pluck('id')]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Images deleted');
    }
}
