<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDeleteUnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_unit()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $unit = Unit::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.units.destroy', $unit));

        $response->assertRedirect(route('admin.units.index'));
        $this->assertDatabaseMissing('units', ['id' => $unit->id]);
    }
}
