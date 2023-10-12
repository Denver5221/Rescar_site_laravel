<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $newsletter;

    public function __construct($newsletter)
    {
        $this->newsletter = $newsletter;
    }

    public function build()
    {
        $subject = $this->newsletter->sujet;

        return $this->view('emails.newsletter-envoye')
            ->subject($subject)
            ->attach($this->newsletter->fichier);
    }
}
