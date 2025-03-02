<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserCreatedAt;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserEmail;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserId;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserName;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserPassword;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User {
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    private string $id;

    #[ORM\Column(type: "string", length: 100)]
    private string $name;

    #[ORM\Column(type: "string", length: 150, unique: true)]
    private string $email;

    #[ORM\Column(type: "string")]
    private string $password;

    #[ORM\Column(type: "datetime_immutable")]
    private \DateTimeImmutable $createdAt;

    public function __construct(UserId $id, UserName $name, UserEmail $email, UserPassword $password, UserCreatedAt $createdAt) {
        $this->id = $id->getValue();
        $this->name = $name->getValue();
        $this->email = $email->getValue();
        $this->password = $password->getValue();
        $this->createdAt = $createdAt->getValue();
    }

    public function getId(): UserId {
        return new UserId($this->id);
    }

    public function getName(): UserName {
        return new UserName($this->name);
    }

    public function getEmail(): UserEmail {
        return new UserEmail($this->email);
    }

    public function getPassword(): UserPassword {
        return new UserPassword($this->password, true);
    }

    public function getCreatedAt(): UserCreatedAt {
        return new UserCreatedAt($this->createdAt->format('Y-m-d H:i:s'));
    }
}
