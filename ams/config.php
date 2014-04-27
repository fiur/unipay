<?php 

    // These variables define the connection information for your MySQL database 
    $username = "root"; 
    $password = "unipay"; 
    $host = "localhost"; 
    $dbname = "unipay"; 
    
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
    try { $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); } 
    catch(PDOException $ex){ die("Failed to connect to the database: " . $ex->getMessage());} 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    header('Content-Type: text/html; charset=utf-8'); 
    mysql_connect($host,  $username, $password) or die(mysql_error()); 
	// Changed from fixed info to varibles
	$conn = mysql_connect($host, $username, $password);
    mysql_select_db($dbname) or die(mysql_error()); 
    session_start(); 
?>
