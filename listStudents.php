<?php

use Carolinasanches24\PhpPdo\Domain\Model\DatabaseConnection;

require_once 'vendor/autoload.php';

// Obter a conexão com o banco de dados
$pdo = DatabaseConnection::getConnection();
DatabaseConnection::createTables();
// Executar uma consulta SELECT
$query = $pdo->query('SELECT * FROM students');
$students = $query->fetchAll(PDO::FETCH_ASSOC);

var_dump($query->fetchAll(PDO::FETCH_ASSOC));
// Exibir os resultados
echo "Students in the database:\n";
foreach ($students as $student) {
    echo $student['name'] . "\n"; // Supondo que a tabela tenha uma coluna 'name'
}
