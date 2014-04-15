<?php 
    require("config.php"); 
    session_unset();
    header("Location: index.php"); 
    die("Redirecting to: index.php");
?>
