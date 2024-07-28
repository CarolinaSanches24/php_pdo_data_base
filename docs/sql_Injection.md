#### SQL Injection ocorre quando um usuário consegue executar uma query no seu input.

```php
<?php

$student = new Student(
    id: null,
    name: "Vinicius', ''); DROP TABLE students; -- Dias",
    new \DateTimeImmutable(time: '1997-10-15');
);

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES ('{$student->name()}', '{$student->birthDate()->format('Y-m-d')}');";

echo $sqlInsert; exit();

var_dump($pdo->exec($sqlInsert));
```

No PHP, você pode evitar SQL Injection ao usar *Prepared Statements* (declarações preparadas) com PDO ou MySQLi. Aqui estão algumas práticas recomendadas para evitar SQL Injection em PHP:

filter_input()
A função filter_input() é usada para pegar uma variável de uma fonte externa, como entrada de um formulário (INPUT_POST), e opcionalmente aplicá-la a um filtro de validação ou sanitização.

INPUT_POST
INPUT_POST é uma constante que indica que a variável a ser filtrada está na superglobal $_POST. Isso significa que estamos lidando com dados enviados via método HTTP POST, geralmente através de um formulário HTML.

FILTER_VALIDATE_INT
FILTER_VALIDATE_INT é uma constante que representa um filtro de validação que verifica se a variável é um inteiro válido. Se a variável não for um inteiro válido, a função retorna false.