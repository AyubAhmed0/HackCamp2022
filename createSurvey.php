<?php
require 'Models/ExperimentDataSet.php' ;
require 'Models/Admin.php';


$currentAdmin = new Admin();

if(isset($_POST['createSurvey']))
{
    $type = "Survey";
    $currentDate = date("Y/m/d");
    $currentAdmin->createExperiment($type, $_POST['name'], $_POST['totalTime'], $currentDate, $_POST['description'], $_POST['link']);
}

require 'Views/createSurvey.phtml';