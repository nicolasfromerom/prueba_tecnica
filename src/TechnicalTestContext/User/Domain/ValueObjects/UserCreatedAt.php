<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects;

class UserCreatedAt {
    private \DateTimeImmutable $value;

    public function __construct(?string $value = null) {
        $this->value = $value ? new \DateTimeImmutable($value) : new \DateTimeImmutable();
    }

    public function getValue(): \DateTimeImmutable {
        return $this->value;
    }
}
