<?php
    //destroying all the session variables.
    session_start();
    unset($_SESSION['user_id'],$_SESSION['email']);
    //destroying the session
    session_destroy();
    //redirect to log in page
    header("Location: index.php");
    exit;