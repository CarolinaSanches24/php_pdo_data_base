<?php
namespace Carolinasanches24\PhpPdo\Infra\Persistence;
use PDO;
class ConnectionCreator{
    public static function createConnection():PDO{
        $data_base_path = __DIR__ . '/../../../db.sqlite';
        return new PDO('sqlite:'.$data_base_path);
    }
}