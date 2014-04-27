<?php
	// -------------------------------------------------------------------------------
	// This file authenticate the transaction with userinformation 
	// -------------------------------------------------------------------------------
	
	// Connect to the database file is done in an external file
    require("config.php");
	
	// Set varibels from request commands, in the URL
	$cardno = $_REQUEST['cardno'];  
	$transactionno = $_REQUEST['transactionno']; 
	$status = $_REQUEST['status'];
		
	// Check for missing input
	if ($cardno === NULL or $transactionno === NULL or $status === NULL)
	  {
		 die( "error #2-1" . mysql_error());
	  }	
	
	// Check if vendor cancels the transaction 
  	if ($status === "canceled")
  	  {
  		 die( "error #2-2" . mysql_error());
  	  }	
	  
    if ($status != "authendicated")
      {
    	die( "error #2-3" . mysql_error());
		$status = "authendicated";
      }	 

//-------------------------- Check cardnumber -------------------------------			
	// Finds username and type from the cardnumber 			  
    $query1 = "SELECT username FROM cards WHERE cardno = '$cardno'"; 
	$resultq1 = mysql_query($query1);

	// Error if it could not find the userinformation
	if (mysql_num_rows($resultq1)==0) {
 	   die("error #2-4" . mysql_error());
	}		

	// Takes the result into an array and find the username and paymentmethod and saves it to varibels
	$infoq1 = mysql_fetch_array($resultq1);
	
	$username = $infoq1['username'];
	$paymentmethod ='StudentCard';// $infoq1["type"];
	
//-------------------------- ---------------- -------------------------------	

//-------------------------- Check sufficient funds -------------------------------		
	//Gets the balance from the user table
	$query3="SELECT balance FROM users WHERE username='$username'";
	$result3=mysql_query($query3) or die(mysql_error());	
  	
	if(! $result3 )
  	{
 	   die('error #2-5' . mysql_error());
  	}
	$infoq3=mysql_fetch_array($result3);

	$balance = $infoq3['balance'];	
	
	//Gets the amountof useage from the transactions table
	$query4="SELECT amount FROM transactions WHERE transactionno='$transactionno'";
	$result4=mysql_query($query4) or die(mysql_error());

	if(! $result4 )
  	{
 	   die("error #2-6" . mysql_error());
  	}
	
	$infoq4=mysql_fetch_array($result4);

	$amount = $infoq4['amount'];
	
	//calculate the balance after 
	$balanceafter = $balance - $amount;
	
	if ($balanceafter < 0)
		{
			die('error #2-7' . mysql_error());
		}	
//-------------------------- ---------------- -------------------------------		
		
				  
	// Updates the transaction with username, paymenttype and the status, for the transactionnumber 			  
	$query2 = "UPDATE transactions SET username = '$username', status = '$status', paymentmethod= '$paymentmethod' WHERE transactionno = '$transactionno'"; 
	$resultq2 = mysql_query($query2);


	// Error if it could not set the userinformation for the transaction
	if (!$resultq2) {
 	   die('error #2-8' . mysql_error());
	}
	
	//Print the transaction number as an confirmation
	print("Authendicated");
	$query5 = "UPDATE transactions SET status = 'Completed' WHERE transactionno = '$transactionno'"; 
	$resultq5 = mysql_query($query5);


	// Error if it could not set the userinformation for the transaction
	if (!$resultq5) {
 	   die('error #2-9' . mysql_error());
	}
	//http://188.226.133.180/api/swipeauth.php?cardno=123456&transactionno=544&status=authendicated
?>
