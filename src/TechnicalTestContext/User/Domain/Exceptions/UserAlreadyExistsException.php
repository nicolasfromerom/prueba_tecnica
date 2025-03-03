<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Exceptions;

class UserAlreadyExistsException extends \DomainException {
    public function __construct(string $message = "User already exists", int $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
