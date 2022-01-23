<?php
namespace App\Model;

/*
use App\Database;

abstract class Model
{
    protected Database $pdo;

    public function __construct() {
        $this->pdo = \App\Database::pdo();
    }
}

/*
namespace App;

class Database
{
    public static function pdo() {
        $pdo = new \PDO(
            $_ENV['DATABASE'],
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]
        );
        return $pdo;
    }
}
*/