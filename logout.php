<?php
    session_start();
    //destroying all the session variables.
    unset($_SESSION['id'],$_SESSION['user_email']);
    //destroying the session
    session_destroy();
    //redirect to log in page
    header("Location: index.php");
    exit;