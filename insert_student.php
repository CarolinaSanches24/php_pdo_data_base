<?php

use Carolinasanches24\PhpPdo\Domain\Model\DatabaseConnection;
use Carolinasanches24\PhpPdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::getConnection();
DatabaseConnection::createTables();

$student = new Student(
    name: 'Adriel de jesus lima sanches',
    birthDate: new \DateTimeImmutable('1998-10-20')
);

$sqlInsert = "INSERT INTO students ( name, birth_date) VAlUES('{$student->name()}','{$student->birthDate()->format('Y-m-d')}')";
var_dump($pdo ->exec($sqlInsert));