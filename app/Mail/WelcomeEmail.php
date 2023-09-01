<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $email;

    public function __construct($email, $password)
    {
        $this->password = $password;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Bienvenido(a) a la Cartelera - Psicología')
            ->markdown('emails.welcome');
    }
}
