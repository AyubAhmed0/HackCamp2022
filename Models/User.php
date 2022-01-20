<?php
session_start();
//require_once('Models/UserData.php');
require_once('Models/Database.php');

class User
{
    protected $_dbHandle, $_dbInstance;
    protected $reqNumber;
    protected $oldNum;

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
        $sqlQuery = "INSERT INTO user (first_name, last_name, password, DoB, email, gender) VALUE (?, ?, ?, ?, ?, ?)";
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
        $checkEmail = $this->_dbHandle->prepare("SELECT * FROM user WHERE email = ? ");
        $checkEmail->execute([$this->email]);
        $row = $checkEmail->fetch(PDO::FETCH_ASSOC);
        if($row['email'] == $this->email)
        {
            $verifyPass = password_verify($this->password, $row['password']);
            if($verifyPass)
            {
                //$_SESSION["login"] = $row['id'];
                $_SESSION = [
                    'user_id' => $row['id'],
                    'email' => $row['email']
                ];
                //echo '<h1 class="p-3 mb-2 bg-danger text-white"><br>Success!<br></h1>';
               header('Location: dashboard.php');
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
    public function countExperiment()
    {
        try{
            $sql = "SELECT * FROM `experiment`";
            $stmt = $this->_dbHandle->prepare($sql);
            $stmt->execute();
            //fetch all rows as an object
            $allRecieved = $stmt->fetchAll(PDO::FETCH_OBJ);
            //echo '<pre>' , var_dump($allRecieved) , '</pre>';
            //echo '<prev>',var_dump($allRequests),'</prev>';
            $this->reqNumber = count((array)$allRecieved);

            $sqlTwo = "SELECT totalExperiments FROM `notification` WHERE id=1";
            $stmtTwo = $this->_dbHandle->prepare($sqlTwo);
            $stmtTwo->execute();
            //fetch all rows as an object
            //$allRecievedExp = $stmtTwo->fetchAll(PDO::FETCH_OBJ);
            $allRecievedExp = $stmtTwo->fetch(PDO::FETCH_ASSOC);
            //echo '<pre>' , var_dump($allRecievedExp) , '</pre>';
            //$reqNumberTwo = count((array)$allRecievedExp);
            //echo '<prev>',var_dump($allRecievedExp['totalExperiments']),'</prev>';
            $this->oldNum = intval($allRecievedExp['totalExperiments']);
            if($this->oldNum<$this->reqNumber){
                //echo '<prev>',var_dump($reqNumber),'</prev>';
            //echo var_dump($oldNum);
            //echo "New Notification";
            $notificationNumber = $this->reqNumber - $this->oldNum;
            //echo $notificationNumber;
            return $notificationNumber;
            }
            else {
            //echo "No New Notification";
            return 0;
    }

        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function updateNotification()
    {
            $sqlQuery = "UPDATE `notification` SET totalExperiments=? WHERE id=?";
            $statement = $this->_dbHandle->prepare($sqlQuery);
            //$statement->bindParam(1, $reqNumber);
            $statement->execute([$this->reqNumber,1]);
    }

    public function findExpById($id){
        try{
            $find_user = $this->_dbHandle->prepare("SELECT experimentID FROM `userExperiment` WHERE userID = ?");
            //$find_user = $this->_dbHandle->prepare("SELECT * FROM `userExperiment` WHERE userID = ?");
            $find_user->execute([$id]);
            $userFind = $find_user->fetchAll(PDO::FETCH_OBJ); 
            
                return $userFind;
        }
        //catches errors caused by the PDO
        catch (PDOException $e) {
            echo "Error in PDO in find user by id function";
            die($e->getMessage());

        }
    }

}