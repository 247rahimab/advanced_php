<?php
class Database {
    protected  $dbConnection;
    private $dbHost = 'localhost';
    private $dbUser = 'root';
    private $dbPassword = '';
    private $dbName = 'todo';

    function dbConnection(){
        try{
            $this->dbConnection = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUser, $this->dbPassword);
            $this->dbConnection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            return $this->dbConnection;
        }
        catch (PDOException $e){
            return $e->getMessage();
        }


    }



}