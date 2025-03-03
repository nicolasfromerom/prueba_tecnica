<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects;

use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Exceptions\WeakPasswordException;

class UserPassword {
    private string $hashedValue;

    public function __construct(string $value) {
        if (!$this->isValid($value)) {
            throw new WeakPasswordException();
        }
        $this->hashedValue = password_hash($value, PASSWORD_BCRYPT);
    }

    private function isValid(string $password): bool {
        return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
    }

    public function getValue(): string {
        return $this->hashedValue;
    }
}
