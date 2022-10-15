<?php

namespace App\Exceptions;

/**
 * Class NotFoundException
 *
 * El recurso que solicita la peticion no existe
 *
 * @package App\Exceptions
 */
class NotFoundException extends \Exception
{
    /**
     * NotFoundException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = '', $code = 404, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->message;
    }
}
