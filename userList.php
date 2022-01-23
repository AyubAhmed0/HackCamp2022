<?php
require 'Models/ExperimentDataSet.php' ;
require 'Models/Admin.php';
$view = new stdClass();
$ExperimentDataSet = new ExperimentDataSet(); 
$currentAdmin = new Admin();
$view->ExperimentDataSet = $ExperimentDataSet->fetchAllExperiments();

if (!isset($currentAdmin->getAdminSession()['admin_email'])) {
    //no user session is found, so logout
header('Location: logoutAdmin.php');
//echo "User not found, error > user id and email do not exist in session";
exit;
}
$allUsers = $currentAdmin->getAllUsers();
require 'Views/userList.phtml';