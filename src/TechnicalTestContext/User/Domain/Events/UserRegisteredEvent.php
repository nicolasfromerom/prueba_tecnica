<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Events;

use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Entity\User;

class UserRegisteredEvent {
    private User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getUser(): User {
        return $this->user;
    }
}
