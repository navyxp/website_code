<?php
	/* Displays user information and some useful messages */
	session_start();
	include_once('../location/database.php');
?>
	
<!DOCTYPE HTML>
<html>

	<head>
		<title>NavyXP | Timings</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="/location/assets/css/main.css" />
		<link rel="icon" type="image/png" href="/images/fav.png">

		<meta name="description" content="Timing of all Canteens and other Agencies" />
		<meta property="og:title" content="NavyXP | Timings" />
		<meta property="og:url" content="https://navyxp.com/location/" />
		<meta property="og:image" content="https://navyxp.com/images/logo.png" />
		<meta property="og:type" content="article" />
				
		<script src="/location/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#state').on('change',function(){
					var stateID = $(this).val();
					if(stateID){
						$.ajax({
						    type:'POST',
						    url:'ajaxData.php',
						    data:'state_id='+stateID,
						    success:function(html){
						        $('#city').html(html);
						        $('#area').html('<option value="">Select City First</option>'); 
						    }
						}); 
					}else{
						$('#city').html('<option value="">Select State first</option>');
						$('#area').html('<option value="">Select City first</option>'); 
					}
				});
		
				$('#city').on('change',function(){
					var cityID = $(this).val();
					if(cityID){
						$.ajax({
						    type:'POST',
						    url:'ajaxData.php',
						    data:'city_id='+cityID,
						    success:function(html){
						        $('#area').html(html);
						    }
						}); 
					}else{
						$('#area').html('<option value="">Select City First</option>'); 
					}
				});

			});
		</script>				
	</head>	
	
	
	<body>
		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="/"class="logo"><strong> <?php if ( $_SESSION['logged_in'] != 1 ) {echo "Get Timing of Canteens & others";} else {echo "Welcome ".$_SESSION['first_name'];} ?></strong></a>
				
					<nav id="nav">
						<a href="/">Home</a>
						<a href="/about-us/">About Us</a>
						<a href="/location/">Search Service</a>

					<!--	<a href="contact-us">Contact Us</a> -->
						<?php if ($_SESSION['logged_in'] == 1 )
						{
							echo "<a href=" . "/login/logout.php" . ">" . "Logout" . "</a>";
						}
						else {
							echo "<a href=" . "/login/" . ">" . "Login" . "</a>";
						}
						?>
						
						
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<form name="form1" method="post">  	
														
						<?php
						//Include database configuration file
				
						//Get all state data
						$query = $db->query("SELECT * FROM states WHERE status = 1 ORDER BY state_name ASC");
		
						//Count total number of rows
						$rowCount = $query->num_rows;
						?>
						<select name="state" id="state">
							<option value="">Select state</option>
							<?php
							if($rowCount > 0){
								while($row = $query->fetch_assoc())
								{ 
									echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
								}
							}
							else
							{
								echo '<option value="">state not available</option>';
							}
        					?>
        				
						</select>
						<br>
						<select name="city" id="city">
							<option value="">Select State First</option>
						</select>
						<br>
						<select name="area" id="area">
							<option value="">Select City First</option>
						</select>
						
						<br>			
												
						<input type="submit" name="update" value="Submit">

					</form>					
				</div>				
			</section>

<!-- ///////////// SQL COMMAND BEGINS /////////////////// -->

<?php

	if (empty($_POST["city"])) 
	{
		$city ="";
	}
	else 
	{
		$city = $_POST["city"];
	}

	if (empty($_POST["area"])) 
	{
		$org ="";
	}
	else 
	{
		$org = $_POST["area"];
	}


	if(isset($_POST['update']))
	{	
		$sql_rate = "SELECT * FROM timing WHERE 
		t_city_id LIKE '%$city%'
		AND t_org LIKE '%$org%'
		ORDER BY t_org ASC LIMIT 50"; 	 
		$result_rate = $connect->query($sql_rate);
	}
	
	else
		$sql_rate = "SELECT * FROM timing ORDER BY t_org ASC LIMIT 20"; 	 
		$result_rate = $connect->query($sql_rate);		
		
		
		while($row = $result_rate->fetch_assoc()) 
		{		
				$val=$row['t_service'];
				
				if ($val == "Army"){
					$col = "td_red";
				}
				
				if($val== "Navy"){
					$col = "td_blue";
				}
				
				if($val== "Air Force"){
					$col = "td_grey";
				}

			echo "<table>";
			
			if (!empty($row['t_org'])) 
			{
				echo "<tr>";		
				echo "<td id=\"$col\" colspan=\"2\">" . $row['t_org']  . "</td>";
				echo "</tr>";
			}			

			if (!empty($row['t_address'])) 
			{
				echo "<tr>";
				echo "<td width=\"25%\"><b>Address</b></td>";		
				echo "<td>" . $row['t_address'] . "</td>";
				echo "</tr>";
			}

			if (!empty($row['t_time1'])) 
			{
				echo "<tr>";
				echo "<td width=\"25%\"><b>Timing </b></td>";				
				echo "<td>" . $row['t_time1'] . "</td>";
				echo "</tr>";
			}

			if (!empty($row['t_time2'])) 
			{
				echo "<tr>";
				echo "<td width=\"25%\"></td>";		
				echo "<td>" . $row['t_time2']  . "</td>";
				echo "</tr>";
			}

			if (!empty($row['t_time3'])) 
			{
				echo "<tr>";
				echo "<td width=\"25%\"></td>";								
				echo "<td>" . $row['t_time3']  . "</td>";
				echo "</tr>";
			}

			if (!empty($row['t_time4'])) 
			{
				echo "<tr>";
				echo "<td width=\"25%\"></td>";								
				echo "<td>" . $row['t_time4']  . "</td>";
				echo "</tr>";
			}

			/*if (!empty($row['t_phone'])) 
			{
				echo "<tr>";	
				echo "<td width=\"25%\"><b>Contact</b></td>";					
				echo "<td>" . $row['t_phone']  . "</td>";
				echo "</tr>";
			}*/

	  		if (!empty($row['t_phone'])) {	
			        echo "<tr>";				
					echo "<td width=\"25%\"><b>Contact</b></td>";
					$phone=$row['t_phone'];
					// Separate 2 phone numbers and add individual link
					echo "<td>";
					$phone_array = explode(',', $phone);									
						foreach($phone_array as $phone) {
							echo '<a href="tel:'.$phone.'">'.'<b>'. $phone . '</b>' . '</a>'."&nbsp;";
						}
										
					echo "</td>";
				echo "</tr>";	
			}
			
			if (!empty($row['t_closed'])) 
			{
				echo "<tr>";	
				echo "<td width=\"25%\"><b><font color = \"red\">Closed On</font></b></td>";					
				echo "<td>" . $row['t_closed']  . "</td>";
				echo "</tr>";
			}			

			echo "<table>";
		}
		
		echo "<div style:height=20px;>";
			echo "&nbsp";
		echo "</div>";	
				
?>

</body>

<?php
	$connect->close();
	include ('../location/footer.php');
?>



