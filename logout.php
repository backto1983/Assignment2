<?php
    #Start a session
    session_start();
    #Destroy the session
    session_destroy();
    header('location:mainPublicSite.php');
?>