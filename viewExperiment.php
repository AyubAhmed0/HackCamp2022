<?php
require 'Models/ExperimentDataSet.php' ;
require 'Models/User.php';
$view = new stdClass();
$ExperimentDataSet = new ExperimentDataSet(); 
$currenUserObj = new User();
$view->ExperimentDataSet = $ExperimentDataSet->fetchAllExperiments();
if (isset($_GET['id'])) {
    $gotID = $_GET['id'];
    $numberExpUser = $currenUserObj->findExpById($gotID); 
    $userData = $currenUserObj->findUserById($gotID);
    $currentExperiment = $currenUserObj->getExperiment($gotID);
    $currenUserObj->userExperiment($_SESSION['user_id'], $_GET['id']);
}
require 'Views/viewExperiment.phtml';