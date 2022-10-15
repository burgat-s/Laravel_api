<?php

namespace App\Exceptions\Api;

use App\Exceptions\ApiExceptionInterface;

/**
 * Class BadRequestException
 *
 * Se usa para retornar errores comunes, que no coinciden con errores de otro tipo
 *
 * @package App\Exceptions
 */
class BadRequestException extends \App\Exceptions\BadRequestException implements ApiExceptionInterface
{
    /**
     * BadRequestException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message = '', $code = 400, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->message;
    }
}
