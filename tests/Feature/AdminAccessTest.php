<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_routes()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_admin_user_can_access_admin_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
    }
}
