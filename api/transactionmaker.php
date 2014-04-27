	<?php
	// -------------------------------------------------------------------------------
	// This File create an unauthorized transaction, if it isen't allready existing, 
	// else it will delete it, and create a new one
	// -------------------------------------------------------------------------------

	// Connect to the database file is done in an external file
    require("config.php");
	
	// Set varibels from request commands, in the URL
    $amount = $_REQUEST['amount'];
    $vendorid = $_REQUEST['vendorid'];
    $description = $_REQUEST['description'];
	
	
	// Check for missing input
	if ($amount === NULL or $vendorid === NULL or $description === NULL)
	  {
		 die( "error#1-1" . mysql_error());
	  }	
	
	// Search for pending transactions with specific vendorid
	$query1 = "SELECT transactionno FROM transactions WHERE status = 'pending' OR 'authendicated' AND vendorid = '$vendorid'"; 
	$resultq1 = mysql_query($query1);

	// Error if an it could not delete the pending transactions
	if (!$resultq1) {
 	   die("error#1-2" . mysql_error());
	}	
	
	if((mysql_num_rows($resultq1)) > 0){	
		// Delete transactions there are pending at the moment.
		$delquery = "DELETE FROM `transactions` WHERE status = 'pending' OR status = 'authendicated' AND vendorid = '$vendorid'";
		$resultdelquery = mysql_query($delquery);
	
		// Error if an it could not delete the pending transactions
		if (!$resultdelquery) {
	 	   die("error#1-3" . mysql_error());
		}

	}
	// check if amount trying to withdraw is posetive 
	if($amount <=0 )
	{
		die('error#1-6' . mysql_error());
	}
	

	//Set status pending
 	$status = "Pending";
		
	// Make query for db (make transaction with amount, vendorid, description and status)
    $query2 = "INSERT INTO `transactions`(`amount`, `vendorid`, `description`, `status`) VALUES ('-$amount','$vendorid','$description','$status')";		
	
	//Run query	 
	$retval = mysql_query($query2);
	
	if(! $retval )
	{
		die('error#1-4' . mysql_error());
	}
	
	// Make query for db (find transactionumber from the transactions table, where there is an transaction table there are pending for this vendor.)
	$query3 = "SELECT transactionno FROM transactions WHERE status = 'pending' AND vendorid = '$vendorid'"; 
	
	if(! $query3 )
	{
		die('error#1-5' . mysql_error());
	}
	
	$result3 = mysql_query($query3) or die(mysql_error());
	$info3 = mysql_fetch_array($result3) or die(mysql_error());

	// Take the transactionnumber from the array and put it in a varibel
	$transactionno = $info3['transactionno'];
	
	//Print the transaction number as an confirmation
	print($transactionno);  
	
	//This is the string for calling this function. CHange the things between the = and &
	//http://188.226.133.180/api/transactionmaker.php?amount=10&vendorid=5&description=test
?>


