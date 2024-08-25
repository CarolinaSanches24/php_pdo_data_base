<?php

use Carolinasanches24\PhpPdo\Domain\Model\DatabaseConnection;
require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::getConnection();

$sql_delete ='DELETE FROM students WHERE id = ?;';
$prepared_statement = $pdo->prepare($sql_delete);
$prepared_statement->bindValue(1,1, PDO::PARAM_INT);
var_dump($prepared_statement->execute());