<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;

class GalleryUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_upload_gallery_image()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);

        $file = UploadedFile::fake()->image('photo.jpg');

        $response = $this->actingAs($admin)->post(route('admin.gallery.store'), [
            'image' => $file,
        ]);

        $response->assertRedirect(route('admin.gallery.index'));
        Storage::disk('public')->assertExists('gallery/'.$file->hashName());
    }
}
