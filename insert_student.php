<?php

use Carolinasanches24\PhpPdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$path = __DIR__ . '/db.sqlite'; //caminho absoluto
$pdo = new PDO('sqlite:'.$path);

$student = new Student(
    id: null,
    name: 'Carolina Sanches',
    birthDate: new \DateTimeImmutable('1997-10-15')
);

$sqlInsert = "INSERT INTO students (name, birth_date) VAlUES('{$student->name()}','{$student->birthDate()->format('Y-m-d')}')";
// echo "".$sqlInsert."";
var_dump($pdo ->exec($sqlInsert)); //exec -> Executar sql
