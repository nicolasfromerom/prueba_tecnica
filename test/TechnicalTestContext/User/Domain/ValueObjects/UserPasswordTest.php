<?php

use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Exceptions\WeakPasswordException;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserPassword;

class UserPasswordTest extends \PHPUnit\Framework\TestCase
{
    public function testValidPassword()
    {
        $password = new UserPassword('Valid1@Password');
        $this->assertTrue(password_verify('Valid1@Password', $password->getValue()));
    }

    public function testWeakPassword()
    {
        $this->expectException(WeakPasswordException::class);
        new UserPassword('weakpass');
    }

    public function testPasswordWithoutUppercase()
    {
        $this->expectException(WeakPasswordException::class);
        new UserPassword('valid1@password');
    }

    public function testPasswordWithoutNumber()
    {
        $this->expectException(WeakPasswordException::class);
        new UserPassword('Valid@Password');
    }

    public function testPasswordWithoutSpecialCharacter()
    {
        $this->expectException(WeakPasswordException::class);
        new UserPassword('Valid1Password');
    }
}
