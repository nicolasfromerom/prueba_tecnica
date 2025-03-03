<?php

use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Exceptions\InvalidEmailException;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserEmail;

class UserEmailTest extends \PHPUnit\Framework\TestCase
{
    public function testValidEmail()
    {
        $email = new UserEmail('valid.email@example.com');
        $this->assertEquals('valid.email@example.com', $email->getValue());
    }

    public function testInvalidEmail()
    {
        $this->expectException(InvalidEmailException::class);
        new UserEmail('invalid-email');
    }
}