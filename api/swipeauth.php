<?php
	// -------------------------------------------------------------------------------
	// This file authenticate the transaction with userinformation 
	// -------------------------------------------------------------------------------
	
	// Connect to the database file is done in an external file
    require("config.php");
	
	// Set varibels from request commands, in the URL
	$cardno = $_REQUEST['cardno'];  
	$transactionno = $_REQUEST['transactionno']; 
	
	// Check for missing input
	if ($cardno === NULL or $transactionno === NULL)
	  {
		 die( "Error -  Missing input" . mysql_error());
	  }	
	
	//Set status authorized
 	$status = "Authorized";
		
			
	// Finds username and type from the cardnumber 			  
    $query1 = "SELECT username,type FROM cards WHERE cardno = '$cardno'"; 
	$resultq1 = mysql_query($query1);


	// Error if it could not find the userinformation
	if (!$resultq1) {
 	   die('Error - Failed to search for userinformation: ' . mysql_error());
	}	
	
	
	// Finds username and type from the cardnumber 			  
    $query2 = "SELECT username FROM transactions WHERE transactionno = '$transactionno'"; 
	$resultq2 = mysql_query($query2);
	
	// Error if there is no transaction for the choosen transactionnumber
	if(mysql_num_rows($resultq2) == 0){
	   die('Error - Failed to search for transactionnumber' . mysql_error());  	
	}
	
	
	// Takes the result into an array and find the username and paymentmethod and saves it to varibels
	$info = mysql_fetch_array($resultq1);
	$username = $info['username'];
	$paymentmethod = $info["type"];	  
		
				  
	// Updates the transaction with username, paymenttype and the status, for the transactionnumber 			  
	$query3 = "UPDATE transactions SET username = '$username', status = '$status', paymentmethod= '$paymentmethod' WHERE transactionno = '$transactionno'"; 
	$resultq3 = mysql_query($query3);


	// Error if it could not set the userinformation for the transaction
	if (!$resultq3) {
 	   die('Error - Failed to set authendication details: ' . mysql_error());
	}
	else{
		//Print the transaction number as an confirmation
		print("Authentication set for transaction: $transactionno");  	
	}
	
?>