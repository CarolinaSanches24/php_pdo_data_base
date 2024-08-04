<?php
use Carolinasanches24\PhpPdo\Domain\Model\DatabaseConnection;
use Carolinasanches24\PhpPdo\Domain\Model\Fruit;
require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::getConnection();

$name = 'Apple';
$colour = 'Red';
$calories = 160;

$fruit = new Fruit($name,$colour,$calories);

$sqlInsert = 'INSERT INTO fruit (name, calories, colour) VALUES (:name, :calories, :colour)';
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name', $fruit->getName());
$statement->bindValue(':calories', $fruit->getCalories());
$statement->bindValue(':colour', $fruit->getColour());
$statement->execute();

$calories = 150;
$colour = 'red';

$sql = 'SELECT name, colour, calories FROM fruit WHERE calories <:calories AND colour = :colour';
$statement = $pdo ->prepare($sql);

$statement->bindParam(':calories', $colories, PDO::PARAM_INT);
$statement->bindParam(':colour', $colour, PDO::PARAM_STR);

$statement->execute();





