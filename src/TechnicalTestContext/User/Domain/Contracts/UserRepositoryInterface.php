<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Contracts;

use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Entity\User;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserEmail;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserId;

interface UserRepositoryInterface {
    public function save(User $user): User;
    public function findById(UserId $id): ?User;
    public function findByEmail(UserEmail $email): ?User;
    public function delete(UserId $id): void;
}
