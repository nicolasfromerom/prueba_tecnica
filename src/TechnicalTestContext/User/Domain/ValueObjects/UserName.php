<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects;

class UserName {
    private string $value;

    public function __construct(string $value) {
        if (strlen($value) < 3 || strlen($value) > 50) {
            throw new \InvalidArgumentException("User name must be between 3 and 50 characters");
        }
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $value)) {
            throw new \InvalidArgumentException("User name contains invalid characters");
        }
        $this->value = $value;
    }

    public function getValue(): string {
        return $this->value;
    }
}
