<?php
namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Application\DTO;

class UserResponseDTO {
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public string $createdAt;

    public function __construct(int $id, string $name, string $email, string $password, string $createdAt) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
    }
}
