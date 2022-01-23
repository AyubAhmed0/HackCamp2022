<?php
require 'Models/ExperimentDataSet.php' ;
require 'Models/Admin.php';


$currentAdmin = new Admin();

if(isset($_POST['createSurvey']))
{
    $type = "Survey";
    $currentDate = date("Y/m/d");
    //$currentAdmin->createExperiment($type, $_POST(['name']), $_POST(['totatlTime']), $currentDate, $_POST(['description']), $_POST(['link']));
    echo $type;
    echo $_POST(['name']);
    echo $_POST(['totatlTime']);
    echo $currentDate;
    echo $_POST(['description']);
    echo $_POST(['link']);
}

require 'Views/createSurvey.phtml';