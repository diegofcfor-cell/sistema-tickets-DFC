<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeUserMail extends Mailable implements ShouldQueue // 2. Implementar ShouldQueue
{
	use Queueable, SerializesModels;
	
	public array $userData;
	
	// Número de reintentos en caso de error en el SMTP
	public $tries = 3;

	public function __construct(array $userData)
	{
	    $this->userData = $userData;
	}

	public function build(): self
	{
	    return $this->subject('¡Bienvenido a nuestra plataforma!')
		->view('emails.welcome')
		->with(['nombre' => $this->userData['name']]);
	}
}
