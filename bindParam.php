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
$colour = 'Red';

$sql = 'SELECT name, colour, calories FROM fruit WHERE calories >:calories AND colour = :colour';
$statement = $pdo ->prepare($sql);

$statement->bindParam(':calories', $calories);
$statement->bindParam(':colour', $colour);

$statement->execute();

$results = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $row) {
    echo 'Name: ' . $row['name'] . ', Colour: ' . $row['colour'] . ', Calories: ' . $row['calories'] . PHP_EOL;
}




