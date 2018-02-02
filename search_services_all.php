<?php

	// Start Session and Include database connection

	session_start();
	include_once("../database.php");
        include('../dbConfig.php');
	
        // Initialising All Variables

	$url = "/location/";

	// If referer of page is /location/ then store City and Area in Session Variable
	
	if ($_SERVER['HTTP_REFERER'] == "https://navyxp.com/location/")
	{
		if (empty($_POST["city"])) 
		{
			$CITY ="";
			$_SESSION['CITY']="";
		}
	
		else
		{			
			$city_id=$_POST["city"];	
			$query = $db->query("SELECT * FROM cities WHERE city_id = $city_id");
			$rowCount = $query->num_rows;
	
			if($rowCount > 0)
			{
				while($row = $query->fetch_assoc())
				{	 
					$_SESSION['CITY'] = $row['city_name'];
					$CITY = $_SESSION['CITY'];
				}
			}	
		}

		
		if (empty($_POST["area"])) 
		{
			$AREA ="";
			$_SESSION['AREA']="";
		}
	
		else
		{
			$area_id=$_POST["area"];
			$query = $db->query("SELECT * FROM areas WHERE area_id = $area_id");
	
			$rowCount = $query->num_rows;
			if($rowCount > 0)
			{
				while($row = $query->fetch_assoc())
				{ 
				$_SESSION['AREA'] = $row['area_name'];
				$AREA = $_SESSION['AREA'];
				}
			}
		}
	} /* If Ends */


	// Sanitise Input field for Service
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (empty($_POST["SERVICE"])) 
		{
			$SERVICE = "";
		}	
		else
		{
			$SERVICE = test_input($_POST["SERVICE"]);
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z ]*$/",$SERVICE)) 
			{
				$_SESSION['message'] = "Please enter only alphabets";
				header("location: error.php");
			}
		}
		
		$AREA = $_SESSION['AREA'];
		$CITY = $_SESSION['CITY'];	
				
	} /* If Ends */

	function test_input($data) 
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>



<!DOCTYPE HTML>
<html>
	<head>
		<title>NavyXP | Services</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="/location/assets/css/main.css" />
		<link rel="icon" type="image/png" href="/images/fav.png">
		
		<meta name="description" content="Contact of all Local Services at your doorstep" />
		<meta property="og:title" content="NavyXP | Search Services" />
		<meta property="og:url" content="https://navyxp.com/location/service/" />
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

	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="/"class="logo"><strong> <?php if ( $_SESSION['logged_in'] != 1 ) {echo "Oneness of Purpose";} else {echo "Welcome ".$_SESSION['first_name'];} ?></strong></a>
					<nav id="nav">
						<a href="/">Home</a>
						<a href="/location/">Change Location</a>
						<a href="/location/add.php">Add New Service</a>
						<a href="/location/edit.php">Edit Service</a>
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
					<?php echo "$CITY" . "\t" . "$AREA" ; ?>
					<?php echo "<br>"; ?>
					<?php echo '<a href="'. $url . '">'. "<font size = 1.5em>". "Change Location" ."</font>" .'</a>' ?>
					
					<form name="form1" method="post">  		
						<input type="text" name="SERVICE" pattern="[a-zA-Z\s]+" placeholder="Search the Service you want">
						<input type="hidden" name="CITY">
						<input type="hidden" name="AREA">
						<br>	  			
						<input type="submit" name="update" value="Submit">	
					</form>
				</div>				
			</section>


<!-- Command -->

<?php

