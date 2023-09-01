<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestSpaceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $space;

    public function __construct($event, $space)
    {
        $this->event = $event;
        $this->space = $space;
    }

    public function build()
    {
        return $this->subject('Solicitud de espacio')
            ->markdown('emails.space_requested');
    }
}
