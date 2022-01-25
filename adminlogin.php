<?php
$view = new stdClass();
$view->pageTitle = 'Login Admin';
require 'Models/Admin.php' ;
$error = 0;
if (isset($_POST["button-login"])) {
    
    $userEmail = $_POST["email"];
    $password = ($_POST["login-password"]);
    //echo "<h1>Email:</h1>";
    //var_dump($userEmail);
    //echo "<h1>Password:</h1>";
    //var_dump($password);
    $loginAdmin = new Admin();
    //$loginDataSet = $login->fetchUserPassword($userEmail, $password);
    $loginAdmin->loginAdmin($userEmail, $password);
    $error = $loginAdmin->loginAdmin($userEmail, $password);
}
if(isset($_SESSION['admin_email'])){
    header('Location: adminpanel.php');
    //echo '<h1>current user email is:'.$_SESSION['email'].'</h1>';
    exit;
}
require_once('Views/adminlogin.phtml');