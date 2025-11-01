<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Unit;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_create_unit()
    {
        $response = $this->post(route('admin.units.store'), []);
        $response->assertRedirect('/login');
    }

    public function test_admin_can_create_update_and_delete_unit()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);

        $file = UploadedFile::fake()->image('unit.jpg');

        // create
        $response = $this->actingAs($admin)->post(route('admin.units.store'), [
            'title' => 'Test Unit',
            'type' => 'Rumah',
            'land_area' => 120,
            'price' => 150000000,
            'image' => $file,
        ]);

        $response->assertRedirect(route('admin.units.index'));
        $this->assertDatabaseHas('units', ['title' => 'Test Unit']);
        Storage::disk('public')->assertExists('units/'.$file->hashName());

        $unit = Unit::first();

        // update
        $updateFile = UploadedFile::fake()->image('unit2.jpg');
        $response = $this->actingAs($admin)->put(route('admin.units.update', $unit), [
            'title' => 'Updated Unit',
            'type' => 'Rumah Edited',
            'land_area' => 130,
            'price' => 175000000,
            'image' => $updateFile,
        ]);

        $response->assertRedirect(route('admin.units.index'));
        $this->assertDatabaseHas('units', ['title' => 'Updated Unit']);
        Storage::disk('public')->assertExists('units/'.$updateFile->hashName());

        // delete
        $response = $this->actingAs($admin)->delete(route('admin.units.destroy', $unit));
        $response->assertRedirect(route('admin.units.index'));
        $this->assertDatabaseMissing('units', ['id' => $unit->id]);
    }
}
