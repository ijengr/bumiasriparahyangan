<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Routes for CMS / Admin Panel. Protected by admin middleware.
*/
use App\Http\Middleware\AdminMiddleware;

Route::middleware(['web', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // Resource controllers for admin CMS
    Route::resource('units', App\Http\Controllers\Admin\UnitController::class);
    Route::post('units/bulk-delete', [App\Http\Controllers\Admin\UnitController::class, 'bulkDelete'])->name('units.bulkDelete');
    Route::delete('units/{unit}/delete-image', [App\Http\Controllers\Admin\UnitController::class, 'deleteImage'])->name('units.deleteImage');
    Route::resource('facilities', App\Http\Controllers\Admin\FacilityController::class);
    // bulk delete for facilities (used by AJAX bulk-delete in admin UI)
    Route::post('facilities/bulk-delete', [App\Http\Controllers\Admin\FacilityController::class, 'bulkDelete'])->name('facilities.bulkDelete');
    Route::resource('gallery', App\Http\Controllers\Admin\GalleryController::class)->except(['show']);
    Route::post('gallery/bulk-delete', [App\Http\Controllers\Admin\GalleryController::class, 'bulkDelete'])->name('gallery.bulkDelete');
        Route::get('gallery/{gallery}/download', [App\Http\Controllers\Admin\GalleryController::class, 'download'])->name('gallery.download');
        Route::post('gallery/bulk-download', [App\Http\Controllers\Admin\GalleryController::class, 'bulkDownload'])->name('gallery.bulkDownload');
    Route::resource('messages', App\Http\Controllers\Admin\MessageController::class)->only(['index','destroy','show']);
    // Bulk delete messages (safe, via POST with CSRF)
    Route::post('messages/bulk-delete', [App\Http\Controllers\Admin\MessageController::class, 'bulkDelete'])->name('messages.bulkDelete');
    // Save per-page preference (AJAX)
    Route::post('messages/per-page', [App\Http\Controllers\Admin\MessageController::class, 'setPerPage'])->name('messages.setPerPage');
    
    // Settings
    Route::get('settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
    Route::post('settings/seed', [App\Http\Controllers\Admin\SettingsController::class, 'seed'])->name('settings.seed');
    Route::post('settings/upload-image', [App\Http\Controllers\Admin\SettingsController::class, 'uploadImage'])->name('settings.upload-image');
    Route::get('settings/open-folder/{folder}', [App\Http\Controllers\Admin\SettingsController::class, 'openFolder'])->name('settings.openFolder');
    
    // Profile
    Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/avatar', [App\Http\Controllers\Admin\ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::delete('profile/avatar', [App\Http\Controllers\Admin\ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
    Route::post('profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');
});
