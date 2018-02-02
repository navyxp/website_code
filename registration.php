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
		<h2>Create a New Account</h2>
		<?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
		<div class="regisFrm">
			<form action="userAccount.php" method="post">
				<input type="text" name="first_name" placeholder="UNIQUE USER NAME" required="">
				<input type="email" name="email" placeholder="EMAIL" required="">
				<input type="password" name="password" placeholder="PASSWORD" required="">
				<input type="password" name="confirm_password" placeholder="CONFIRM PASSWORD" required="">
				<div class="send-button">
					<input type="submit" name="signupSubmit" value="CREATE ACCOUNT">
				</div>
			</form>
		</div>
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
