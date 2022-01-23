<?php
require 'Models/ExperimentDataSet.php' ;
require 'Models/Admin.php';


$currentAdmin = new Admin();
if(isset($_POST['sendData']) && isset($_POST['question']))
    {
        $numFields = $_SESSION['numFields'];
        echo $numFields;
        $optionsValues=[];
        echo $_POST['question'];
        //echo "Question: ".$question;
        $i=1;
        while($i<$numFields+1)
        {
                $options =  "option".$i;
                $optionsValues[] = $_POST[''.$options.'']; 
                $i++;
        }
        
        $commaOptions = implode(",", $optionsValues);
        //var_dump($commaOptions);
        $currentAdmin->createForm($commaOptions,$_POST['question']);
    }


require 'Views/createSurvey.phtml';