<?php

$view = new stdClass();
$view->pageTitle = 'Signup';
require('Models/User.php');
if (isset($_POST["signupbutton"])){
    $signupDataSet = new User();
    $result = $signupDataSet->createUsers($_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["DoB"], $_POST['gender'], $_POST["pwd"]);
}
require('Views/signup.phtml');