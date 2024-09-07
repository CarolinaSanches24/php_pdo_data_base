#### Conceitos de transação em PHP

No PHP, transactions são usadas para garantir que um conjunto de operações no banco de dados seja realizado de maneira atômica, ou seja, ou todas as operações são concluídas com sucesso, ou nenhuma delas é aplicada. Isso é muito útil para evitar inconsistências em situações onde múltiplas queries dependem umas das outras.

#### Exemplo de uso

```php
try {
    // Inicia a conexão e a transação
    $dbh->beginTransaction();

    // Executa a primeira query
    $stmt1 = $dbh->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt1->execute([':name' => 'John Doe', ':email' => 'john@example.com']);

    // Executa a segunda query
    $stmt2 = $dbh->prepare("UPDATE accounts SET balance = balance - 100 WHERE user_id = :user_id");
    $stmt2->execute([':user_id' => $dbh->lastInsertId()]);

    // Se tudo ocorrer bem, confirma a transação
    $dbh->commit();

} catch (Exception $e) {
    // Em caso de erro, desfaz as mudanças
    $dbh->rollBack();
    echo "Failed: " . $e->getMessage();
}
```

###  o PDO nos fornece uma API muito simples para gerenciar transações
Como iniciar e finalizar uma transação, com **beginTransaction e commit**
Que é possível "cancelar" uma transação, com o método **rollBack**


### Rename db sqlite

 mv db.sqlite db.sqlite2