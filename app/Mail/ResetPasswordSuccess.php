<?php

namespace App\Mail;

use App\Helper\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordSuccess extends Mailable
{
    use Queueable, SerializesModels;

    private $nombre;
    private $apellido;
    private $email;
    private $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre, $apellido, $email, $template, $urlFront)
    {
        $this->nombre = $nombre;

        $this->apellido = $apellido;

        $this->email = $email;

        $this->to = $email;

        $this->template = $template;

        $ruta = Helper::getFrontLoginUrl($urlFront);

        $this->link = $ruta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->template)->with(["nombre"=>$this->nombre,"apellido"=>$this->apellido, "link" =>$this->link]);
    }
}
