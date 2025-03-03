<?php

use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserName;

class UserNameTest extends \PHPUnit\Framework\TestCase
{
    public function testValidUserName()
    {
        $userName = new UserName('John Doe');
        $this->assertEquals('John Doe', $userName->getValue());
    }

    public function testUserNameTooShort()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('User name must be between 3 and 50 characters');
        new UserName('Jo');
    }

    public function testUserNameTooLong()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('User name must be between 3 and 50 characters');
        new UserName(str_repeat('a', 51));
    }

    public function testUserNameWithInvalidCharacters()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('User name contains invalid characters');
        new UserName('John Doe123');
    }
}

