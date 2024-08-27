#### Injeção de dependência

A injeção de dependência é um padrão de design que permite que a instância de uma classe seja "injetada" em outra classe, em vez de a própria classe instanciá-la diretamente. 

### Arquivo de conexão com o banco
```php
class DatabaseConnection {
    private $pdo;

    public function __construct($host, $dbname, $username, $password) {
        
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    public function getPdo() {
        return $this->pdo;
    }
}
}
```

### Repository -  classe que usa a Conexão (com Injeção de Dependência)

```php
<?php

class UserRepository {
    private $pdo;

    // Injeção de dependência da conexão PDO
    public function __construct(DatabaseConnetion $dbConnection) {
        $this->pdo = $dbConnection->getPdo();c
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

```


### Por fim, criamos a instância das classes e as utilizamos para obter dados do banco de dados.

```php
<?php

$host = 'localhost';
$dbname = 'meu_banco';
$username = 'meu_usuario';
$password = 'minha_senha';

// Cria a conexão com o banco de dados
$dbConnection = new DatabaseConnection($host, $dbname, $username, $password);

// Cria o repositório de usuários, injetando a conexão no construtor
$userRepository = new UserRepository($dbConnection);

// Obtém todos os usuários do banco de dados
$users = $userRepository->getAllUsers();

foreach ($users as $user) {
    echo "Nome: " . $user['name'] . "<br>";
    echo "Email: " . $user['email'] . "<br><br>";
}

```

