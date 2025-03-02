<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects;

class UserId {
    private int $value;

    public function __construct(int $value) {
        $this->value = $value;
    }

    public function getValue(): int {
        return $this->value;
    }
}
