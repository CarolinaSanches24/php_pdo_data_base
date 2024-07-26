<?php

$path = __DIR__ . '/db.sqlite'; //caminho absoluto
$pdo = new PDO('sqlite:'.$path);

echo "Connection OK!\u{1F680}";

$pdo -> exec('CREATE TABLE students (id PRIMARY KEY, name TEXT, birth_date TEXT)');
