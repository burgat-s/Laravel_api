<?php

namespace App\Exceptions\Api;

use App\Exceptions\ApiExceptionInterface;

/**
 * Class NotFoundException
 *
 * El recurso que solicita la peticion no existe
 *
 * @package App\Exceptions
 */
class NotFoundException extends \App\Exceptions\NotFoundException implements ApiExceptionInterface
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
