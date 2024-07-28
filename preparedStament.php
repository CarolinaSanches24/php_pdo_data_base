<?php

use Carolinasanches24\PhpPdo\Domain\Model\DatabaseConnection;
use Carolinasanches24\PhpPdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['search'])) {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        echo $_POST['id'];
        if ($id === false) {
            echo "ID inválido";
            exit();
        }

        $sql = 'SELECT * FROM students WHERE id = :id';

        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo "ID: " . $result['id'] . PHP_EOL;
            echo "Name: " . $result['name'] . PHP_EOL;
            echo "Birth Date: " . $result['birth_date'] . PHP_EOL;
        } else {
            echo 'Nenhum aluno encontrado';
        }
    } elseif (isset($_POST['register'])) {

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $birth_date = filter_input(INPUT_POST, 'birth_date', FILTER_SANITIZE_STRING);

        if ($id === false || !$name || !$birth_date) {
            echo "Dados inválidos";
            exit();
        }

    $student = new Student(
        $id,
        $name,
        new \DateTimeImmutable($birth_date)
    );

    $sqlInsert = 'INSERT INTO students (id, name, birth_date) VALUES (?, ?, ?)';

    $stmt = $pdo->prepare($sqlInsert);
    $stmt->bindValue(1, $student->id());
    $stmt->bindValue(2, $student->name());
    $stmt->bindValue(3, $student->birthDate()->format('Y-m-d'));

    if ($stmt->execute()) {
        echo "Estudante cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar estudante";
    }
}
} else {
echo 'Método de requisição inválido';
}

// Exibe todos os registros na tabela
$sql = 'SELECT * FROM students';
$stmt = $pdo->query($sql);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<h2>Lista de Estudantes</h2>';
echo '<table border="1">';
echo '<tr><th>ID</th><th>Nome</th><th>Data de Nascimento</th></tr>';

foreach ($students as $student) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($student['id']) . "</td>";
    echo "<td>" . htmlspecialchars($student['name']) . "</td>";
    echo "<td>" . htmlspecialchars($student['birth_date']) . "</td>";
    echo "</tr>";
}

echo '</table>';
