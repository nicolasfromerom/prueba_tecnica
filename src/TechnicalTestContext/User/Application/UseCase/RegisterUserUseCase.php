<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Application\UseCase;

use Nicolasfromerom\PruebaTecnica\Core\EventDispatcher;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Application\DTO\RegisterUserRequest;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Contracts\UserRepositoryInterface;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Entity\User;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Events\UserRegisteredEvent;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Exceptions\UserAlreadyExistsException;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserCreatedAt;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserEmail;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserName;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserPassword;

class RegisterUserUseCase {
    private UserRepositoryInterface $userRepository;
    private EventDispatcher $eventDispatcher;

    public function __construct(UserRepositoryInterface $userRepository,EventDispatcher $eventDispatcher) {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function execute(RegisterUserRequest $request): User {
        if ($this->userRepository->findByEmail(new UserEmail($request->email))) {
            throw new UserAlreadyExistsException();
        }

        $user = new User(
            new UserName($request->name),
            new UserEmail($request->email),
            new UserPassword($request->password),
            new UserCreatedAt()
        );

        $userCreated = $this->userRepository->save($user);
        $this->eventDispatcher->dispatch(new UserRegisteredEvent($user));

        return $userCreated;

    }
}
