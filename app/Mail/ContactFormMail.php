<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from('contact@ascdisso.com', 'ASC Disso')  // ← Toujours votre adresse
                    ->replyTo($this->data['email'], $this->data['nom'])  // ← Le client en reply-to
                    ->to('contact@ascdisso.com')  // ← Destinataire : vous
                    ->subject('Nouveau message de contact : ' . $this->data['sujet'])
                    ->markdown('emails.contact-form')
                    ->with('data', $this->data);
    }
}