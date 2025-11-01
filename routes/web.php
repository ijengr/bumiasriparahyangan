<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
// Dashboard route expected by Breeze tests
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::view('/about', 'landing.about')->name('landing.about');
Route::get('/facilities', [LandingController::class, 'facilities'])->name('landing.facilities');
Route::get('/units', [LandingController::class, 'units'])->name('landing.units');
Route::get('/units/{id}', [LandingController::class, 'showUnit'])->name('landing.units.show');
Route::get('/gallery', [LandingController::class, 'gallery'])->name('landing.gallery');
Route::get('/contact', [LandingController::class, 'contactForm'])->name('landing.contact');
Route::post('/contact', [LandingController::class, 'sendContact'])
    ->middleware('throttle:5,1') // Max 5 requests per minute
    ->name('landing.contact.send');

/* Auth (Breeze) */
require __DIR__.'/auth.php';

// Load admin routes
if (file_exists(__DIR__.'/admin.php')) {
    require __DIR__.'/admin.php';
}

// quick storage health-check (dev only)
Route::get('/storage-health', function () {
    $path = storage_path('app/public');
    $exists = is_dir($path);
    $files = [];
    if ($exists) {
        $files = array_slice(scandir($path), 0, 10);
    }
    return response()->json(['exists' => $exists, 'path' => $path, 'files' => $files]);
});

// Profile routes (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});
