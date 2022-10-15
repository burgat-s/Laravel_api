<?php

namespace App\Exceptions;

/**
 * Class ForbiddenException
 *
 * El usuario esta autenticado, pero no tiene los permisos suficientes
 *
 * @package App\Exceptions
 */
class ForbiddenException extends \Exception
{
    /**
     * ForbiddenException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = '', $code = 403, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->message;
    }
}
