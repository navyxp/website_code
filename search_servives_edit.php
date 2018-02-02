<?php
header("location: /location/");

	require_once ('header.php');
?>

<title>NavyXP | Edit</title>

<?php

	include_once("database.php");

	if(isset($_POST['update']))
	{	
		$id = mysqli_real_escape_string($connect, $_POST['id']);
		$CITY= mysqli_real_escape_string($connect, $_POST['CITY']);	
		$AREA = mysqli_real_escape_string($connect, $_POST['AREA']);
	
		$SERVICE = mysqli_real_escape_string($connect, $_POST['SERVICE']);
		$NAME = mysqli_real_escape_string($connect, $_POST['NAME']);	
		$ORG = mysqli_real_escape_string($connect, $_POST['ORG']);
	
		$PHONE = mysqli_real_escape_string($connect, $_POST['PHONE']);
		$ADDRESS = mysqli_real_escape_string($connect, $_POST['ADDRESS']);	
		$EMAIL = mysqli_real_escape_string($connect, $_POST['EMAIL']);

		$WEBSITE = mysqli_real_escape_string($connect, $_POST['WEBSITE']);	
		$OTHER_SERVICES = mysqli_real_escape_string($connect, $_POST['OTHER_SERVICES']);
                $TAGS = mysqli_real_escape_string($connect, $_POST['TAGS']);


		$UPDATED_BY = $first_name . " ". $last_name; 	
	
		// checking empty fields
		if(empty($CITY) || empty($SERVICE) || empty($PHONE)) 
		{				
			if(empty($CITY)) {
				echo "<h2><font color='red'>CITY field is empty.</font></h2><br/>";
			}

			if(empty($SERVICE)) {
				echo "<h2><font color='red'>SERVICE field is empty.</font></h2><br/>";
			}		
		
			if(empty($PHONE)) {
				echo "<h2><font color='red'>PHONE field is empty.</font></h2><br/>";
			}				
		} 
	
		else 	
		{	
			//updating the table
			$result = mysqli_query($connect, "UPDATE mail SET 
			CITY='$CITY',
			AREA='$AREA',
			SERVICE='$SERVICE',
			NAME='$NAME',		
			ORG='$ORG',		
			PHONE='$PHONE',
			ADDRESS ='$ADDRESS',	
			EMAIL='$EMAIL',
			WEBSITE='$WEBSITE',
			OTHER_SERVICES='$OTHER_SERVICES',
                        TAGS='$TAGS',
			UPDATED_BY='$UPDATED_BY'		
			WHERE id='$id'");		
			//redirectig to page
			header("Location: edit.php");
		}
	}

	$id=$_POST['id'];

	//selecting data associated with this particular id
	$result = mysqli_query($connect, "SELECT * FROM mail WHERE id=$id");

	while($res = mysqli_fetch_array($result))
	{
		$CITY = $res['CITY'];
		$AREA = $res['AREA'];
		$SERVICE = $res['SERVICE'];
		$NAME = $res['NAME'];
	
		$PHONE = $res['PHONE'];
		$ADDRESS = $res['ADDRESS'];
	
		$EMAIL = $res['EMAIL'];
		$ORG = $res['ORG'];
	
		$OTHER_SERVICES = $res['OTHER_SERVICES'];	
		$WEBSITE = $res['WEBSITE'];	
                $TAGS = $res['TAGS'];
	}
	
	$connect->close();
?>

	
	<form name="form2" method="post">
		<table>
			<tr> 
				<td>
				<input type="text" placeholder="Enter Unique ID to Edit" name="id">
				<br>
				<input type="submit" name="update1" value="Search"></td>
			</tr>
		</table>
	</form>	

	
<?php include ('../assets/ads.php') ?>

<br \>
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Unique ID</td>
				<td><input type="text" name="id" value="<?php echo $id ;?>" readonly></td>
			</tr>

			<tr> 
				<td>City</td>
				<td><input type="text" name="CITY" value="<?php echo $CITY;?>"></td>
			</tr>
		
			<tr> 
				<td>Area</td>
				<td><input type="text" name="AREA" value="<?php echo $AREA;?>"></td>
			</tr>
			
			<tr> 
				<td>Service</td>
				<td><input type="text" name="SERVICE" value="<?php echo $SERVICE;?>"></td>
			</tr>

			<tr> 
				<td>Name</td>
				<td><input type="text" name="NAME" value="<?php echo $NAME;?>"></td>
			</tr>

			<tr> 
				<td>Firm / Organisation</td>
				<td><input type="text" name="ORG" value="<?php echo $ORG;?>"></td>
			</tr>
						
			<tr> 
				<td>Address</td>
				<td><input type="text" name="ADDRESS" value="<?php echo $ADDRESS;?>"></td>
			</tr>
						
			<tr> 
				<td>Email</td>
				<td><input type="text" name="EMAIL" value="<?php echo $EMAIL;?>"></td>
			</tr>
			
                        <tr>
                                <td>Website</td>
                                <td><input type="text" name="WEBSITE" value="<?php echo $WEBSITE;?>"></td>
                        </tr>


			<tr> 
				<td>Phone</td>
				<td><input type="text" name="PHONE" value="<?php echo $PHONE;?>"></td>
			</tr>	
			
			<tr> 
				<td>Other Services</td>
				<td><input type="text" name="OTHER_SERVICES" value="<?php echo $OTHER_SERVICES;?>"></td>
			</tr>
					
		
                        <tr>
                                <td>TAGS</td>
                                <td><input type="text" name="TAGS" value="<?php echo $TAGS;?>"></td>
                        </tr>
							 
			<input type="hidden" name="UPDATED_BY" value="<?php echo $UPDATED_BY;?>">
												
			<tr>
				<td>ACTION</td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
			
		</table>
	</form>



<?php
	require_once ('footer.php');
?>




