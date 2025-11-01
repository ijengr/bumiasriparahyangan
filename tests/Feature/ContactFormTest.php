<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactConfirmation;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_stores_message()
    {
        Mail::fake();

        $response = $this->post(route('landing.contact.send'), [
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'subject' => 'Pertanyaan unit',
            'phone' => '+6281234567890',
            'message' => 'Saya tertarik dengan unit.'
        ]);

        $response->assertRedirect(route('landing.contact'));

        $this->assertDatabaseHas('messages', ['email' => 'budi@example.com', 'subject' => 'Pertanyaan unit', 'phone' => '+6281234567890']);

        Mail::assertSent(ContactConfirmation::class, function ($mail) {
            return $mail->hasTo('budi@example.com');
        });
    }
}
