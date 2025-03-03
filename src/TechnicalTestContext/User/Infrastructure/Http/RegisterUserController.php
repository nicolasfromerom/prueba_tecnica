<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Infrastructure\Http;

use Exception;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Application\DTO\RegisterUserRequest;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Application\DTO\UserResponseDTO;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Application\UseCase\RegisterUserUseCase;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Exceptions\InvalidEmailException;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Exceptions\UserAlreadyExistsException;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Exceptions\WeakPasswordException;

class RegisterUserController {
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase) {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function register(): void {
        try {

            $data = json_decode(file_get_contents("php://input"), true);
            if (!isset($data['name'], $data['email'], $data['password'])) {
                throw new \InvalidArgumentException("Invalid input");
            }

            $request = new RegisterUserRequest($data['name'], $data['email'], $data['password']);
            $user = $this->registerUserUseCase->execute($request);
            $response = new UserResponseDTO(
                $user->getId()->getValue(),
                $user->getName()->getValue(),
                $user->getEmail()->getValue(),
                $user->getCreatedAt()->getValue()->format('Y-m-d H:i:s')
            );
            echo json_encode($response);
        } catch (InvalidEmailException $e) {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => $e->getMessage()]);
        } catch (UserAlreadyExistsException $e) {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => $e->getMessage()]);
        } catch (WeakPasswordException $e) {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => $e->getMessage()]);
        } catch (\InvalidArgumentException $e) {
            http_response_code(422); // Unprocessable Entity
            echo json_encode(["error" => $e->getMessage()]);
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(["error" => "An unexpected error occurred: ". $e->getMessage()]);
        }
    }
}
