<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Exceptions;

class InvalidEmailException extends \DomainException {
    public function __construct(string $message = "Invalid email format", int $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
