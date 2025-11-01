<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use App\Models\GalleryImage;
use App\Models\User;

class AdminGalleryFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_gallery_filter_by_caption_returns_matching_items()
    {
        Storage::fake('public');
        $img1 = GalleryImage::create(['path' => 'gallery/one.jpg', 'caption' => 'Sunset at beach']);
        $img2 = GalleryImage::create(['path' => 'gallery/two.jpg', 'caption' => 'Mountain view']);
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $res = $this->get(route('admin.gallery.index', ['q' => 'beach']));
        $res->assertStatus(200);
        $res->assertSeeText('Sunset at beach');
        $res->assertDontSeeText('Mountain view');
    }
}
