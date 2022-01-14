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
    public function loginUser($email, $password)
    {
        $this->email = trim($email);
        $this->password = trim($password);
        $checkEmail = $this->_dbHandle->prepare("SELECT * FROM Users WHERE email = ? ");
        $checkEmail->execute([$this->email]);
        $row = $checkEmail->fetch(PDO::FETCH_ASSOC);
        if($row['email'] == $this->email)
        {
            $verifyPass = password_verify($this->password, $row['password']);
            if($verifyPass)
            {
                $_SESSION = [
                    'user_id' => $row['id'],
                    'email' => $row['email']
                ];
                header('Location: https://www.ajbell.co.uk/');
            }
            else
            {
                echo '<h1 class="p-3 mb-2 bg-danger text-white"><br>Show password not matched message!<br></h1>';
            }
        }
        else
        {
            echo '<h1 class="p-3 mb-2 bg-danger text-white"><br> Show Email is not registered message!<br></h1>';
        }
    }
    public function getSession()
    {
        //var_dump($_SESSION);
        //echo '<h1>Logged in via email:' . $_SESSION['email'];
        return $_SESSION;

    }

}