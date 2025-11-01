<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class ContactConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Message */
    public $messageModel;

    /**
     * Create a new message instance.
     */
    public function __construct(Message $message)
    {
        $this->messageModel = $message;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Konfirmasi: Pesan Anda ke BumiAsri')
                    ->view('emails.contact_confirmation')
                    ->with(['message' => $this->messageModel]);
    }
}
