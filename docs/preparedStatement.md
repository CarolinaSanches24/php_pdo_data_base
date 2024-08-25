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

```php
$stmt = $pdo->prepare('SELECT * FROM students WHERE name = :name;');
$nome = 'Vinicius Dias';
$stmt->bindParam(':name', $nome);

$nome = 'Nico Steppat';

$stmt->execute();
```

Output 
```shell
Nico Steppat
```

#### Observação
Como $nome é passado por referência, o PDO só pega o valor da variável $nome na hora de executar o prepared statement, e no momento da chamada do execute, o valor é Nico Steppat