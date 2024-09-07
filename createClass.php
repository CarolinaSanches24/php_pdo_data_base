<?php
use Carolinasanches24\PhpPdo\Infra\Persistence\ConnectionCreator;
use Carolinasanches24\PhpPdo\Infra\Persistence\DbSchemaManager;
use Carolinasanches24\PhpPdo\Infra\Repository\InjectionDependence;
use Carolinasanches24\PhpPdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

// Criar conexão
$connection = ConnectionCreator::createConnection();

// Gerenciar o schema
$schemaManager = new DbSchemaManager($connection);
$schemaManager->createTables(__DIR__ . '/src/Infra/schemas/schemas.sql');

// Repositório de estudantes
$studentRepository = new InjectionDependence($connection);

// Iniciar transação
$connection->beginTransaction();

try {
    // Criar estudantes
    $studentOne = new Student(
        id: null,
        birthDate: new DateTimeImmutable(),
        name: 'Mauricio Victor'
    );

    $studentTwo = new Student(
        id: null,
        birthDate: new DateTimeImmutable(),
        name: 'Monkey d luffy'
    );

    // Salvar estudante no repositório
    $studentRepository->save($studentTwo);

    // Confirmar transação
    $connection->commit();
} catch (\RuntimeException $e) {
    echo $e->getMessage();
    $connection->rollBack();
}





