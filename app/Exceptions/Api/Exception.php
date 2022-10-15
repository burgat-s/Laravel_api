<?php

namespace App\Exceptions\Api;

use App\Exceptions\ApiExceptionInterface;

class Exception extends \Exception implements ApiExceptionInterface
{
    /**
     * BadRequestException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message = '', $code = 500, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->message;
    }
}
