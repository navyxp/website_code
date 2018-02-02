<?php
	session_start();

	if ( $_SESSION['logged_in'] != 1) {
	  $_SESSION['message'] = "You must log in before adding/editing data !";
	  header("location: /login/error.php");    
	}

        $active = $_SESSION['active'];
        if ( $active != 1) {
          $_SESSION['message'] = "Please Login First Or Verify your account (If Not Verified) by clicking on the activation link sent on your email id";
          header("location: /login/error.php");
        }

	else {
		$first_name = $_SESSION['first_name'];
		$last_name = $_SESSION['last_name'];
		$email = $_SESSION['email'];
		$active = $_SESSION['active'];		
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="/location/assets/css/main.css" />
                <link rel="icon" type="image/png" href="/images/fav.png">
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-81823138-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-81823138-2');
</script>

	</head>
	<body>

			<header id="header">
				<div class="inner">
					<a href="index.html"class="logo"><strong> <?php echo "Welcome ".$_SESSION['first_name']; ?></strong></a>
					<nav id="nav">
						<a href="/">Home</a>


                                               <?php   if ($_SERVER['REQUEST_URI'] != "/location/service/"){
                                                        echo "<a href=" . "/location/service/" . ">" . "View All Services" . "</a>";
                                                }
 
						if ($_SERVER['REQUEST_URI'] != "/location/add.php"){
							echo "<a href=" . "/location/add.php" . ">" . "Add New Service" . "</a>";
						}
						
						if ($_SERVER['REQUEST_URI'] != "/location/edit.php"){
							echo "<a href=" . "/location/edit.php" . ">" . "Edit Service" . "</a>";
						}
							
							
						if ($_SERVER['REQUEST_URI'] != "/location/"){
							echo "<a href=" . "/location/" . ">" . "Set Location" . "</a>";														
						}							
						?>
						<a href="/location/contrib.php">Contributers</a>
						
						<?php if (($_SESSION['logged_in'] == 1) && ($active ==1))
						{
							echo "<a href=" . "/login/logout.php" . ">" . "Logout" . "</a>";
						}
						else 
						{
							echo "<a href=" . "/login/" . ">" . "Login" . "</a>";
						}
						?>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>


			<section id="banner">
				<div class="inner">
					<?php 
						if ($_SERVER['REQUEST_URI'] == "/location/add.php"){
							echo "<font color=" . "white" . ">" . "<h3>Have Some information ? Help Others</h3></font>";
						}
						if ($_SERVER['REQUEST_URI'] == "/location/edit.php"){
							echo "<font color=" . "white" . ">" . "<h3>Edit Services</h3></font>";
						}						
						if ($_SERVER['REQUEST_URI'] == "/timing/add.php"){
							echo "<font color=" . "white" . ">" . "<h3>Add New Timings</h3></font>";
						}
					?>
				</div>				
			</section>

