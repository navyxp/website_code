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
				$dir=$userData['first_name'];
		?>
		<a href="userAccount.php?logoutSubmit=1" class="logout"><b>Log out</b></a>
		<a href="/navpay/summary.php/" class="logout"><b>View Summary</b></a>
		
		<p></p><br />
        <h2>Welcome <?php echo $userData['first_name']; ?>!</h2>
        
        
        <p>Download Your SE (from March last year to Feb this year) in pdf format from  <a href = "https://navpay.gov.in" target="blank" title="NAVPAY">Navypay Website</a> using <font color="brown"> download</font> button at the bottom of Website</a>.  and place it in a folder in your Computer. Rename each file with its corresponding month. </p>

<p><font color="red">SE downloaded correctly</font> from Navpay should look like <a href="se.png" target="blank" title="Correct SE Format">this image.</a> Other formats will not work.</p>
        
        <p><font color= "blue"> <b>Please rename SE using only first 3 letters of the month</b> </font><br />
        For eg, <br />  SE of January Month should be renamed as jan.pdf  <br /> SE of February Month should be renamed feb.pdf <br /> 
        SE of September Month should be renamed sep.pdf and so on</p>
        
        <p>SE downloaded from Navpay contains no personal information like Rank, P No, Unit, or Account Number. Hence its safe to upload</p>		   
            
            
		<div class="upload">        	
		<form action="upload.php" method="post" enctype="multipart/form-data">
		<p>Select your renamed SE in pdf format to upload:</p>		

		
		<input type="file" name="fileToUpload1" id="fileToUpload1">
		<p></p>
		<input type="file" name="fileToUpload2" id="fileToUpload2">
		<p></p>
		<input type="file" name="fileToUpload3" id="fileToUpload3">
		<p></p>
		<input type="file" name="fileToUpload4" id="fileToUpload4">
		<p></p>
		<input type="file" name="fileToUpload5" id="fileToUpload5">
		<p></p>
		<input type="file" name="fileToUpload6" id="fileToUpload6">
		<p></p>
		<input type="file" name="fileToUpload7" id="fileToUpload7">
		<p></p>
		<input type="file" name="fileToUpload8" id="fileToUpload8">
		<p></p>
		<input type="file" name="fileToUpload9" id="fileToUpload9">
		<p></p>		
		<input type="file" name="fileToUpload10" id="fileToUpload10">
		<p></p>
		<input type="file" name="fileToUpload11" id="fileToUpload11">
<p></p>
                <input type="file" name="fileToUpload12" id="fileToUpload12">
                <p></p>
	
	
		<input type="submit" value="Upload" name="submit" style="float: right;" >
		
	<p><a href="https://navyxp.com/navpay/"><b><span>Reset</span><b></a></p>
		</form>    
		</div>
		
		
		
		
		
		
        <?php }
        
        else{?>
        
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



