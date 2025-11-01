<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Unit;

class AdminBulkDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_bulk_delete_units_via_ajax()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);

        // create units with images
        $files = [];
        $units = [];
        for ($i = 0; $i < 3; $i++) {
            $file = UploadedFile::fake()->image("unit{$i}.jpg");
            $path = $file->store('units', 'public');
            $files[] = $path;
            $units[] = Unit::create([
                'title' => "Unit {$i}",
                'type' => 'Rumah',
                'price' => 100000000 + ($i * 5000000),
                'image' => $path,
            ]);
        }

        $ids = array_map(function ($u) { return $u->id; }, $units);

        $response = $this->actingAs($admin)->postJson(route('admin.units.bulkDelete'), ['ids' => $ids]);

        $response->assertStatus(200)->assertJsonFragment(['message' => 'Deleted']);

        // records removed
        foreach ($ids as $id) {
            $this->assertDatabaseMissing('units', ['id' => $id]);
        }

        // files removed
        foreach ($files as $f) {
            Storage::disk('public')->assertMissing($f);
        }
    }

    public function test_bulk_delete_returns_error_when_no_ids()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->postJson(route('admin.units.bulkDelete'), []);
        $response->assertStatus(422)->assertJsonFragment(['message' => 'No ids provided']);
    }
}
