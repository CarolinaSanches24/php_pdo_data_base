<?php

use Carolinasanches24\PhpPdo\Domain\Model\DatabaseConnection;
use Carolinasanches24\PhpPdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::getConnection();
DatabaseConnection::createTables();

$student = new Student(
    id: null,
    name: 'Teste',
    birthDate: new \DateTimeImmutable('1997-10-20')
);

$sqlInsert = "INSERT INTO students (name, birth_date) VAlUES('{$student->name()}','{$student->birthDate()->format('Y-m-d')}')";
// echo "".$sqlInsert."";
var_dump($pdo ->exec($sqlInsert)); //exec -> Executar sql
