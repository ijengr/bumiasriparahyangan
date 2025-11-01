<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_loads_and_contains_chart_data()
    {
        // create admin user
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertStatus(200)
            ->assertSee('Pesan per bulan')
            // ensure months JSON and counts JSON are present in page (rendered by blade)
            ->assertSee('months')
            ->assertSee('counts');
    }
}
