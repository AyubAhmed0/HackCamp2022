<?php

$view = new stdClass();
$view->pageTitle = 'Signup';
require('Models/User.php');
$error = 0;
if (isset($_POST["signupbutton"])){
    $signupDataSet = new User();
     $error = $signupDataSet->createUsers($_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["DoB"], $_POST['gender'], $_POST["pwd"]);
}
require('Views/signup.phtml');