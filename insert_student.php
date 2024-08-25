<?php
use Carolinasanches24\PhpPdo\Domain\Model\Student;
use Carolinasanches24\PhpPdo\Infra\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();

$student = new Student(
    name: 'Adriel ',
    birthDate: new \DateTimeImmutable('1998-10-20')
);

$sqlInsert = "INSERT INTO students ( name, birth_date) VAlUES('{$student->name()}','{$student->birthDate()->format('Y-m-d')}')";
var_dump($pdo ->exec($sqlInsert));