<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ImageHelper;
use App\Helpers\CacheHelper;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Storage;

class UnitController extends Controller
{
    public function index()
    {
        $q = request()->query('q');
        $sort = request()->query('sort', 'created_at');
        $direction = request()->query('direction', 'desc');

        $query = Unit::query();
        if (!empty($q)) {
            $query->where(function($r) use ($q) {
                $r->where('title', 'like', "%{$q}%")
                  ->orWhere('type', 'like', "%{$q}%")
                  ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // Allow sorting only on a safe list
        $allowedSorts = ['created_at','price','land_area','floor_area','bedrooms','bathrooms','built_year','title'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
        $direction = strtolower($direction) === 'asc' ? 'asc' : 'desc';

        $units = $query->orderBy($sort, $direction)->paginate(12)->withQueryString();
        return view('admin.units', compact('units', 'q', 'sort', 'direction'));
    }

    public function create()
    {
        // If AJAX, return only the form partial (for modal injection)
        if (request()->ajax() || request()->wantsJson()) {
            return view('admin._unit_form');
        }
        // Otherwise render full page
        return view('admin.units_create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'land_area' => 'nullable|integer',
            'floor_area' => 'nullable|integer',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'parking' => 'nullable|integer',
            'built_year' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|max:10240',  // Increased to 10MB since we compress
            'additional_images.*' => 'nullable|image|max:10240',
            'description' => 'nullable|string',
        ]);

        // Handle main image with compression
        if ($request->hasFile('image')) {
            $data['image'] = ImageHelper::compressAndSave(
                $request->file('image'),
                'units',
                1920,  // Max width for unit images
                85     // Quality
            );
        }
        
        // Handle additional images with compression
        $additionalImages = [];
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $file) {
                $path = ImageHelper::compressAndSave($file, 'units', 1920, 85);
                $additionalImages[] = $path;
            }
        }
        $data['images'] = $additionalImages;

        $unit = Unit::create($data);
        
        // Clear homepage cache
        CacheHelper::clearUnitsCache();

        if ($request->ajax() || $request->wantsJson()) {
            $row = view('admin._unit_row', ['unit' => $unit])->render();
            return response()->json(['message' => 'Created', 'unit' => $unit, 'row' => $row]);
        }

        return redirect()->route('admin.units.index');
    }

    public function edit(Unit $unit)
    {
        // If AJAX (modal), return only the form partial to inject into modal
        if (request()->ajax() || request()->wantsJson()) {
            return view('admin._unit_form', ['unit' => $unit, 'method' => 'PUT']);
        }
        return view('admin.units_edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'land_area' => 'nullable|integer',
            'floor_area' => 'nullable|integer',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'parking' => 'nullable|integer',
            'built_year' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|max:10240',
            'additional_images.*' => 'nullable|image|max:10240',
            'description' => 'nullable|string',
        ]);

        // Handle main image update with compression
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($unit->image) {
                ImageHelper::delete($unit->image);
            }
            $data['image'] = ImageHelper::compressAndSave(
                $request->file('image'),
                'units',
                1920,
                85
            );
        }
        
        // Handle additional images with compression
        $existingImages = $unit->images ?? [];
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $file) {
                $path = ImageHelper::compressAndSave($file, 'units', 1920, 85);
                $existingImages[] = $path;
            }
        }
        $data['images'] = $existingImages;

        $unit->update($data);
        
        // Clear homepage cache
        CacheHelper::clearUnitsCache();

        if ($request->ajax() || $request->wantsJson()) {
            $row = view('admin._unit_row', ['unit' => $unit])->render();
            return response()->json(['message' => 'Updated', 'unit' => $unit, 'row' => $row]);
        }

        return redirect()->route('admin.units.index');
    }

    public function destroy(Unit $unit)
    {
        // Delete main image
        if ($unit->image) {
            ImageHelper::delete($unit->image);
        }
        
        // Delete additional images
        if ($unit->images && is_array($unit->images)) {
            foreach ($unit->images as $imagePath) {
                ImageHelper::delete($imagePath);
            }
        }

        $unit->delete();
        
        // Clear homepage cache
        CacheHelper::clearUnitsCache();
        
        return redirect()->route('admin.units.index');
    }

    /**
     * Bulk delete units by comma-separated ids or array ids
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        // Accept comma-separated string or array
        if (is_string($ids)) {
            $ids = array_filter(explode(',', $ids));
        }
        if (!is_array($ids) || count($ids) === 0) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['message' => 'No ids provided'], 422);
            }
            return redirect()->back()->with('error', 'No units selected');
        }

        $units = Unit::whereIn('id', $ids)->get();
        foreach ($units as $unit) {
            // Delete main image
            if ($unit->image) {
                ImageHelper::delete($unit->image);
            }
            // Delete additional images
            if ($unit->images && is_array($unit->images)) {
                foreach ($unit->images as $imagePath) {
                    ImageHelper::delete($imagePath);
                }
            }
            $unit->delete();
        }
        
        // Clear homepage cache
        CacheHelper::clearUnitsCache();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Deleted', 'deleted' => $units->pluck('id')]);
        }

        return redirect()->route('admin.units.index')->with('success', 'Units deleted');
    }
    
    /**
     * Delete a specific image from unit's additional images
     */
    public function deleteImage(Request $request, Unit $unit)
    {
        $imagePath = $request->input('image_path') ?? $request->input('image');
        
        if (!$imagePath) {
            return response()->json(['success' => false, 'message' => 'Image path required'], 422);
        }
        
        $images = $unit->images ?? [];
        
        // Find and remove the image from array
        $key = array_search($imagePath, $images);
        if ($key !== false) {
            unset($images[$key]);
            $images = array_values($images); // Reindex array
            
            // Delete file from storage
            ImageHelper::delete($imagePath);
            
            // Update unit
            $unit->update(['images' => $images]);
            
            // Clear homepage cache
            CacheHelper::clearUnitsCache();
            
            return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        }
        
        return response()->json(['success' => false, 'message' => 'Image not found'], 404);
    }
}
