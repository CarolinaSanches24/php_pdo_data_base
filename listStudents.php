<?php
use Carolinasanches24\PhpPdo\Infra\Persistence\ConnectionCreator;
use Carolinasanches24\PhpPdo\Infra\Persistence\DbSchemaManager;
use Carolinasanches24\PhpPdo\Infra\Repository\InjectionDependence;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();

$schemaManager = new DbSchemaManager($connection);
$schemaManager->createTables(__DIR__ . '/src/Infra/schemas/schemas.sql');

$studentRepository = new InjectionDependence($connection);
$studentList = $studentRepository->getAllStudents();

var_dump($studentList);
