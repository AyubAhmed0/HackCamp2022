<?php
require 'Models/ExperimentDataSet.php' ;
require 'Models/User.php';
$view = new stdClass();
$ExperimentDataSet = new ExperimentDataSet(); 
$currenUserObj = new User();
$view->ExperimentDataSet = $ExperimentDataSet->fetchAllExperiments();
//$numberExpUser;
$numberExpUser = [];
//$userData;
if (isset($_GET['id'])) {
    $gotID = $_GET['id'];
    $numberExpUser = $currenUserObj->findExpById($gotID); 
    $userData = $currenUserObj->findUserById($gotID);
}
require 'Views/userProfile.phtml';
