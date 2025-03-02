<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Infrastructure\Http;

use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Application\DTO\RegisterUserRequest;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Application\UseCase\RegisterUserUseCase;

class RegisterUserController {
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase) {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function register(): void {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['name'], $data['email'], $data['password'])) {
            echo json_encode(["error" => "Invalid input"]);
            return;
        }

        try {
            $request = new RegisterUserRequest($data['name'], $data['email'], $data['password']);
            $this->registerUserUseCase->execute($request);

            echo json_encode($request);
        } catch (\Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}
