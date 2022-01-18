<?php
require('Models/ExperimentDataSet.php');
require('Models/User.php');
$view = new stdClass();
$ExperimentDataSet = new ExperimentDataSet(); 
$currenUserObj = new User();
$view->ExperimentDataSet = $ExperimentDataSet->fetchAllExperiments(); 
if (isset($currenUserObj->getSession()['email'])) {
    //echo '<br>User ID and Email exist in the session<br>';
    //echo '<br'.$_SESSION('login');
    header('Location: dashboard.php');
}
else 
{
//no user session is found, so logout
header('Location: logout.php');
echo "User not found, error > user id and email do not exist in session";
exit;
}
require('Views/dashboardV.phtml');