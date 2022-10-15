<?php

namespace App\Exceptions;

/**
 * Class MethodNotAllowedException
 *
 * la llamada que se realiza a un metodo no tiene sentido.
 * (ejemplo: usar una peticion GET en un servicio que solo admite POST)
 *
 * @package App\Exceptions
 */
class MethodNotAllowedException extends \Exception
{
    /**
     * MethodNotAllowedException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = '', $code = 405, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->message;
    }
}
