<?php

use Nicolasfromerom\PruebaTecnica\Core\EventDispatcher;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Application\DTO\RegisterUserRequest;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Application\UseCase\RegisterUserUseCase;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Contracts\UserRepositoryInterface;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Entity\User;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Exceptions\UserAlreadyExistsException;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserCreatedAt;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserEmail;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserName;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserPassword;

class RegisterUserUseCaseTest extends \PHPUnit\Framework\TestCase
{
    public function testExecuteSuccessfully()
    {
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $eventDispatcher = $this->createMock(EventDispatcher::class);

        $userRepository->method('findByEmail')->willReturn(null);
        $userRepository->method('save')->willReturn(new User(
            new UserName('John Doe'),
            new UserEmail('john.doe@example.com'),
            new UserPassword('Valid1@Password'),
            new UserCreatedAt()
        ));

        $eventDispatcher->expects($this->once())->method('dispatch');

        $useCase = new RegisterUserUseCase($userRepository, $eventDispatcher);

        $request = new RegisterUserRequest('John Doe', 'john.doe@example.com', 'Valid1@Password');
        $user = $useCase->execute($request);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John Doe', $user->getName()->getValue());
        $this->assertEquals('john.doe@example.com', $user->getEmail()->getValue());
    }

    public function testExecuteUserAlreadyExists()
    {
        $this->expectException(UserAlreadyExistsException::class);

        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $eventDispatcher = $this->createMock(EventDispatcher::class);

        $userRepository->method('findByEmail')->willReturn(new User(
            new UserName('John Doe'),
            new UserEmail('john.doe@example.com'),
            new UserPassword('Valid1@Password'),
            new UserCreatedAt()
        ));

        $useCase = new RegisterUserUseCase($userRepository, $eventDispatcher);

        $request = new RegisterUserRequest('John Doe', 'john.doe@example.com', 'Valid1@Password');
        $useCase->execute($request);
    }
}
