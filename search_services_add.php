<?php
header("location: /location/");

// Include header file for displaying menu
// Include database connection
	require_once ('header.php');
//	include('dbConfig.php');
	include_once("database.php");
?>
<title>NavyXP | Add Service</title>

<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx   JQUERY STARTS  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

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
						        $('#area').html('<option value="">Select city first</option>'); 
						    }
						}); 
					}else{
						$('#city').html('<option value="">Select state first</option>');
						$('#area').html('<option value="">Select city first</option>'); 
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
						$('#area').html('<option value="">Select city first</option>'); 
					}
				});

			});
		</script>
		
<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx   JQUERY ENDS  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->


<?php

// Initialising All Variables

	$CITY=""; 
	$AREA="";
	$SERVICE=""; 
	$NAME=""; 
	$PHONE="";
	$ADDRESS=""; 
	$EMAIL="";
	$WEBSITE=""; 
	$OTHER_SERVICES=""; 
	$TAGS="";
	$ORG="";

// Capture data When Submit button is clicked

	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		// Capture City ID and Area ID after form Submission and convert it into corresponding name

		$city_id=$_POST["city"];	
		$query = $db->query("SELECT * FROM cities WHERE city_id = $city_id");
		$rowCount = $query->num_rows;	
		if($rowCount > 0)
		{
			while($row = $query->fetch_assoc())
			{	 
				$CITY = $row['city_name'];
			}
		}
				
		$area_id=$_POST["area"];
		$query = $db->query("SELECT * FROM areas WHERE area_id = $area_id");	
		$rowCount = $query->num_rows;
		if($rowCount > 0)
		{
			while($row = $query->fetch_assoc())
			{ 
				$AREA = $row['area_name'];
			}
		}
		
		$SERVICE = test_input($_POST["SERVICE"]);
		$NAME=test_input($_POST["NAME"]);
		$ORG=test_input($_POST["ORG"]);
		$PHONE=test_input($_POST["PHONE"]);

		$ADDRESS=test_input($_POST["ADDRESS"]);
		$EMAIL=test_input($_POST["EMAIL"]);
		$WEBSITE=test_input($_POST["WEBSITE"]);
		
		$OTHER_SERVICES=test_input($_POST["OTHER_SERVICES"]);
        $TAGS=test_input($_POST["TAGS"]);
	}

	// Sanitise Input Data

	function test_input($data) 
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	// Get Name of Logged in individual

	$UPDATED_BY = $first_name . " ". $last_name;

	//	SQL Command to Check if a Record already Exists and insert if it doesn't

	$sql = "SELECT 
			CITY, 
			AREA, 
			SERVICE, 
			NAME, 
			PHONE 
		FROM mail
		WHERE 
			(CITY LIKE '%$CITY%' AND
			AREA LIKE '%$AREA%' AND
			SERVICE LIKE '%$SERVICE%' AND
			NAME LIKE '%$NAME%' AND
			PHONE LIKE '%$PHONE%') ";	 

	if(isset($_POST['submit'])){

		$result = $connect->query($sql);

		if ($result->num_rows < 1) 
		{
			mysqli_query($connect, "INSERT INTO 
			mail(CITY, AREA, SERVICE, NAME, ORG, PHONE, ADDRESS, EMAIL, WEBSITE, OTHER_SERVICES,TAGS, UPDATED_BY) 
			VALUES('$CITY', '$AREA','$SERVICE', '$NAME', '$ORG', '$PHONE', '$ADDRESS', '$EMAIL', '$WEBSITE', '$OTHER_SERVICES', '$TAGS', '$UPDATED_BY')");

			header("Location:/location/service/");
		}

		else 
		{
			echo "<div class=\"header\">";
				echo "<h3>" . "<font color=" . "white" . ">" . "Record Already Exists" . "</font></h3>";
			echo "</div>";
		}			
	}
	
?>

<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx Form Starts Here xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

<div id="div1">
	<form method="post" action="add.php">  

		<?php				
			//Get all state data
			$query = $db->query("SELECT * FROM states WHERE status = 1 ORDER BY state_name ASC");
		
			//Count total number of rows
			$rowCount = $query->num_rows;
		?>
		
		<select name="state" id="state">
			<option value="">Select State</option>
				<?php
					if($rowCount > 0)
					{
						while($row = $query->fetch_assoc()){
						 
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
			<option value="">Select State first</option>
		</select>
		<br>
		
		<select name="area" id="area">
			<option value="">Select City first</option>
		</select>
		<br>

		<input type="text" name="SERVICE" pattern="[a-zA-Z\s]+" placeholder="Enter Service (Eg Plumber)" title="(Only Alphabets allowed)" value="<?php echo $SERVICE;?>">
		<br>
		<input type="text" name="NAME"  pattern="[a-zA-Z\s]+" placeholder="Name / Designation of Individual" title="(Only Alphabets allowed)" value="<?php echo $NAME;?>">
		<br>
		<input type="text" name="ORG" pattern="[a-zA-Z0-9,.\s]+" placeholder="Enter Firm / Organisation" title="(Only AlphaNumeric characters Comma and Fullstop allowed)" value="<?php echo $ORG;?>">
		<br>					
		<input type="tel" name="PHONE" placeholder="Enter Phone Number" pattern="[0-9,\s]+" title="(Only Numbers and Comma allowed)" value="<?php echo $PHONE;?>">
		<br>			
		<input type="text" name="ADDRESS" pattern="[a-zA-Z,-.\s]+" placeholder="Enter Address" title="(Some special characters not allowed)" value="<?php echo $ADDRESS;?>">
		<br>		  
		<input type="email" name="EMAIL" placeholder="Enter Email" value="<?php echo $EMAIL;?>">
		<br>	  
		<input type="text" name="WEBSITE" pattern="[a-zA-Z0-9.:/,\s]+" placeholder="Enter Website"  title="(Only Alphanumeric characters and dot allowed)" value="<?php echo $WEBSITE;?>">
		<br>  	  	  
		<input type="text" name="OTHER_SERVICES" pattern="[a-zA-Z,.\s]+" placeholder="Other Services provided"  title="(Some special characters not allowed)" value="<?php echo $OTHER_SERVICES;?>">
		<br>
        <input type="text" name="TAGS" pattern="[a-zA-Z0-9,-.\s]+" placeholder="Some Keywords to identify this service"  title="(Some special characters not allowed)" value="<?php echo $TAGS;?>">
        <br>
		<input type="submit" name="submit" value="Submit">  
	</form>
</div>

<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx Form Ends Here xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

<?php
	$connect->close();
	require_once ('footer.php');
?>
