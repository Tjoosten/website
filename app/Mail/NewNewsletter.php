<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The variable for the newly created newsletter insert.
     *
     * @var array
     */
    public $insert;

    /**
     * Create a new message instance.
     *
     * @param array $insert The newly inserted newsletter email.
     */
    public function __construct($insert)
    {
        $this->insert = $insert;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new-newsletter')
            ->from('contact@st-joris-turnhout.be', 'Scouts en Gidsen - Sint-Joris')
            ->subject('Registratie nieuwsbrief.');
    }
}
