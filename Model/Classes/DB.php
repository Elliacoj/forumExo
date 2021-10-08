<?php

namespace App\Model\Classes;

use PDO;
use PDOException;

class DB {
    private string $host = 'localhost';
    private string $dbName = 'forum';
    private string $userName = 'root';
    private string $password = '';

    private static ?PDO $instance = null;

    /**
     * DB constructor.
     */
    public function __construct() {
        try {
            self::$instance = new PDO("mysql:host=$this->host;dbname=$this->dbName;charset=utf8", $this->userName, $this->password);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Instance the DB
     * @return PDO
     */
    public static function getInstance(): PDO {
        if(self::$instance === null) {
            new self();
        }
        return self::$instance;
    }

    /**
     * Lock function clone for another dev
     */
    public function __clone(){}
}