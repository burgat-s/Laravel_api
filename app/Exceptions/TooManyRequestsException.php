<?php

namespace App\Exceptions;

/**
 * Class TooManyRequestsException
 *
 * El usuario esta autenticado, pero no tiene los permisos suficientes
 *
 * @package App\Exceptions
 */
class TooManyRequestsException extends \Exception
{
    /**
     * TooManyRequestsException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = '', $code = 429, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->message;
    }
}
