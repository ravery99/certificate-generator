<?php

namespace App\Config;

use PDO;
use PDOException;
use Exception;

class DatabaseConfig 
{
    private $host;
    private $user;
    private $password;
    private $dbname;
    private $dbport;
    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        $this->host = Config::get('DB_HOST');
        $this->user = Config::get('DB_USER');
        $this->password = Config::get('DB_PASS');
        $this->dbname = Config::get('DB_NAME');
        $this->dbport = Config::get('DB_PORT');

        $this->connect();
    }
    private function connect()
    {
        $dsn = "pgsql:host={$this->host};port={$this->dbport};dbname={$this->dbname}";

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            throw new Exception("Database Connection Error: $this->error");
            // error_log("Database Connection Error: $this->error", 3, __DIR__ . "/../../logs/errors.log");
            // die("Database connection failed. Please try again later.");
        }
    }
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }
    
    public function results()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }
    
    public function result()
    {
        $this->execute();
        return $this->stmt->fetch();
    }
    
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
    
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
}