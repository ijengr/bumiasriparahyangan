<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FacilityService;
use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    protected $facilityService;

    public function __construct(FacilityService $facilityService)
    {
        $this->facilityService = $facilityService;
    }
    public function index()
    {
        $items = Facility::latest()->paginate(20);
        return view('admin.facilities', compact('items'));
    }

    public function create()
    {
        if (request()->ajax() || request()->wantsJson()) {
            return view('admin._facility_form');
        }
        return view('admin.facilities_create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $facility = Facility::create($data);
        
        // Clear facility cache
        $this->facilityService->clearCache();

        if ($request->wantsJson() || $request->ajax()) {
            // render a row partial
            $row = view('admin._facility_row', ['facility' => $facility, 'index' => 0])->render();
            return response()->json(['message' => 'Fasilitas dibuat', 'row' => $row, 'unit' => $facility], 201);
        }

        return redirect()->route('admin.facilities.index');
    }

    public function edit(Facility $facility)
    {
        if (request()->ajax() || request()->wantsJson()) {
            return view('admin._facility_form', ['facility' => $facility, 'method' => 'PUT']);
        }
        return view('admin.facilities_edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $facility->update($data);
        
        // Clear facility cache
        $this->facilityService->clearCache();

        if ($request->wantsJson() || $request->ajax()) {
            $row = view('admin._facility_row', ['facility' => $facility, 'index' => 0])->render();
            return response()->json(['message' => 'Fasilitas diperbarui', 'row' => $row, 'unit' => $facility]);
        }

        return redirect()->route('admin.facilities.index');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();
        
        // Clear facility cache
        $this->facilityService->clearCache();
        
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['message' => 'Fasilitas dihapus', 'deleted' => [$facility->id]]);
        }
        return redirect()->route('admin.facilities.index');
    }

    /**
     * Bulk delete facilities by ids (AJAX)
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (is_string($ids)) $ids = array_filter(explode(',', $ids));
        if (!is_array($ids) || count($ids) === 0) {
            if ($request->wantsJson() || $request->ajax()) return response()->json(['message' => 'No ids provided'], 422);
            return redirect()->back()->with('error', 'No facilities selected');
        }

        $facilities = Facility::whereIn('id', $ids)->get();
        foreach ($facilities as $f) {
            // attempt to delete any stored image
            if ($f->image) {
                try { \Illuminate\Support\Facades\Storage::disk('public')->delete($f->image); } catch (\Throwable $e) {}
            }
            $f->delete();
        }

        // Clear facility cache after bulk delete
        $this->facilityService->clearCache();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Deleted', 'deleted' => $facilities->pluck('id')]);
        }

        return redirect()->route('admin.facilities.index')->with('success', 'Facilities deleted');
    }
}
