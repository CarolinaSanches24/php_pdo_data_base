**PDOStatement::bindValue** — Vincula um valor a um parâmetro

Exemplo: 

```php
<?php
$pdo = DatabaseConnection::getConnection();

$sqlInsert = 'INSERT INTO students (name, birth_date) VALUES (?,?)';

$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(1,$student->name());
$statement->bindValue(2,$student->birth_date()->format('Y-m-d'));
$statement -> execute();

//Sintaxe nomeada
$pdo = DatabaseConnection::getConnection();

$sqlInsert = 'INSERT INTO students (name, birth_date) VALUES (:name,:birth_date)';

$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name',$student->name());
$statement->bindValue(':birth_date',$student->birth_date()->format('Y-m-d'));
$statement -> execute();

```

**PDOStatement::bindParam** — Vincula um parâmetro ao nome de variável especificado