///////////// SQL COMMAND BEGINS ///////////////////
if(isset($_POST['update']))
{
$sql = "SELECT *
		FROM mail 
		WHERE 
			(SERVICE LIKE '%$SERVICE%' OR
			ORG LIKE '%$SERVICE%' OR
			NAME LIKE '%$SERVICE%' OR
                        TAGS LIKE '%$SERVICE%' OR
			OTHER_SERVICES LIKE '%$SERVICE%') AND
			(CITY LIKE '%$CITY%' AND
			AREA LIKE '%$AREA%')			
		ORDER BY id DESC 
		LIMIT 100";
}
else 
{
$sql = "SELECT *		
		FROM mail 
		WHERE 
			(SERVICE LIKE '%$SERVICE%' OR
			OTHER_SERVICES LIKE '%$SERVICE%') AND
			(CITY LIKE '%$CITY%' AND
			AREA LIKE '%$AREA%')
		ORDER BY id DESC 
		LIMIT 10";
}		
//////////////// SQL COMMAND ENDS /////////////////////

$result = $connect->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {        
		echo "<table id=\"t1\" align=\"center\" border=\"1\">";  

		// Display Average Rating on Top with appropriate color

		$id=$row['id'] ;
		$sql_rate = "SELECT s_id, AVG(r_rate) FROM reviews WHERE s_id=$id"; 	 
		$result_rate = $connect->query($sql_rate);
		while($row_rate = $result_rate->fetch_assoc()) 
		{
			if ($row_rate['AVG(r_rate)'] !=0)
			{									
				$val=round($row_rate['AVG(r_rate)']);
				
				if ($val >= 8){
					$col = "td_green";
				}
				
				if(($val >= 5) && ($val <=7)){
					$col = "td_yellow";
				}
				
				if($val<=4){
					$col = "td_red";
				}
					
				echo "<tr><td id=\"$col\">";
					echo "AVERAGE RATING : " . $val . " / 10 ". "<br>";
					//echo "<br />";
				echo "</td></tr>";								
			}
			else {
				echo "<tr><td id=\"td_grey\">";
					echo "AVERAGE RATING : " . " Not Available ". "<br>";
				echo "</td></tr>";			
			}
		}
	
			// Display Name 
			
			echo "<tr>";
			if (!empty($row['NAME'])) {		
				echo "<td>" . '<b>'. $row['SERVICE']  . '</b>'. " Service by ". '<b>' . $row['NAME'] . "</b>" . "</td>";
                $name = "Name : " . $row['NAME'] . "%0A" ;
                $name_view = $row['NAME'];
			}
			else {
				echo "<td>" . '<b>'. $row['SERVICE'] . "</td>";	
			}
			echo "</tr>";

			//Display Organisation

	  		if (!empty($row['ORG'])) {		
				echo "<tr>";
					echo "<td>" . '<b>'. " ORGANISATION : " . '</b>' . $row['ORG'] . "</td>";
				echo "</tr>";
				$org = "Org : " . $row['ORG'] . "%0A" ;
                $org_view = $row['ORG'];				

			}
			else {$org=""; $org_view ="";}

			// Display Phone Number

	  		if (!empty($row['PHONE'])) {	
				echo "<tr>";				
					echo "<td>". '<b>'. " PHONE : " . '</b>';
					$phone=$row['PHONE'];
					
					// Separate 2 phone numbers and add individual link
					
					$phone_array = explode(',', $phone);									
						foreach($phone_array as $phone) {
							echo '<a href="tel:'.$phone.'">'.'<b>'. $phone . '</b>' . '</a>'."&nbsp;";
						}				
					echo "</td>";
				echo "</tr>";	
				$fon = "Phone : " . $row['PHONE'] . "%0A" ;
				$phone_view = $row['PHONE'];	

			}
			else {$fon=""; $phone_view="";}

			// Display Address 
			
			if (!empty($row['ADDRESS'])) {
				echo "<tr>";
					echo "<td>" . '<b>'. " ADDRESS : " . '</b>' . $row['ADDRESS'] . "</td>";
				echo "</tr>";
				$address =  "Address : " . $row['ADDRESS']. "%0A" ;
				$address_view = $row['ADDRESS'];

			}
			else {$address=""; $address_view="";}

			// Display Email
			
	  		if (!empty($row['EMAIL'])) {					
				echo "<tr>";
					echo "<td>" . '<b>'. " EMAIL : " . '</b>' . $row['EMAIL'] . "</td>";
				echo "</tr>";
			}	

			// Display Website

            if (!empty($row['WEBSITE'])) {
            	echo "<tr>";
            	//	echo "<td>" . '<b>'. " WEBSITE : " . '</b>' . $row['WEBSITE'] . "</td>";
            		$web=$row['WEBSITE'] ;
            		echo "<td>" . '<b>'. " WEBSITE : " . '</b>' . "<a href=\"$web\" target=\"blank\">" . " Website Link " . "</a>" . "</td>";
                echo "</tr>";
            }

			// Display Other Services

	  		if (!empty($row['OTHER_SERVICES'])) {
				echo "<tr>";
					echo "<td>" . '<b>'. " OTHER SERVICES : " . '</b>' . $row['OTHER_SERVICES'] . "</td>";
				echo "</tr>";	
				$o_service =  "Other Services : " . $row['OTHER_SERVICES']. "%0A" ;	

			}
			else {$o_service="";}

			// Store formatted data in variables for sharing on WhatsApp

			$service =  "Service : " . $row['SERVICE']. "%0A" ;
			$service_view = $row['SERVICE'];						
		
			$loc = "Search More at "."https://navyxp.com/location/" . "%0A". "%0A" ;		

			// WhatsApp Link to share data

			echo "<tr>";

				echo "<td>" . '<b>'. "UNIQUE ID " . '</b>' .  $row['id'] . '<b>'. " UPDATED BY : " . '</b>' . $row['UPDATED_BY'] ." ". 
				"<span style=\"float:right;\">" . 
				"<a href=\"whatsapp://send?text=$loc" ."$name"."$org"."$fon". "$service"."$o_service". "$address\">Share on<img src=\"whatsapp.jpg\" style=\"width:25px;height:25px;\"> </a>". 
				"</span>" . 
				"</td>";

			echo "</tr>";	

			// Write Review	Button		
			
			echo "<tr>";
				echo "<td>";
				$id=$row['id'];
					echo "<form name=\"form10\" method=\"post\" action=\"review.php\" target=\"_blank\" >";
						echo "<input type=\"hidden\" name=\"id\" value=\"$id\" >";
						echo "<input type=\"hidden\" name=\"name\" value=\"$name_view\" >";
						echo "<input type=\"hidden\" name=\"org\" value=\"$org_view\" >";
						echo "<input type=\"hidden\" name=\"phone\" value=\"$phone_view\" >";
						echo "<input type=\"hidden\" name=\"service\" value=\"$service_view\" >";
						echo "<input type=\"hidden\" name=\"address\" value=\"$address_view\" >";
						echo "<input type=\"submit\" class=\"s1\" name=\"review\" value=\"Write Review\">";  		
					echo "</form>";
			
			// See Review	Button
				
					echo "<form name=\"form10\" method=\"post\" action=\"view.php\" target=\"_blank\" >";
						echo "<input type=\"hidden\" name=\"id\" value=\"$id\" >";
						echo "<input type=\"hidden\" name=\"name\" value=\"$name_view\" >";
						echo "<input type=\"hidden\" name=\"org\" value=\"$org_view\" >";
						echo "<input type=\"hidden\" name=\"phone\" value=\"$phone_view\" >";
						echo "<input type=\"hidden\" name=\"address\" value=\"$address_view\" >";
						echo "<input type=\"hidden\" name=\"service\" value=\"$service_view\" >";
						echo "<input type=\"submit\" class=\"s1\" name=\"review\" value=\"See Review\">";  		
					echo "</form>";
				echo "</td>";
			echo "</tr>";
							
		echo "</table>"; 
	 	 		 
		echo "<div style:height=20px;>";
			echo "&nbsp";
		echo "</div>";
      
    }       
} 
?>


<?php
	$connect->close();
	require_once ('../footer.php');
?>
