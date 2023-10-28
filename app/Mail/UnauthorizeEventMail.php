<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;

class UnauthorizeEventMail extends Mailable
{
    use Queueable, SerializesModels;
    public $event;
    public $reason;
    public $emailList;

    /**
     * Create a new message instance.
     */
    public function __construct($event,$reason,$emailList)
    {
        $this->event = $event;
        $this->reason = $reason;
        $this->emailList=$emailList;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reserva de espacio no autorizada',
        );
    }

    public function build()
    {
        return $this->subject('Reserva de espacio no autorizada para el evento: ' . $this->event->title)
            ->markdown('emails.unauthorize-event')
            ->cc($this->emailList);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
