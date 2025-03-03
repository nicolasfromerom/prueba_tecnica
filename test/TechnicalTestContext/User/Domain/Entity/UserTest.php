<?php
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Entity\User;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserCreatedAt;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserEmail;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserId;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserName;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserPassword;

class UserTest extends \PHPUnit\Framework\TestCase
{
    public function testUserCreation()
    {
        $name = new UserName('John Doe');
        $email = new UserEmail('john.doe@example.com');
        $password = new UserPassword('Pass$123');
        $createdAt = new UserCreatedAt('2023-10-10 10:00:00');

        $user = new User($name, $email, $password, $createdAt);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John Doe', $user->getName()->getValue());
        $this->assertEquals('john.doe@example.com', $user->getEmail()->getValue());
        $this->assertEquals($createdAt->getValue(), $user->getCreatedAt()->getValue());
    }
}
