<?php
session_start();
require_once('Models/Admindata.php');
require_once('Models/Database.php');

class Admin
{
    protected $_dbHandle, $_dbInstance;
    protected $numField;

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
        /*if($row['adminEmail'] == $this->email)
        {
            $verifyPass = password_verify($this->password, $row['adminPassword']);
            if($verifyPass)
            {
                $_SESSION = [
                    'admin_id' => $row['adminID'],
                    'admin_email' => $row['adminEmail']
                ];
                header('Location: adminpanel.php');
            }
            else
            {
                echo '<h1 class="p-3 mb-2 bg-danger text-white"><br>Show password not matched message!<br></h1>';
            }
        }
        else
        {
            echo '<h1 class="p-3 mb-2 bg-danger text-white"><br> Show Email is not registered message!<br></h1>';
        }*/
        if(!(empty($row['adminEmail'])) && $row['adminEmail'] == $this->email)
        {
            $verifyPass = password_verify($this->password, $row['adminPassword']);
            if($verifyPass)
            {
                $_SESSION = [
                    'admin_id' => $row['adminID'],
                    'admin_email' => $row['adminEmail']
                ];
                header('Location: adminpanel.php');
            }
            else
            {
                return 1; //error pass
            }
        }
        else
        {
            return 2; //error email
        }
    }
    public function getAdminSession()
    {
        //return $_SESSION;
        return $_SESSION;
    }
    public function getAllUsers(){
        try{
            //query to get all the users, but not the one with the ID supplied
            $getUsers = $this->_dbHandle->prepare("SELECT * FROM `user`");
            $getUsers->execute();
            //var_dump($get_users->fetchAll());
            if($getUsers->rowCount() > 0){
                //fetches the rows and returns them as an object
                return $getUsers->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                return 0;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllSurveys(){
        try{
            //query to get all the users, but not the one with the ID supplied
            $getSurveys = $this->_dbHandle->prepare("SELECT * FROM `experiment` WHERE type = 'Survey'");
            $getSurveys->execute();
            //var_dump($get_users->fetchAll());
            if($getSurveys->rowCount() > 0){
                //fetches the rows and returns them as an object
                return $getSurveys->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                return 0;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllPolls(){
        try{
            //query to get all the users, but not the one with the ID supplied
            $getPolls = $this->_dbHandle->prepare("SELECT * FROM `experiment` WHERE type = 'Poll'");
            $getPolls->execute();
            //var_dump($get_users->fetchAll());
            if($getPolls->rowCount() > 0){
                //fetches the rows and returns them as an object
                return $getPolls->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                return 0;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllPrototypes(){
        try{
            //query to get all the users, but not the one with the ID supplied
            $getPrototypes = $this->_dbHandle->prepare("SELECT * FROM `experiment` WHERE type = 'Prototype'");
            $getPrototypes->execute();
            //var_dump($get_users->fetchAll());
            if($getPrototypes->rowCount() > 0){
                //fetches the rows and returns them as an object
                return $getPrototypes->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllDiscussions(){
        try{
            //query to get all the users, but not the one with the ID supplied
            $getDiscussions = $this->_dbHandle->prepare("SELECT * FROM `experiment` WHERE type = 'discussion'");
            $getDiscussions->execute();
            //var_dump($get_users->fetchAll());
            if($getDiscussions->rowCount() > 0){
                //fetches the rows and returns them as an object
                return $getDiscussions->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllExperiments($id){
        try{
            //query to get all the users, but not the one with the ID supplied
            $getExperiments = $this->_dbHandle->prepare("SELECT COUNT('experimentID') FROM `userExperiment` WHERE userID = ?");
            $getExperiments->execute([$id]);
            //var_dump($get_users->fetchAll());
            if($getExperiments->rowCount() > 0){
                //fetches the rows and returns them as an object
               return $getExperiments->fetchColumn();
                
                
            }
            else{
                return 0;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function createExperiment($type, $title, $totalTime, $startDate, $description, $link)
    {
        $sqlQuery = "INSERT INTO experiment (type, name, totaltime, date, description, formHtml) VALUE (?, ?, ?, ?, ?, ?)";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(1, $type);
        $statement->bindParam(2, $title);
        $statement->bindParam(3, $totalTime);
        $statement->bindParam(4, $startDate);
        $statement->bindParam(5, $description);
        $statement->bindParam(6, $link);
        $statement->execute();
    }
}