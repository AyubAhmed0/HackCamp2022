<?php
require 'Models/ExperimentDataSet.php' ;
require 'Models/User.php';
$view = new stdClass();
$ExperimentDataSet = new ExperimentDataSet(); 
$currenUserObj = new User();
$view->ExperimentDataSet = $ExperimentDataSet->fetchAllExperiments();
$value=0;
$value = $currenUserObj->countExperiment();
//$currenUserObj->countExperiment();
if (!isset($currenUserObj->getSession()['email'])) {
    //no user session is found, so logout
header('Location: logout.php');
//echo "User not found, error > user id and email do not exist in session";
exit;
}
require 'Views/experiments/surveys.phtml';