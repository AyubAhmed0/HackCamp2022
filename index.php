<?php
$view = new stdClass();
$view->pageTitle = 'Login';
require_once('Models/User.php');
require_once('Views/index.phtml');
session_start();
if (isset($_POST["button-login"])) {
    
    $userEmail = $_POST["email"];
    $password = ($_POST["login-password"]);
    echo "<h1>Email:</h1>";
    var_dump($userEmail);
    echo "<h1>Password:</h1>";
    var_dump($password);
    $login = new User();
    //$loginDataSet = $login->fetchUserPassword($userEmail, $password);
    $login->loginUser($userEmail, $password);
    $login2->loginAdmin($userEmail, $password);
   /* if ($loginDataSet != null) {
        $_SESSION["login"] = $FirstName;
//        echo "You are logged in <a href='home.php'>User Page</a>";
        echo $_SESSION['login'];
        header('location:signup.php');

    } else {
        echo "No Match in databse - Error in username and password";
    }*/
    


}