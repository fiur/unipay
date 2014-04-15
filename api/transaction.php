<?php

    require("config.php");
    $cardno = $_REQUEST['cardno'];
    $amount = $_REQUEST['amount'];
    $vendorid = $_REQUEST['vendorid'];
    $description = $_REQUEST['description'];
    
		
    $sql = "SELECT username,type FROM cards WHERE cardno = '$cardno'"; 
	
	$result = mysql_query($sql) or die(mysql_error());


	$info = mysql_fetch_array($result) or die(mysql_error());
	$username = $info['username'];
	$paymentmethod = $info["type"];
 	$status = "pending";
 
	
    $query = "INSERT INTO `transactions`(`username`, `paymentmethod`, `amount`, `vendorid`, `description`, `status`) VALUES ('$username','$paymentmethod','$amount','$vendorid','$description','$status')";
				 
$retval = mysql_query($query);
if(! $retval )
{
die('Could not create transaction:' . mysql_error());
}
  

	  
?>


