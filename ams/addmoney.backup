<?php
    require("config.php");
	if(empty($_SESSION['user'])) 
    {
        header("Location: http://188.226.164.238/logout.php");
        die("Redirecting to http://188.226.164.238/logout.php"); 
    }
	$username = $_SESSION['username'];
	$query = "SELECT * FROM users WHERE username = '$username'"; 
	 
$result = mysql_query($query) or die(mysql_error());


$info = mysql_fetch_array($result) or die(mysql_error());
    if(isset($_POST['update']))
{
	if(! $conn )
{
	die('Could not connect: ' . mysql_error());
}

	
	$add =$_POST['add'];
	
	$sql = "UPDATE users 
       SET balance =  balance + '$add'
       WHERE username = '$username'";
	   
	mysql_select_db('unipay');
	$retval = mysql_query( $sql, $conn );
	if(! $retval )
	{
	die('Could not update data: ' . mysql_error());
	}
	
	mysql_close($conn);
	}
	
	
     

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>UniPay User Handling System</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>


           
    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand" href="maindash.php">UniPay</a>

            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down">  <?php  echo $_SESSION['username'];	?></i></a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="userprofile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="cards.php"><i class="fa fa-gear fa-fw"></i> Cards</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="http://188.226.164.238/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!-- /.navbar-static-top -->

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="maindash.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
              
                    <li>
                        <a href="transactions.php"><i class="fa fa-table fa-fw"></i> Transactions</a>
                    </li>
                    <li>
                        <a href="addmoney.php"><i class="fa fa-money fa-fw"></i> Add money</a>
                    </li>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add credits to <?php print nl2br($_SESSION['username']); ?> 's account</h1>
                </div>
                <!-- /.col-lg-12 -->
				<h3>Your current balance is <span class="label label-success">
            <?php  
			print $info['balance'];
			?> </span></h3>
            </div>
            <!-- /.row -->
			
	
    <form action="addmoney.php" method="post"> 
	<br>	
	<div class="row">
	  <div class="col-lg-6">
	    <div class="input-group has-feedback">
		  <span class="input-group-addon"> Amount you want to add</span>
	  	  <input type="text" name="add" id="add "class="form-control" placeholder=" <?php print nl2br($info['balance']); ?>">
	      <span class="input-group-btn">
	      </span>
	    </div><!-- /input-group -->
	  </div><!-- /.col-lg-6 -->
	</div><!-- /.row -->
	<br>
	
	 <input type="submit"  name="update" class="btn btn-success" id="update" value="Add credits" />
    </form>
	
		
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Blank -->

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>
