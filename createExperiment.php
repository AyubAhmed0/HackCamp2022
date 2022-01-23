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
if(isset($_POST['surveyBtn']))
{
  header('Location: createSurvey.php');
}
elseif(isset($_POST['pollBtn']))
{
  header('Location: createPoll.php');
}
elseif(isset($_POST['dicussionBtn']))
{
  header('Location: createDiscussion.php');
}
elseif(isset($_POST['prototypeBtn']))
{
  header('Location: createPrototype.php');
}
require 'Views/createExperiment.phtml';