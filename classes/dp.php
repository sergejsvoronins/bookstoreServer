<?php
class DB
{
    protected $pdo;
    
    function __construct() {
        $host = "localhost";
        $db = "bookstore";
        $user = "bookstore";
        $password = "bookstore";
        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
        $pdo = new PDO($dsn, $user, $password, $options);
        $this->pdo = $pdo;

    }  
    public function getAll($table) : array
    {

        $query = "SELECT * FROM $table";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();   
    }
}