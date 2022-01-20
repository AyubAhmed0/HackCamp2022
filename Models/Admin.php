<?php
require_once('Models/Admindata.php');
require_once('Models/Database.php');

class Admin
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function loginAdmin($email, $password)
    {
        $this->email = trim($email);
        $this->password = trim($password);
        $checkEmail = $this->_dbHandle->prepare("SELECT * FROM admin WHERE adminEmail = ? ");
        $checkEmail->execute([$this->email]);
        $row = $checkEmail->fetch(PDO::FETCH_ASSOC);
        if($row['adminEmail'] == $this->email)
        {
            $verifyPass = password_verify($this->password, $row['adminPassword']);
            if($verifyPass)
            {
                $_SESSION = [
                    'admin_id' => $row['adminID'],
                    'admin_email' => $row['adminEmail']
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
    public function getAdminSession()
    {
        return $_SESSION;

    }

}