<?php
	require_once ('../location/header.php');
	include_once('../location/database.php');
?>
<title>NavyXP | Add Data</title>
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
<?php
	$t_city_id=""; 
	$t_address="";
	$t_org=""; 
	$t_service=""; 
	$t_time1="";
	$t_time2=""; 
	$t_time3="";
	$t_time4=""; 
	$t_phone="";
	$t_closed="";
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (empty($_POST["city"])) 
		{
			$t_city_id ="";
		}
		else 
		{
			$t_city_id = $_POST["city"];
		}
			
		$t_org = test_input($_POST["t_org"]);
		$t_service=test_input($_POST["t_service"]);
		$t_address=test_input($_POST["t_address"]);
		$t_closed=test_input($_POST["t_closed"]);
	
		$t_time1=test_input($_POST["t_time1"]);
		$t_time2=test_input($_POST["t_time2"]);
		$t_time3=test_input($_POST["t_time3"]);
		$t_time4=test_input($_POST["t_time4"]);

		$t_phone=test_input($_POST["t_phone"]);
	}

	function test_input($data) 
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}


	$t_city = "0";

	$sql = "SELECT 
			t_city, 
			t_org  
		FROM timing
		WHERE 
			(t_city LIKE '%$t_city%' AND
			t_org LIKE '%$t_org%') ";	 

	if(isset($_POST['submit'])){

		$result = $connect->query($sql);

		if ($result->num_rows < 1) 
		{
			mysqli_query($connect, "INSERT INTO 
			timing (t_city, t_address, t_org, t_service, t_closed, t_time1, t_time2, t_time3, t_time4 ,t_phone,t_city_id) 
			VALUES('$t_city', '$t_address','$t_org', '$t_service', '$t_closed', '$t_time1', '$t_time2', '$t_time3', '$t_time4', '$t_phone', '$t_city_id')");

			header("Location:/timing/");
		}

		else 
		{
			echo "<div class=\"header\">";
				echo "<h3>" . "<font color=" . "white" . ">" . "Record Already Exists" . "</font></h3>";
			echo "</div>";
		}			
	}
	
?>

<div id="div1">
	<form method="post">  

		<?php				
			$query = $db->query("SELECT * FROM states WHERE status = 1 ORDER BY state_name ASC");
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
		<select name="city" id="city" required>
			<option value="">Select State first</option>
		</select>
		<br>

		<input type="text" name="t_org" pattern="[a-zA-Z\s]+" placeholder="Enter Canteen" title="(Only Alphabets allowed)" required autocomplete="off" value="<?php echo $t_org;?>">
		<br>
		
		<select name = "t_service" required>
			<option value="">Select Service</option>
			<option value="Army">Army</option>
			<option value="Navy">Navy</option>
			<option value="Air Force">Air Force</option>
		</select>		
		
		<br>
		<input type="text" name="t_address"  pattern="[a-zA-Z0-9,:.\s]+" placeholder="Address" title="(Only Alphabets allowed)" required autocomplete="off" value="<?php echo $t_address;?>">
		<br>
		<input type="text" name="t_closed" pattern="[a-zA-Z0-9,:.\s]+" placeholder="Closed On" title="(Only AlphaNumeric characters Comma and Fullstop allowed)" autocomplete="off" value="<?php echo $t_closed;?>">
		<br>					
		<input type="text" name="t_time1" pattern="[a-zA-Z0-9,-:.\s]+" placeholder="Enter Timing (Line 1)" title="(Only Numbers and Comma allowed)" required value="<?php echo $t_time1;?>">
		<br>			
		<input type="text" name="t_time2" pattern="[a-zA-Z0-9,-:.\s]+" placeholder="Enter Timing (Line 2)" title="(Some special characters not allowed)" value="<?php echo $t_time2;?>">
		<br>		  
		<input type="text" name="t_time3" pattern="[a-zA-Z0-9,-:.\s]+" placeholder="Enter Timing (Line 3)" value="<?php echo $t_time3;?>">
		<br>	  
		<input type="text" name="t_time4" pattern="[a-zA-Z0-9,-:.\s]+" placeholder="Enter Timing (Line 4)"  title="(Only Alphanumeric characters and dot allowed)" value="<?php echo $t_time4;?>">

		<br>
        <input type="text" name="t_phone" pattern="[a-zA-Z0-9,-:.\s]+" placeholder="Phone"  title="(Some special characters not allowed)" autocomplete="off" value="<?php echo $t_phone;?>">
        <br>
		<input type="submit" name="submit" value="Submit">  
	</form>
</div>
<?php
	$connect->close();
	require_once ('../location/footer.php');
?>
