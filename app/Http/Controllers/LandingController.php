<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Facility;
use App\Models\GalleryImage;
use App\Models\Message;
use App\Mail\ContactConfirmation;
use App\Services\UnitService;
use App\Services\GalleryService;
use App\Services\FacilityService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    protected $unitService;
    protected $galleryService;
    protected $facilityService;

    public function __construct(
        UnitService $unitService,
        GalleryService $galleryService,
        FacilityService $facilityService
    ) {
        $this->unitService = $unitService;
        $this->galleryService = $galleryService;
        $this->facilityService = $facilityService;
    }

    public function index()
    {
        $units = $this->unitService->getFeaturedUnits(6);
        $facilities = $this->facilityService->getFeaturedFacilities(20);
        $gallery = $this->galleryService->getFeaturedImages(4);

        return view('landing.index', compact('units', 'facilities', 'gallery'));
    }

    public function units()
    {
        $perPage = request()->query('per_page', 6);
        $units = $this->unitService->getAllUnits($perPage);
        return view('landing.units', compact('units'));
    }

    public function showUnit($id)
    {
        $data = $this->unitService->getUnitWithRelated($id);
        
        // Get settings for unit detail page
        $settings = collect();
        if (Schema::hasTable('settings')) {
            $settings = \App\Models\Setting::pluck('value', 'key');
        }
        
        return view('landing.unit-detail', array_merge($data, compact('settings')));
    }

    public function gallery()
    {
        $images = $this->galleryService->getAllImages(12);
        return view('landing.gallery', compact('images'));
    }

    public function facilities()
    {
        $facilities = $this->facilityService->getAllFacilities();
        return view('landing.facilities', compact('facilities'));
    }

    public function contactForm()
    {
        return view('landing.contact');
    }

    public function sendContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'message' => 'required|string',
        ]);

        $message = Message::create($data);

        // Send confirmation email to the sender (best-effort)
        try {
            Mail::to($message->email)->send(new ContactConfirmation($message));
        } catch (\Throwable $e) {
            // don't block the user if mail fails; we could log this in real app
        }

        // redirect back to contact with a flash status (tests expect plain /contact)
        return redirect()->route('landing.contact')->with('status', 'Pesan berhasil dikirim.');
    }
}
