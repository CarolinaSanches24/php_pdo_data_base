<?php
namespace Carolinasanches24\PhpPdo\Infra\Persistence;
use PDO;
class ConnectionCreator{
    public static function createConnection():PDO{
        $data_base_path = __DIR__ . '/../../../db.sqlite';
        $connection = new PDO('sqlite:'.$data_base_path);
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        return $connection;
    }
}