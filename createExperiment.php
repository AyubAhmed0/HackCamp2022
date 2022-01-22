<?php

require 'Models/Admin.php';
$currentAdmin = new Admin();

if(isset($_POST['submitExperiment']))
{
  //echo "Pressed Experiment Button Create";
  $currentAdmin->createExperiment($_POST["experiment"], $_POST["title"], $_POST["totalTime"], $_POST["date"], $_POST['description'], $_POST["questionOne"]);
}
/*$items = array();
foreach($group_membership as $username) {
 $items[] = $username;
}*/
if(isset($_POST['buttonArray']))
{
  echo "<prev>",var_dump($_POST["id"]),"</prev>";
  
}
require 'Views/createExperiment.phtml';