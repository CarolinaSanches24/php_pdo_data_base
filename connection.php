<?php

$path = __DIR__ . '/db.sqlite'; //caminho absoluto
$pdo = new PDO('sqlite:'.$path);

echo "Connection OK!\u{1F680}";

$pdo->exec('CREATE TABLE IF NOT EXISTS students (
    id INTEGER PRIMARY KEY,
    name TEXT,
    birth_date TEXT
)');
$pdo->exec('CREATE TABLE IF NOT EXISTS fruit (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    colour TEXT,
    calories FLOAT
)');

