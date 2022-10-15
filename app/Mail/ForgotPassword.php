<?php

namespace App\Mail;

use App\Helper\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $nombre;
    private $apellido;
    private $email;
    private $link;
    private $template;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre,$apellido,$email, $token,$template,$urlFront,$path)
    {

        $this->nombre = $nombre;

        $this->apellido = $apellido;

        $this->email = $email;

        $this->template = $template;

        $ruta = Helper::getFrontForgotUrl($urlFront,$token,$path);

        $this->link = $ruta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->template)->with(["nombre"=>$this->nombre,"apellido"=>$this->apellido,"link"=>$this->link]);
    }
}
