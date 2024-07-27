<?php
use Carolinasanches24\PhpPdo\Domain\Model\DatabaseConnection;


require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::getConnection();

$sql ='SELECT * FROM students WHERE id = 4;';

$stmt = $pdo->query( $sql );

$user = $stmt->fetchObject();

echo $user->name . PHP_EOL;