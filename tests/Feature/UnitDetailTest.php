<?php

namespace Tests\Feature;

use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnitDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_unit_detail_page_displays_correctly(): void
    {
        // Create a unit
        $unit = Unit::factory()->create([
            'title' => 'Test Unit Villa',
            'type' => 'rumah',
            'land_area' => 150,
            'price' => 1500000000,
            'description' => 'Beautiful villa with garden view',
        ]);

        // Visit the unit detail page
        $response = $this->get(route('landing.units.show', $unit->id));

        // Assert the page loads successfully
        $response->assertStatus(200);

        // Assert key information is displayed
        $response->assertSee('Test Unit Villa');
        $response->assertSeeText('Rumah'); // Capitalized in view
        $response->assertSee('150');
        $response->assertSee('Beautiful villa with garden view');
        $response->assertSee('1,500jt'); // Price in millions with comma
    }

    public function test_unit_detail_page_shows_related_units(): void
    {
        // Create main unit
        $mainUnit = Unit::factory()->create([
            'title' => 'Main Unit',
            'type' => 'rumah',
        ]);

        // Create related units of same type
        $relatedUnit1 = Unit::factory()->create([
            'title' => 'Related Unit 1',
            'type' => 'rumah',
        ]);

        $relatedUnit2 = Unit::factory()->create([
            'title' => 'Related Unit 2',
            'type' => 'rumah',
        ]);

        // Create different type unit (should not appear)
        $differentUnit = Unit::factory()->create([
            'title' => 'Different Type Unit',
            'type' => 'kavling',
        ]);

        // Visit main unit detail page
        $response = $this->get(route('landing.units.show', $mainUnit->id));

        // Assert related units are shown
        $response->assertSee('Related Unit 1');
        $response->assertSee('Related Unit 2');

        // Assert different type unit is NOT shown
        $response->assertDontSee('Different Type Unit');
    }

    public function test_unit_detail_page_returns_404_for_nonexistent_unit(): void
    {
        // Try to visit a unit that doesn't exist
        $response = $this->get(route('landing.units.show', 99999));

        // Assert 404 response
        $response->assertStatus(404);
    }

    public function test_unit_detail_page_has_contact_button(): void
    {
        $unit = Unit::factory()->create();

        $response = $this->get(route('landing.units.show', $unit->id));

        $response->assertStatus(200);
        $response->assertSee('Hubungi Kami');
        $response->assertSee(route('landing.contact'));
    }

    public function test_unit_detail_page_has_whatsapp_button(): void
    {
        $unit = Unit::factory()->create([
            'title' => 'WhatsApp Test Unit',
        ]);

        $response = $this->get(route('landing.units.show', $unit->id));

        $response->assertStatus(200);
        $response->assertSee('WhatsApp');
        $response->assertSee('wa.me');
    }
}
