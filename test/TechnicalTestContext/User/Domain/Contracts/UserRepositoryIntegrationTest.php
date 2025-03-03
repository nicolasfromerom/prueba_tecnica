<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Contracts\UserRepositoryInterface;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Entity\User;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserCreatedAt;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserEmail;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserName;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\ValueObjects\UserPassword;
use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Infrastructure\Persistence\DoctrineUserRepository;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class UserRepositoryIntegrationTest extends \PHPUnit\Framework\TestCase {
    private EntityManager $entityManager;
    private UserRepositoryInterface $userRepository;

    protected function setUp(): void {
        $isDevMode = true;

        // Configuración de la conexión a la base de datos
        $cache = new ArrayAdapter();
        $config = ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/../src/Domain/Entity'], $isDevMode, null, $cache);
        $connection = DriverManager::getConnection([
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'user'     => 'root',
            'password' => '',
            'dbname'   => 'prueba-tecnica',
        ], $config);
        
        
        $this->entityManager = new EntityManager($connection, $config);
        
        $this->userRepository = new DoctrineUserRepository($this->entityManager);
    }

    public function testSaveAndRetrieveUser(): void {
        $user = new User(new UserName("Test User"), new UserEmail("test@example.com"), new UserPassword("Secure@123"), new UserCreatedAt());
        $this->userRepository->save($user);

        $retrievedUser = $this->userRepository->findById($user->getId());
        $this->assertNotNull($retrievedUser);
        $this->assertEquals($user->getEmail()->getValue(), $retrievedUser->getEmail()->getValue());
    }
}
