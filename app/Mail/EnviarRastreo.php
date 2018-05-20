<?php

namespace SistemaLaOax\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarRastreo extends Mailable
{
    use Queueable, SerializesModels;
    public $num;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($num)
    {
        $this->num=$num;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.rastreo');
    }
}
