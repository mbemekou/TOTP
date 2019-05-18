<?php 
include('server.php'); 
if (empty($_SESSION['ru'])) {
	header('location: register.php');
} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>TOTP QRCODE</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>QRCODE</h2>
	</div>
		<p>
			<?php echo '<center>Votre  QR-Code est:<br/><img src="'.$qr.'" /><br/></center>';
				session_destroy();
				unset($_SESSION['ru']);
				unset($_SESSION['rp']);
				unset($_SESSION['re']);				
			?>
			<center><a href="login.php">Se connecter</a></center>
		</p>



</body>
</html>
