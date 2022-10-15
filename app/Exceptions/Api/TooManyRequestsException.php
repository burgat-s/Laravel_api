<?php

namespace App\Exceptions\Api;

use App\Exceptions\ApiExceptionInterface;

/**
 * Class TooManyRequestsException
 *
 * Demasiadas peticiones en poco tiempo.
 *
 * @package App\Exceptions
 */
class TooManyRequestsException extends \App\Exceptions\TooManyRequestsException implements ApiExceptionInterface
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
