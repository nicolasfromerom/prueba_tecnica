<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects;

class UserPassword {
    private string $hashedValue;

    public function __construct(string $value) {
        if (strlen($value) < 8) {
            throw new \InvalidArgumentException("Password must be at least 8 characters long");
        }
        $this->hashedValue = password_hash($value, PASSWORD_BCRYPT);
    }

    public function getValue(): string {
        return $this->hashedValue;
    }
}
