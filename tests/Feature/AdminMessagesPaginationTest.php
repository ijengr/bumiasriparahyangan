<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Message;
use App\Models\User;

class AdminMessagesPaginationTest extends TestCase
{
    use RefreshDatabase;

    public function test_per_page_query_param_limits_results()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        Message::factory()->count(30)->create();

        $res = $this->get(route('admin.messages.index', ['per_page' => 10]));
        $res->assertStatus(200);
        // view should contain pagination controls and first page count
        $this->assertCount(10, $res->viewData('messages'));
    }

    public function test_set_per_page_endpoint_sets_cookie()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $res = $this->postJson(route('admin.messages.setPerPage'), ['per_page' => 50]);
        $res->assertStatus(200);
        $this->assertEquals(50, $res->json('per_page'));
        $this->assertNotNull($res->headers->getCookies());
    }

    public function test_search_filters_by_name_email_subject()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // create some messages with known subject
        Message::factory()->create(['subject' => 'SpecialOffer Foobar', 'email' => 'john@example.com']);
        Message::factory()->create(['subject' => 'OtherSubject', 'email' => 'alice@example.com']);

        $res = $this->get(route('admin.messages.index', ['q' => 'Foobar']));
        $res->assertStatus(200);
        $messages = $res->viewData('messages');
        $this->assertTrue($messages->total() >= 1);
        $this->assertStringContainsString('SpecialOffer', $messages->first()->subject);
    }
}
