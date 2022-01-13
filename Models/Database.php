<?php

class Database
{
    protected static $_dbInstance = null;

    protected $_dbHandle;

//connecting Database
    public static function getInstance()
    {
        $host = 'poseidon.salford.ac.uk';
        $dbName = 'hc22_5';
        $user = 'hc22-5';
        $pass = 'VZVNeHLSZRFO7Ry';

        if(self::$_dbInstance == null){
            self::$_dbInstance = new self($host, $dbName, $user, $pass);
        }
        return self::$_dbInstance;
    }

    private function __construct($host, $dbName, $user, $pass){
        try{
            $this->_dbHandle = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }

    }



    public function getdbConnection(){
        return $this->_dbHandle;
    }

    public function __destruct(){
        $this->_dbHandle = null;
    }
}
