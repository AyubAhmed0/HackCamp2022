<?php
require 'Models/ExperimentDataSet.php' ;
require 'Models/Admin.php';


$currentAdmin = new Admin();

if(isset($_POST['createPrototype']))
{
    $type = "Prototype";
    $currentDate = date("Y/m/d");
    $currentAdmin->createExperiment($type, $_POST['name'], $_POST['totalTime'], $currentDate, $_POST['description'], $_POST['link']);
}
require 'Views/createPrototype.phtml';