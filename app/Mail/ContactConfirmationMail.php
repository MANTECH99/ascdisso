<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from('contact@ascdisso.com', 'ASC Disso')  // ← Votre adresse
                    ->to($this->data['email'], $this->data['nom'])  // ← Destinataire : le client
                    ->subject('✅ Nous avons bien reçu votre message - ASC Disso')
                    ->markdown('emails.contact-confirmation')
                    ->with('data', $this->data);
    }
}