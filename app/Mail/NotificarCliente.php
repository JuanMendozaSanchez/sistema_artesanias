<?php

namespace SistemaLaOax\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificarCliente extends Mailable
{
    use Queueable, SerializesModels;
    public $articulos,$total,$fecha;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($articulos,$total,$fecha)
    {
        $this->articulos=$articulos;
        $this->total=$total;
        $this->fecha=$fecha;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notificar');
    }
}
