#### Tratamento de erros

#### Exemplo 

```php
<?php

try {
    // Conexão com o banco de dados (substitua pelas suas credenciais)
    $dsn = "mysql:host=localhost;dbname=teste_db";
    $username = "root";
    $password = "";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Ativa o modo de exceção
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    
    $dbh = new PDO($dsn, $username, $password, $options);

    // Inicia uma transação
    $dbh->beginTransaction();

    // Exemplo de primeira query
    $stmt1 = $dbh->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt1->execute([':name' => 'Alice', ':email' => 'alice@example.com']);

    // Exemplo de segunda query (vai falhar de propósito para gerar exceção)
    $stmt2 = $dbh->prepare("UPDATE accounts SET balance = balance - 100 WHERE user_id = :user_id");
    $stmt2->execute([':user_id' => 999]); // `999` é um ID inexistente para gerar erro

    // Se tudo ocorrer bem, confirma a transação
    $dbh->commit();

} catch (Exception $e) {
    // Em caso de erro, desfaz as mudanças com rollback
    $dbh->rollBack();
    
    // Lança uma RuntimeException e exibe a mensagem de erro
    throw new RuntimeException("Erro durante a transação: " . $e->getMessage());
}

```

[**PDO::errorInfo**](https://www.php.net/manual/pt_BR/pdo.errorinfo.php) — Busca informação de erro estendida associada com a última operação no identificador do banco de dados
- retorna um array de informações de erro sobre a última operação realizada por este identificador de banco de dados. 
