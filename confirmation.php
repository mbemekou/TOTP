
<?php 
include('server.php');
if (empty($_SESSION['username']) && empty($_SESSION['secret'])) {
	header('location: login.php');
} 
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Se connecter</h2>
	</div>
	<form method="post" action="confirmation.php">

	<?php include('errors.php'); ?>


		<div class="input-group">
			<label>Code de confirmation</label>
			<input type="text" name="code">

		</div>
		
		<div class="input-group">
			<button type="submit" name="confirmer" class="btn">Confirmer</button>

		</div>
	</form>



</body>
</html>