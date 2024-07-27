<?php
use Carolinasanches24\PhpPdo\Domain\Model\DatabaseConnection;
use Carolinasanches24\PhpPdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::getConnection();

$statement = $pdo->query('SELECT * FROM students WHERE id= 4;');

var_dump( $statement->fetchColumn(2)); //Traz todos os registros da 2ª coluna
exit();
