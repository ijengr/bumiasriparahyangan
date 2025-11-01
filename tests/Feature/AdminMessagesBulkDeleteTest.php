<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Message;
use App\Models\User;

class AdminMessagesBulkDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_bulk_delete_requires_post_and_deletes_only_read_messages()
    {
    // authenticate as admin
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin);

    // create messages: 3 read, 2 unread
        Message::factory()->count(3)->create(['is_read' => true]);
        Message::factory()->count(2)->create(['is_read' => false]);

        $this->assertEquals(5, Message::count());

    // GET should not delete (route is POST) -> may return 404 or 405 depending on environment
    $response = $this->get(route('admin.messages.bulkDelete'));
    $this->assertTrue(in_array($response->getStatusCode(), [404, 405]));
        $this->assertEquals(5, Message::count());

        // POST should delete only read messages
        $response = $this->post(route('admin.messages.bulkDelete'));
        $response->assertRedirect(route('admin.messages.index'));

        $this->assertEquals(2, Message::count());
        $this->assertEquals(2, Message::where('is_read', false)->count());
    }
}
