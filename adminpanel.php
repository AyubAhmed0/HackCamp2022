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
$usersCount=count($currentAdmin->getAllUsers());
$allUsers = $currentAdmin->getAllUsers();
$surveysCount=count($currentAdmin->getAllSurveys());
$pollsCount=count($currentAdmin->getAllPolls());
$discussionsCount=count($currentAdmin->getAllDiscussions());
$prototypesCount=count($currentAdmin->getAllPrototypes());
//echo "Users count = " . $surveysCount;
//var_dump($currentAdmin->getAllSurveyst(1));
//echo "hdhhf " . $currentAdmin->getAllSurveyst($u);
require 'Views/adminpanel.phtml';