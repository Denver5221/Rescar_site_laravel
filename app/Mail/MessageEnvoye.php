<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageEnvoye extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = (object) $message;
        // dd($message);

    }

    public function build()
    {
        $subject = $this->message->sujet ?? '';


        $mail = $this->subject($subject)
                ->markdown('pages.messagerie.message-envoye')
                ->with('message', $this->message);

                $filePath = storage_path('app/' . $this->message->fichier);
                // dd($filePath);
                if (file_exists($filePath)) {
                    $mail->attach($filePath);
                }

        return $mail;
    }
}

