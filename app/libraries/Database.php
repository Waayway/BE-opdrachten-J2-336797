<?php

class database
{
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;
    private $dbHandler;
    private $statement;



    public function __construct()
    {
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName . ";charset=UTF8";

        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query(string $sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    public function execute()
    {
        return $this->statement->execute();
    }

    public function bindValue(string $param, mixed $value) {
        $this->statement->bindValue($param, $value, PDO::PARAM_STR);
    }

    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function result()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }
}
