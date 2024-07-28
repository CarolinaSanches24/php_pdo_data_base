<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buscar Estudante</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./searchStudent.css" />
  </head>
  <body>
    
    <!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Mensagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalMessage">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function showModal(message) {
    $('#modalMessage').text(message);
    $('#successModal').modal('show');
}
</script>
  </body>
  </html>

<?php

use Carolinasanches24\PhpPdo\Domain\Model\DatabaseConnection;
use Carolinasanches24\PhpPdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['register'])) {

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $birth_date = filter_input(INPUT_POST, 'birth_date', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($id === false || !$name || !$birth_date) {
            echo "<script>showModal('Dados inválidos');</script>";
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
            echo "<script>showModal('Estudante cadastrado com sucesso!');</script>";
        } else {
            echo "<script>showModal('Erro ao cadastrar estudante');</script>";
        }
    }
} else {
    echo 'Método de requisição inválido';
}

$sql = 'SELECT * FROM students';
$stmt = $pdo->query($sql);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<h2>Lista de Estudantes</h2>';
echo '<table class="table">';
echo '<thead><tr><th>ID</th><th>Nome</th><th>Data de Nascimento</th></tr></thead>';
echo '<tbody>';

foreach ($students as $student) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($student['id']) . "</td>";
    echo "<td>" . htmlspecialchars($student['name']) . "</td>";
    echo "<td>" . htmlspecialchars($student['birth_date']) . "</td>";
    echo "</tr>";
}

echo '</tbody></table>';
?>
