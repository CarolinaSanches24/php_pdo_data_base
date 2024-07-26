<?php
use Carolinasanches24\PhpPdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$path = __DIR__ . '/db.sqlite'; //caminho absoluto
$pdo = new PDO('sqlite:'.$path);

$statement = $pdo->query('SELECT * FROM students');
// var_dump($statement->fetchAll());
$studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);
$studentList = [];

foreach($studentDataList as $studentData){
    $studentList[] = new Student(
        $studentData["id"],
        $studentData["name"],
        new \DateTimeImmutable($studentData["birth_date"])
    );
}

var_dump($studentList);

// echo $studentList[0]['name'];