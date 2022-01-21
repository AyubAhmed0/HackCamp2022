<?php
 session_start();
 unset($_SESSION['admin_id'],$_SESSION['admin_email']);
 //unset($_SESSION['adminID'],$_SESSION['adminEmail']);
 //destroying the session
 session_destroy();
 //redirect to log in page
 header("Location: adminlogin.php");
 exit;