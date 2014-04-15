<?php
	// -------------------------------------------------------------------------------
	// This file authenticate the transaction with userinformation 
	// -------------------------------------------------------------------------------
	
	// Connect to the database file is done in an external file
	require("config.php");

	// Set varibels from request commands, in the URL
	$id = $_REQUEST['id'];
	$use = $_REQUEST['use'];
	
	// Retrieve all the data from the "example" table
	$result = mysql_query("SELECT username FROM cards WHERE cardno='$id'")
	or die(mysql_error()); 

	// store the record of the "example" table into $row
	$row = mysql_fetch_array( $result );
	// Print out the contents of the entry 

	if ($id === NULL or $use === NULL)
 	 {
 		echo "Error - Missing variables ";
		 die(mysql_error());
 	 }	

	 $username = $row['username'];
	 $sql="SELECT balance FROM users WHERE username='$username'";
	 $sqlquerry=mysql_query($sql) or die(mysql_error());
	 $result2=mysql_fetch_array($sqlquerry);
	 $balance = $result2['balance'];
	 $balanceafter = $balance- $use;
	 echo $balance."#".$use."#";

	 if ($balance>$use)
	  {
		  //Skriv update query til at trække use fra brugeren.
 		 $sql = "UPDATE users SET balance ='$balanceafter' WHERE username = '$username'";
		  echo "There have been withdrawn ".$use." from you account. :)";
	  }	
	  else
	  {
		  echo "error - insufficient funds";
	  }
  
	  $retval = mysql_query( $sql );
	  if(! $retval )
	  {
		  die('Could not update data: ' . mysql_error());
	  }
  
  	//http://188.226.164.238/api/readfromdb3.php?id=stefan&use=140
	  
?>


