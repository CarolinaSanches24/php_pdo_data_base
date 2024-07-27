<?php
use Carolinasanches24\PhpPdo\Domain\Model\DatabaseConnection;
use Carolinasanches24\PhpPdo\Domain\Model\StudentTest;

require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::getConnection();

$statement = $pdo->query('SELECT * FROM students WHERE id = 4;');
$statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, StudentTest::class);
$student = $statement->fetch();

if ($student) {
    echo "ID: " . $student->getId() . PHP_EOL;
    echo "Name: " . $student->getName() . PHP_EOL;
    echo "Birth Date: " . $student->getBirthDateAsString() . PHP_EOL;
    echo "Age: " . $student->age() . " years old" . PHP_EOL;
} else {
    echo 'Nenhum aluno encontrado';
}
exit();

