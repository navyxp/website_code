<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summarise your SE</title>
	<link rel="icon" type="image/png" href="/wp-content/uploads/2016/12/favicon-16x16-1.png">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" 	type="text/css" media="all">

		<link rel="stylesheet" type="text/css" href="style.css">
    
    
</head>
<body>
	<div class="container">
<div align = "center">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- RXP-AUTO -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6460140889486984"
     data-ad-slot="7420663759"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
</div>

 <div class="container"><div align="center">
	<button onclick=window.open('https://navyxp.com','_blank');>HOME</button>
		<button onclick=window.open('https://navyxp.com/7-cpc/officers','_blank');>7 CPC</button>
				<button onclick=window.open('https://navpay.gov.in','_blank');>NAVPAY</button>
	    		    	<button onclick="window.location.href='https://navyxp.com/se/'">SE Tool</button>

    <h1>SUMMARISE YOUR NAVPAY SE</h1>

</div></div><br>

	<div class="container">
		
        <?php
			if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID']))
			{
				include 'user.php';
				$user = new User();
				$conditions['where'] = array(
					'id' => $sessData['userID'],
				);
				$conditions['return_type'] = 'single';
				$userData = $user->getRows($conditions);
		?>
		<a href="/navpay/" class="logout"><b>Back</b></a>&nbsp;
				<a href="/navpay/calculate.php/" class="logout"><b>Calculate Summary</b></a>&nbsp;	
		<p></p>

		

<?php

	$field="fileToUpload";
	$i="1";
	$dir=$userData['first_name'];
	//echo $dir;
	mkdir($dir);

	function up()
	{
		//global $target_dir, $dir, $target_file, $uploadOk, $checkName, $_FILES, $field, $i, $array;
		global $dir, $field, $i ;

		$target_dir = "$dir/";
		$target_file = $target_dir . basename($_FILES["$field$i"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$checkName= basename($_FILES["$field$i"]["name"]);

		//echo $checkName;

		if ($_FILES["$field$i"]["size"] < 1) 
		{
			echo "<br>";
			echo "No File Selected. File -$i not uploaded. Please Select a File and then Upload.";
			echo "<br>";
			$uploadOk = 0;
		}

		elseif ($_FILES["$field$i"]["size"] > 1) 

		{
			$array=array('jan.pdf', 'feb.pdf', 'mar.pdf', 'apr.pdf', 'may.pdf', 'jun.pdf', 'jul.pdf', 'aug.pdf', 'sep.pdf', 'oct.pdf', 'nov.pdf', 'dec.pdf');
			if (!in_array($checkName,$array))
			//if ($checkName != "apr.pdf)
			{
				echo "<br>";
				echo "Sorry, your file name is " . $checkName . " which is in incorrect format.";
				echo "<br>";
				echo "Please upload SE in pdf format after renaming them using first three letters of Month in lowercase. Eg jan.pdf";
				$uploadOk = 0;
			}


			// Check file size
			if ($_FILES["$field$i"]["size"] > 500000) {
				echo "<br>";
				echo "Sorry, your file is too large.";
				echo "<br>";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "pdf") {
				echo "<br>";
				echo "Sorry, only PDF Files are allowed.";
				echo "<br>";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "<br>";
				echo "Sorry, Your File was not uploaded.";
				echo "<br>";
			// if everything is ok, try to upload file
			}

			else

			{
				if (move_uploaded_file($_FILES["$field$i"]["tmp_name"], $target_file)) 
				{
					echo "<br>";
                                        echo '<b style="color:green ;">  The file "'. basename( $_FILES["$field$i"]["name"]). '" has been uploaded.  </b>';
					//echo "The file ". basename( $_FILES["$field$i"]["name"]). " has been uploaded.";
					echo "<br>";
				}	
		
				else 
		
				{
					echo "<br>";
					echo "Sorry, there was an error uploading your file.";
					echo "<br>";
				}
			}
		}
	}


	for($i=1; $i<13; $i=$i+1)
	{
		up();
	}

?>				
		<?php }else{?>		    
			<h2>Login to Your Account</h2>
		<?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
			<div class="regisFrm">
				<form action="userAccount.php" method="post">
				<input type="email" name="email" placeholder="EMAIL" required="">
				<input type="password" name="password" placeholder="PASSWORD" required="">
				<div class="send-button">
					<input type="submit" name="loginSubmit" value="LOGIN">
				</div>
				</form>
			   	<p>Don't have an account? <a href="registration.php">Register</a></p>
			</div>
		<?php } ?>
                     
		</div>

<br>

<div class="container">

<div align = "center">

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<!-- RXP-AUTO -->

<ins class="adsbygoogle"

     style="display:block"

     data-ad-client="ca-pub-6460140889486984"

     data-ad-slot="7420663759"

     data-ad-format="auto"></ins>

<script>

(adsbygoogle = window.adsbygoogle || []).push({});

</script>

</div></div>

<br />
	</body>
</html>
