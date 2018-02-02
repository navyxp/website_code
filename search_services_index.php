<?php
	/* Displays user information and some useful messages */
	session_start();
	include_once("database.php");
//	include('dbConfig.php');	
	$connect->close();	
?>
	
<!DOCTYPE HTML>
<html>

	<head>
		<title>NavyXP | Search Services</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="/location/assets/css/main.css" />
		<link rel="icon" type="image/png" href="/images/fav.png">

<meta name="description" content="Contact of all Local Services at your doorstep" />
<meta property="og:title" content="NavyXP | Search Services" />
<meta property="og:url" content="https://navyxp.com/location/" />
<meta property="og:image" content="https://navyxp.com/images/logo.png" />
<meta property="og:type" content="article" />


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-81823138-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-81823138-2');
</script>


				
		<script src="jquery.min.js"></script>
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
						$('#city').html('<option value="">Select State First</option>');
						$('#area').html('<option value="">Select City First</option>'); 
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
					<a href="/"class="logo"><strong> <?php if ( $_SESSION['logged_in'] != 1 ) {echo "Search Local Services";} else {echo "Welcome ".$_SESSION['first_name'];} ?></strong></a>
				
					<nav id="nav">
						<a href="/">Home</a>
                                                <a href="/location/service/">View All Services</a>

						<a href="add.php">Add New Service</a>
						<a href="edit.php">Edit Service</a>
                                                <a href="/timing/">View Timings</a>
						
						<a href="/location/contrib.php">Contributers</a>
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
					<form name="form1" method="post" action="service/">  	
					
				
					
						<?php
						//Include database configuration file
				
						//Get all state data
						$query = $db->query("SELECT * FROM states WHERE status = 1 ORDER BY state_name ASC");
		
						//Count total number of rows
						$rowCount = $query->num_rows;
						?>
						<select name="state" id="state">
							<option value="">Select State</option>
							<?php
							if($rowCount > 0){
								while($row = $query->fetch_assoc()){ 
									echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
									//$rows=$row['state_name'];
									//echo "<input type=\"hidden\" name=\"state1\" id=\"state1\" value=\"$rows\" />";

								}
							}else{
								echo '<option value="">state not available</option>';
							}
        					?>
        				
						</select>
						<br><br>
						<select name="city" id="city">
							<option value="">Select State First</option>
						</select>
						<br><br>
						<select name="area" id="area">
							<option value="">Select City First</option>
						</select>
						
						<br><br>				
												
						<input type="submit" name="update" value="Submit">
                                               <br><br> <input type="submit" name="Refresh" value="Refresh" formaction="/location">

                                               
					</form>
					
				</div>				
			</section>
</body>

<?php
	require_once ('footer.php');
?>



