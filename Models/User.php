<?php
require_once('Models/UserData.php');
require_once('Models/Database.php');

class User
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function createUsers($FirstName, $LastName, $email, $DoB, $gender, $pwd){
        if(empty($gender))
        {
            $gender='Prefer Not To Say';
        }
        $hashPassword = password_hash($pwd, PASSWORD_DEFAULT);
        $sqlQuery = "INSERT INTO Users (first_name, last_name, password, DoB, email, gender) VALUE (?, ?, ?, ?, ?, ?)";
        $statement = $this->_dbHandle->prepare($sqlQuery);

        $statement->bindParam(1, $FirstName);
        $statement->bindParam(2, $LastName);
        $statement->bindParam(3, $hashPassword);
        $statement->bindParam(4, $DoB);
        $statement->bindParam(5, $email);
        $statement->bindParam(6, $gender);

        $statement->execute();

    }

    public function fetchUserPassword($email, $password){


        $sqlQuery = "SELECT * FROM Users WHERE email = '".$email."'AND password = '".$password."'";
        $statement = $this->_dbHandle->prepare($sqlQuery);

        $statement->execute();
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new UserData($row);
        }
        return $dataSet;

    }


}