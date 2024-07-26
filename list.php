<?php

require_once 'vendor/autoload.php';

$path = __DIR__ . '/db.sqlite'; //caminho absoluto
$pdo = new PDO('sqlite:'.$path);

$statement = $pdo->query('SELECT * FROM students');
var_dump($statement->fetchAll());
$studentList = $statement->fetchAll();
echo $studentList[0]['name'];