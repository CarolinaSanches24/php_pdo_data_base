#### Resumo das Diferenças

**fetch()**: Recupera uma única linha, podendo ser retornada em formatos variados (matriz, objeto).

```php
$stmt = $pdo->query('SELECT * FROM students WHERE id = 4');
$row = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($row);

```
**fetchAll()**: Recupera todas as linhas de resultados em um array, podendo ser em formatos variados.

```php
$stmt = $pdo->query('SELECT * FROM students');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($rows);

```
**fetchObject()**: Recupera uma única linha e a transforma em um objeto de uma classe específica ou um objeto anônimo.

```php
class Student {
    public $id;
    public $name;
}

$stmt = $pdo->query('SELECT * FROM students WHERE id = 4');
$student = $stmt->fetchObject('Student');
var_dump($student);

```
**fetchColumn()**: Recupera um valor específico de uma única coluna da primeira linha de resultados.

```php
$stmt = $pdo->query('SELECT name FROM students WHERE id = 4');
$name = $stmt->fetchColumn();
echo $name;

```