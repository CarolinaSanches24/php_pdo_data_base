<?php
use Carolinasanches24\PhpPdo\Domain\Model\Student;
use Carolinasanches24\PhpPdo\Infra\Persistence\ConnectionCreator;
use Carolinasanches24\PhpPdo\Infra\Repository\InjectionDependence;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();

$studentRepository = new InjectionDependence($connection);

$connection->exec('CREATE TABLE IF NOT EXISTS students (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT, birth_date TEXT)');

$connection->beginTransaction();

$studentOne = new Student(
    id: null,
    birthDate: new DateTimeImmutable(),
    name: 'Mauricio victor'
);

$studentTwo = new Student(
    id:null,
    birthDate: new DateTimeImmutable(),
    name: 'Carolinas Sanches'
);

$studentRepository->save($studentTwo);

$connection->commit();