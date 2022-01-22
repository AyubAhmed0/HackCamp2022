<?php
require 'Models/ExperimentDataSet.php' ;
require 'Models/Admin.php';
$view = new stdClass();
$ExperimentDataSet = new ExperimentDataSet(); 
$currentAdmin = new Admin();
$view->ExperimentDataSet = $ExperimentDataSet->fetchAllExperiments();
require 'Views/experiments/startExperiment.phtml';