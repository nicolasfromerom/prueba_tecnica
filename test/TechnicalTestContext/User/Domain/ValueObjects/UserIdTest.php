<?php

use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserId;

class UserIdTest extends \PHPUnit\Framework\TestCase
{
    public function testUserIdCreation(): void {
        $idValue = 12345; // ID numérico
        $userId = new UserId($idValue);

        $this->assertInstanceOf(UserId::class, $userId);
        $this->assertEquals($idValue, $userId->getValue());
    }
}
