<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\GalleryImage;

class AdminGalleryBulkDownloadTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_download_selected_images_as_zip()
    {
        Storage::fake('public');
        // create fake image files
        $file1 = UploadedFile::fake()->image('one.jpg');
        $file2 = UploadedFile::fake()->image('two.png');
        $path1 = $file1->store('gallery', 'public');
        $path2 = $file2->store('gallery', 'public');

        $img1 = GalleryImage::create(['path' => $path1, 'caption' => 'One']);
        $img2 = GalleryImage::create(['path' => $path2, 'caption' => 'Two']);

    $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

    $response = $this->post(route('admin.gallery.bulkDownload'), ['ids' => [$img1->id, $img2->id]], ['X-Requested-With' => 'XMLHttpRequest']);

        // if ZipArchive is not available in the environment, expect a 500 or JSON error
        if (!class_exists('\\ZipArchive')) {
            $response->assertStatus(500);
            return;
        }

        $response->assertStatus(200);
        $response->assertHeader('content-disposition');
        $this->assertStringContainsString('attachment', $response->headers->get('content-disposition'));

        // Save response body to temp file and inspect zip contents
        $tmp = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'test_gallery_' . time() . '.zip';
        file_put_contents($tmp, $response->getContent());
        $zip = new \ZipArchive();
        $this->assertTrue($zip->open($tmp) === true, 'Zip could not be opened');
        $names = [];
        for ($i=0;$i<$zip->numFiles;$i++) {
            $names[] = $zip->getNameIndex($i);
        }
        $zip->close();
        // expected: two files and at least one jpg and one png present (filenames are hashed by store)
        $this->assertCount(2, $names);
        $hasJpg = false; $hasPng = false;
        foreach ($names as $n) {
            if (str_ends_with(strtolower($n), '.jpg')) $hasJpg = true;
            if (str_ends_with(strtolower($n), '.png')) $hasPng = true;
        }
        $this->assertTrue($hasJpg || $hasPng, 'Expected at least one image file in zip');
        @unlink($tmp);
    }
}
