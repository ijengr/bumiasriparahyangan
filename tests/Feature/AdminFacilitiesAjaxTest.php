<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Facility;

class AdminFacilitiesAjaxTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_delete_facility_via_ajax()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Create via AJAX
        $payload = ['name' => 'Kolam Renang', 'description' => 'Kolam renang ukuran besar'];
        $response = $this->actingAs($admin)->postJson(route('admin.facilities.store'), $payload);
        $response->assertStatus(201)->assertJsonStructure(['message', 'row', 'unit']);
        $this->assertDatabaseHas('facilities', ['name' => 'Kolam Renang']);

        $facilityId = $response->json('unit.id');

        // Update via AJAX
        $update = ['name' => 'Kolam Renang - Updated', 'description' => 'Deskripsi baru'];
        $res2 = $this->actingAs($admin)->putJson(route('admin.facilities.update', $facilityId), $update);
        $res2->assertStatus(200)->assertJsonFragment(['message' => 'Fasilitas diperbarui']);
        $this->assertDatabaseHas('facilities', ['id' => $facilityId, 'name' => 'Kolam Renang - Updated']);

        // Delete via AJAX
        $res3 = $this->actingAs($admin)->deleteJson(route('admin.facilities.destroy', $facilityId));
        $res3->assertStatus(200)->assertJsonFragment(['message' => 'Fasilitas dihapus']);
        $this->assertDatabaseMissing('facilities', ['id' => $facilityId]);
    }

    public function test_create_and_edit_endpoints_return_form_partial_for_ajax()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Create form (GET) should return just the form partial when requested via AJAX
        $res = $this->actingAs($admin)->get(route('admin.facilities.create'), ['X-Requested-With' => 'XMLHttpRequest']);
        $res->assertStatus(200);
        $html = $res->getContent();
        $this->assertStringContainsString('space-y-6 bg-white p-6 rounded-2xl', $html);
        // should not contain the admin sidebar title
        $this->assertStringNotContainsString('Dashboard', $html);

        // create a facility and request edit form via AJAX
        $facility = Facility::create(['name' => 'CheckEdit', 'description' => 'x']);
        $res2 = $this->actingAs($admin)->get(route('admin.facilities.edit', $facility), ['X-Requested-With' => 'XMLHttpRequest']);
        $res2->assertStatus(200);
        $html2 = $res2->getContent();
        $this->assertStringContainsString('space-y-6 bg-white p-6 rounded-2xl', $html2);
        $this->assertStringNotContainsString('Dashboard', $html2);
    }

    public function test_admin_can_bulk_delete_facilities_via_ajax()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $f1 = Facility::create(['name' => 'F1', 'description' => 'a']);
        $f2 = Facility::create(['name' => 'F2', 'description' => 'b']);

        $ids = [$f1->id, $f2->id];
        $res = $this->actingAs($admin)->postJson(route('admin.facilities.bulkDelete'), ['ids' => $ids]);
        $res->assertStatus(200)->assertJsonFragment(['message' => 'Deleted']);

        $this->assertDatabaseMissing('facilities', ['id' => $f1->id]);
        $this->assertDatabaseMissing('facilities', ['id' => $f2->id]);
    }
}
