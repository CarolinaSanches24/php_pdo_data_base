<?php

use Carolinasanches24\PhpPdo\Domain\Model\DatabaseConnection;
use Carolinasanches24\PhpPdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::getConnection();
DatabaseConnection::createTables();

$student = new Student(
    id: 5,
    name: 'Joana Gomes',
    birthDate: new \DateTimeImmutable('1998-10-20')
);

$sqlInsert = "INSERT INTO students (id, name, birth_date) VAlUES({$student->id()},'{$student->name()}','{$student->birthDate()->format('Y-m-d')}')";
// echo "".$sqlInsert."";
var_dump($pdo ->exec($sqlInsert)); //exec -> Executar sql
