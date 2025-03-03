<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects;

use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Exceptions\WeakPasswordException;

class UserPassword {
    private string $value;

    public function __construct(string $value) {
        if (!$this->isValid($value)) {
            throw new WeakPasswordException();
        }
        $this->value = password_hash($value, PASSWORD_BCRYPT);
    }

    public function isValid(string $value): bool {
        return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $value);
    }

    public function getValue(): string {
        return $this->value;
    }
}
