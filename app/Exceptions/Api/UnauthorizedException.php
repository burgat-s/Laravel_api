<?php

namespace App\Exceptions\Api;

use App\Exceptions\ApiExceptionInterface;

/**
 * Class UnauthorizedException
 *
 * El usuario necesita estar autenticado para acceder al servicio
 *
 * @package App\Exceptions
 */
class UnauthorizedException extends \App\Exceptions\UnauthorizedException implements ApiExceptionInterface
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
