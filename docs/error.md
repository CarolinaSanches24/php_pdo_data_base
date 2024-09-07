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
- o error info traz o SQLSTATE (código de erro genérico do padrão ANSI SQL) e
Código e mensagem de erro específicos do driver do banco de dados utilizado

### Setar atributos 
[PDO::setAttribute](https://www.php.net/manual/pt_BR/pdo.setattribute.php)
Exemplo em termos simples:
Imagine que você quer mudar o comportamento da sua conexão com o banco de dados para que qualquer erro seja tratado como uma exceção (um erro mais "forte", que precisa ser resolvido imediatamente).

```php
<?php

try {
    // Aqui usamos setAttribute para definir como os erros serão tratados
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Agora, qualquer erro será lançado como uma exceção
} catch (PDOException $e) {
    // Caso ocorra algum erro, ele será tratado aqui
    echo "Erro na conexão: " . $e->getMessage();
}

```

***PDO::ATTR_ERRMODE:*** Isso é como um "interruptor" que controla como os erros serão mostrados. Aqui, estamos configurando para mostrar os erros como exceções (um tipo mais sério de erro).
PDO::ERRMODE_EXCEPTION: Diz ao PDO que, se houver um erro no banco de dados, ele deve ser tratado de forma mais séria, lançando uma exceção.

#### Por que usar isso?
Usar setAttribute permite ajustar comportamentos importantes da sua conexão ao banco de dados, como:

- Controlar o modo de erro (exibir erros ou exceções).
- Definir o formato de saída dos dados (arrays associativos ou arrays numéricos).
- Ativar ou desativar certas funcionalidades de segurança ou desempenho.

**PDO::ATTR_ERRMODE:**

- PDO::ERRMODE_SILENT: padrão que não levanta nenhum erro do PHP e só define os códigos de erro;

- PDO::ERRMODE_WARNING não é muito recomendada, e somente levanta um warning de PHP. Mas não conseguimos pegá-lo, e precisaríamos usar a função de tratamento de erro, o que não é muito trivial;

- PDO::ERRMODE_EXCEPTION é exatamente a que queremos, fazendo com que o PDO lance uma exceção quando algum erro acontecer.

***PDO::ATTR_DEFAULT_FETCH_MODE***: Isso define como os resultados das consultas serão retornados. É como configurar um "modo padrão de busca" para quando você recuperar dados do banco.
PDO::FETCH_ASSOC: Significa que os dados serão retornados como um array associativo, onde os nomes das colunas do banco de dados serão usados como chaves do array.

