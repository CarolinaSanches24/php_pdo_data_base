<?php

namespace Carolinasanches24\PhpPdo\Domain\Model;

use PDO;
use PDOException;

class DatabaseConnection
{
    private static ?PDO $connection = null; // Inicializa como null para verificar mais tarde

    // Construtor privado para evitar instanciação direta
    private function __construct()
    {
    }

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            try {
                $path = __DIR__ . '../../../db.sqlite'; // caminho absoluto
                self::$connection = new PDO('sqlite:' . $path);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }

    public static function createTables():void{
        self::$connection->exec('CREATE TABLE IF NOT EXISTS students (id PRIMARY KEY, name TEXT, birth_date TEXT)');

    }
}


