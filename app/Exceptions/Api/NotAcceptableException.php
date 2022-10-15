<?php

namespace App\Exceptions\Api;

use App\Exceptions\ApiExceptionInterface;

/**
 * Class NotAcceptableException
 *
 * El header "Accept-*" de la peticion no coincide con el de la API
 * (ejemplo: solicitar una respuesta en formato XML y la API solo devuelve JSON)
 *
 * @package App\Exceptions
 */
class NotAcceptableException extends \App\Exceptions\NotAcceptableException implements ApiExceptionInterface
{
    /**
     * NotAcceptableException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = '', $code = 406, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->message;
    }
}
