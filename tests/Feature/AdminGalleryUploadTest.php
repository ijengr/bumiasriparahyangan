<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\GalleryImage;

class AdminGalleryUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_upload_multiple_images_via_ajax()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);

        $files = [
            UploadedFile::fake()->image('a.jpg'),
            UploadedFile::fake()->image('b.jpg'),
        ];

        $response = $this->actingAs($admin)->postJson(route('admin.gallery.store'), [
            'images' => $files,
            'caption' => 'Batch upload'
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['message','rows','items']);

        $data = $response->json();
        $this->assertCount(2, $data['items']);

        foreach ($data['items'] as $item) {
            $this->assertArrayHasKey('path', $item);
            Storage::disk('public')->assertExists($item['path']);
            $this->assertDatabaseHas('gallery_images', ['path' => $item['path']]);
        }
    }
}
