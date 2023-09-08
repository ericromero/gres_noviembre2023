<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewEventMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $emailList;

    public function __construct($event, $emailList)
    {
        $this->event = $event;
        $this->emailList = $emailList;
    }

    public function build()
    {
        return $this->subject('Nuevo evento: ' . $this->event->title)
            ->markdown('emails.new-event')
            ->bcc($this->emailList);
    }
}