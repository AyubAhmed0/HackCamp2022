<?php
$view = new stdClass();
$view->pageTitle = 'Login';
require('Models/User.php');
if(isset($_SESSION['email'])){
    header('Location: dashboard.php');
    //echo '<h1>current user email is:'.$_SESSION['email'].'</h1>';
    exit;
}
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
    //$login2->loginAdmin($userEmail, $password);
}
require('Views/index.phtml');