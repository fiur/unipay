<?php 
    require("config.php"); 
    $submitted_username = ''; 
     
        $query = " 
            SELECT 
                id, 
                username, 
                password, 
                salt, 
                email 
            FROM users 
            WHERE 
                username = :username 
        "; 
        $query_params = array( 
            ':username' => $_REQUEST['username'] 
        ); 
         
        try{ 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $login_ok = false; 
        $row = $stmt->fetch(); 
        if($row){ 
            $check_password = hash('sha256', $_REQUEST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++){
                $check_password = hash('sha256', $check_password . $row['salt']);
            } 
            if($check_password === $row['password']){
                $login_ok = true;
            } 
         

        if($login_ok){ 
            unset($row['salt']); 
            unset($row['password']); 
            $_SESSION['user'] = $row;
            $_SESSION['username'] = $_REQUEST['username'];  
            header("Location: /ams/maindash.php"); 
            die("Redirecting to: /ams/maindash.php"); 
        } 
        else{ 
            print("Login Failed."); 
            $submitted_username = htmlentities($_REQUEST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
	
?> 
 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UniPay - Easy payment for educational institions</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	
	<!-- Add dialog CSS here -->
	<script src="assets/jquery/jquery-1.10.2.min.js"></script>
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/prettify/run_prettify.js"></script>
	<link href="assets/bootstrap-dialog/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
	<script src="assets/bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
</head>

<body>

    <!-- Side Menu -->
    <a id="menu-toggle" href="#" class="btn btn-primary btn-lg toggle"><i class="fa fa-bars"></i></a>
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-default btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand"><a data-toggle="modal" href="#login" >Login</a>
            </li>
            <li><a href="#top">Home</a>
            </li>
            <li><a href="#about">About</a>
            </li>
            <li><a href="#services">Services</a>
            </li>
            <li><a href="#contact">Contact</a>
            </li>
        </ul>
    </div>
    <!-- /Side Menu -->

    <!-- Full Page Image Header Area -->
    <div id="top" class="header">
        <div class="vert-text">
           	
		    <h1>UniPay</h1>
            <h3>
                <em>Make</em> Digital payment,
                <em>easier</em> for everybody</h3>
				
	        <a href="/ams/register.php" class="btn btn-default btn-lg">Register</a>
            <a href="#about" class="btn btn-default btn-lg">Find Out More</a>
			<a data-toggle="modal" href="#login" class="btn btn-default btn-lg">Login to you account</a>

			<div class="modal" id="login">
				<div class="modal-dialog">
					<div class="modal-content">
    					<div class="modal-header">
  						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
 						 <h4 class="modal-title">Login to your UniPay Account</h4>
 						</div>
						<form role="form" action="login.php" method="post">
 		 			<div class="modal-body">
							<div class="input-group input-group-lg">
								<span class="input-group-addon">Username</span>
								<input type="text" name="username" value="<?php $_REQUEST['username']; ?>" class="form-control" id="username" placeholder="Enter username">

								<span class="input-group-addon">Password</span>
								<input type="password" class="form-control" id="password" name="password" value="<?php $_REQUEST['password']; ?>" placeholder="Enter Password">
								
						 	</div>
							</div>
      			  			<div class="modal-footer">
								 <input type="submit" class="btn btn-info" value="Login" />  
						    	 <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
      				  	   </div>
						</form>
					  
     			   	</div>
    			</div>
			</div>
			
        </div>
    </div>
    <!-- /Full Page Image Header Area -->

    <!-- Intro -->
    <div id="about" class="intro">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h2>Mobile payment with your student card</h2>
                    <p class="lead">UniPay offer you the chance of paying for services around the university with your student card, every tryed to forget change for the coffee machine?, never-ever with Unipay. <a target="_blank" href="/moreinfo.php">Click here for more info</a>.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /Intro -->

    <!-- Callout -->
    <div class="callout">
        <div class="vert-text">
                    <h1>Our Service</h1>
                    <hr>
        </div>
    </div>
    <!-- /Callout -->

    <!-- Services -->
    <div id="services" class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-2 text-center">
                    <div class="service-item">
                        <i class="service-icon fa fa-rocket"></i>
                        <h3>Always around you</h3>
                        <p>Did your navigation system shut down in the middle of that asteroid field? We can repair any dings and scrapes to your spacecraft!</p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="service-item">
                        <i class="service-icon fa fa-magnet"></i>
                        <h3>User friendly</h3>
                        <p>Need to know how magnets work? Our problem solving solutions team can help you identify problems and conduct exploratory research.</p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="service-item">
                        <i class="service-icon fa fa-shield"></i>
                        <h3>Maximum security</h3>
                        <p>Planning a time travel trip to the middle ages? Preserve the space time continuum by blending in with period accurate armor and weapons.</p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="service-item">
                        <i class="service-icon fa fa-pencil"></i>
                        <h3>No transaction fee</h3>
                        <p>We've been voted the best pencil sharpening service for 10 consecutive years. If you have a pencil that feels dull, we'll get it sharp!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Services -->

    <!-- Callout -->
    <div class="callout">
        <div class="vert-text">
            <h1>Payment which fit your needs</h1>
        </div>
    </div>
    <!-- /Callout -->

    <!-- Portfolio -->
    <div id="portfolio" class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <h2>Where can you find our products?</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2 text-center">
                    <div class="portfolio-item">
                        <a href="#">
                            <img class="img-portfolio img-responsive" src="img/portfolio-1.jpg">
                        </a>
                        <h4>Case 1 - xxxxxx</h4>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="portfolio-item">
                        <a href="#">
                            <img class="img-portfolio img-responsive" src="img/portfolio-2.jpg">
                        </a>
                        <h4>Case 2 - xxxxxx</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2 text-center">
                    <div class="portfolio-item">
                        <a href="#">
                            <img class="img-portfolio img-responsive" src="img/portfolio-3.jpg">
                        </a>
                        <h4>Case 3 - xxxxxx</h4>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="portfolio-item">
                        <a href="#">
                            <img class="img-portfolio img-responsive" src="img/portfolio-4.jpg">
                        </a>
                        <h4>Case 4 - xxxxxx</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Portfolio -->

    <!-- Call to Action -->
    <div class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h3>The buttons below are impossible to resist.</h3>
                    <a href="#" class="btn btn-lg btn-default">Click Me!</a>
                    <a href="#" class="btn btn-lg btn-primary">Look at Me!</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Call to Action -->

    <!-- Map -->
    <div id="contact" class="map">
        <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe>
        <br />
        <small>
            <a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A"></a>
        </small>
        </iframe>
    </div>
    <!-- /Map -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <ul class="list-inline">
                        <li><i class="fa fa-facebook fa-3x"></i>
                        </li>
                        <li><i class="fa fa-twitter fa-3x"></i>
                        </li>
                        <li><i class="fa fa-dribbble fa-3x"></i>
                        </li>
                    </ul>
                    <div class="top-scroll">
                        <a href="#top"><i class="fa fa-circle-arrow-up scroll fa-4x"></i></a>
                    </div>
                    <hr>
                    <p>Copyright &copy; UniPay 2014</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- /Footer -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Custom JavaScript for the Side Menu and Smooth Scrolling -->
    <script>
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    </script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    </script>
	

</body>

</html>
