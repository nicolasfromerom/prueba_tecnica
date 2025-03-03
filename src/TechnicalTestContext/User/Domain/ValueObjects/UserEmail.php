<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects;

use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Exceptions\InvalidEmailException;

class UserEmail {
    private string $value;

    public function __construct(string $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        $this->value = $value;
    }

    public function getValue(): string {
        return $this->value;
    }
}
