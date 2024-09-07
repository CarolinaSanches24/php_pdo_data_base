<?php
namespace Carolinasanches24\PhpPdo\Infra\Persistence;
use PDO;
use RuntimeException;
class DbSchemaManager
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function createTables(string $schemaPath): void
    {
        if (!file_exists($schemaPath)) {
            throw new RuntimeException("O arquivo de schema não foi encontrado: $schemaPath");
        }
        $schema = file_get_contents($schemaPath);
        
        if ($schema === false) {
            throw new RuntimeException("Erro ao ler o arquivo de schema.");
        }

        $this->connection->exec($schema);
    }
}
