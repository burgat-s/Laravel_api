<?php

namespace App\Exceptions;

/**
 * Class UnauthorizedException
 *
 * El usuario necesita estar autenticado para acceder al servicio
 *
 * @package App\Exceptions
 */
class UnauthorizedException extends \Exception
{
    /**
     * UnauthorizedException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = '', $code = 401, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->message;
    }
}
