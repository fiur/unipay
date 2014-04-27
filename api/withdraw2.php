<?php
	// -------------------------------------------------------------------------------
	// This file withdraw money from one account to another
	// -------------------------------------------------------------------------------
	
	// Connect to the database file is done in an external file
	require("config.php");

	// Set varibels from request commands, in the URL
	$transactionno = $_REQUEST['transactionno']; 
	$status = $_REQUEST['status'];

	//----------------------------- Validation of inputdata -------------------------------	
	// Check for missing input
	 if ($transactionno === NULL or $status === NULL)
	  {
		 die( "error #3-1" . mysql_error());
	  }
	  
    // Check if vendor cancels the transaction 
  	if ($status === "canceled")  	  
	  {  		 
		 die( "error #3-5" . mysql_error());  	  
	  }	 
	//---------------------------------------------------------------------------------		
	  
	  
  	// Finds username and type from the cardnumber 			  
     $query1 = "SELECT username,amount,status FROM transactions WHERE transactionno = '$transactionno'";
  	 $resultq1 = mysql_query($query1);

 	   	// Error if it could not find the userinformation
  	   	if (!$resultq1) {
   	   		die("error #3-2" . mysql_error());
  		}	
		
		// Fetch to the varibles
		$infoq1 = mysql_fetch_array($resultq1);
		$username = $infoq1['username'];
		$amount = $infoq1['amount'];
		$dbstatus = $infoq1['status'];
		
	 // Check the transaction is the right status
//	  	 if ($status != $dbstatus )
//	  	  {
//	    		 die( "error #3-8" . mysql_error());
//	  	  }
	     
		 if ($status != "authendicated")
	      {
	     	 die( "error #3-5" . mysql_error());
	      }	 
		 
	//-------------------------- Check sufficient funds -------------------------------		
		//Gets the balance from the user table
		$query3="SELECT balance FROM users WHERE username='$username'";
		$result3=mysql_query($query3) or die(mysql_error());	
  	
		if(! $result3 ){
	 	   die("error #3-3" . mysql_error());
	  	}
		
		// Fetch to the varibles
		$infoq3=mysql_fetch_array($result3);
		$balance = $infoq3['balance'];	
	
		//calculate the balance after 
		$balanceafter = $balance + $amount;
		
		// Check for funds on account
		if ($balanceafter < 0){
				die('error #3-4' . mysql_error());
		}	
	//---------------------------------------------------------------------------------		
	 
	//-------------------------- withdraw money from user -------------------------------		
	 //Skriv update query til at trække use fra brugeren.
	  if ($balanceafter >= 0){
 		 $sql = "UPDATE users SET balance ='$balanceafter' WHERE username = '$username'";
	  }	
	
	  else{
		  die('error #3-7' . mysql_error());
	  }
  
	  $retval = mysql_query( $sql );
	  if(! $retval )
	  {
		  die('Could not update data: ' . mysql_error());
	  }
	  
   	//---------------------------------------------------------------------------------	

	//Set status pending
 	$status = "Completed";
		
	// Make query for db (make transaction with amount, vendorid, description and status)
    $query5 = "UPDATE transactions SET status ='$status' WHERE transactionno = '$transactionno'";		
	
	//Run query	 
	$result5 = mysql_query($query5);
	
	if(! $result5 )
	{
		die('error#1-4' . mysql_error());
	}
	
		print("Transaction completed");
//http://188.226.133.180/api/withdraw2.php?transactionno=546&status=authendicated	  
?>


