<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Infrastructure\Persistence;

use Doctrine\ORM\EntityManager;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Contracts\UserRepositoryInterface;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Entity\User;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserEmail;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserId;

class DoctrineUserRepository implements UserRepositoryInterface {
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function save(User $user): void {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function findById(UserId $id): ?User {
        return $this->entityManager->find(User::class, $id->getValue());
    }

    public function findByEmail(UserEmail $email): ?User {
        return $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email->getValue()]);
    }

    public function delete(UserId $id): void {
        $user = $this->findById($id);
        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }
    }
}
