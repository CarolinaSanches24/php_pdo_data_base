#####  modos de busca (fetch modes)

1. PDO::FETCH_ASSOC
Esse modo retorna cada linha do conjunto de resultados como um array associativo. Isso significa que os valores das colunas serão acessíveis usando os nomes das colunas como chaves do array.

Exemplo:

```php

// Supondo que temos uma tabela chamada 'usuarios' com colunas 'id' e 'nome'
$stmt = $pdo->query("SELECT id, nome FROM usuarios");
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
    echo $row['id'] . " - " . $row['nome'] . "<br>";
}

```
```shell
Saída:

1 - João
2 - Maria
3 - Carlos
```

2. PDO::FETCH_BOTH

Esse modo retorna cada linha do conjunto de resultados como um array que contém tanto chaves associativas quanto numéricas. Isso significa que você pode acessar os valores das colunas tanto pelo nome da coluna quanto pelo índice numérico.

Exemplo:

```php

$stmt = $pdo->query("SELECT id, nome FROM usuarios");
$result = $stmt->fetchAll(PDO::FETCH_BOTH);

foreach ($result as $row) {
    echo $row[0] . " - " . $row['nome'] . "<br>";
}
```

Saída:


1 - João
2 - Maria
3 - Carlos

PDO::FETCH_CLASS é um modo de busca no PDO que permite mapear os resultados de uma consulta diretamente para uma classe PHP.

```php
class Usuario {
    public $id;
    public $nome;

    public function exibir() {
        echo $this->id . " - " . $this->nome . "<br>";
    }
}

// Supondo que $pdo é uma instância válida de PDO
$stmt = $pdo->query("SELECT id, nome FROM usuarios");
$result = $stmt->fetchAll(PDO::FETCH_CLASS, 'Usuario');

foreach ($result as $usuario) {
    $usuario->exibir(); 
};

```

#### Resumo das Diferenças
Estrutura dos Dados:

- PDO::FETCH_ASSOC: Array associativo.
- PDO::FETCH_BOTH: Array associativo e numérico.
- PDO::FETCH_CLASS: Instância de uma classe.

Acesso aos Dados:

- PDO::FETCH_ASSOC: Acesso por nomes das colunas.
- PDO::FETCH_BOTH: Acesso por nomes das colunas e índices numéricos.
- PDO::FETCH_CLASS: Acesso por propriedades da classe.

Complexidade e Usabilidade:

- PDO::FETCH_ASSOC: Simples, direto e ideal para operações básicas.
- PDO::FETCH_BOTH: Flexível, mas pode ser confuso em cenários complexos.
- PDO::FETCH_CLASS: Orientado a objetos, ideal para aplicações maiores e mais estruturadas.