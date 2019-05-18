
<?php include('server.php'); ?>
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
	<form method="post" action="login.php">

	<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Pseudo</label>
			<input type="text" name="username">

		</div>

		<div class="input-group">
			<label>Mot de passe</label>
			<input type="password" name="password">

		</div>
		
		<div class="input-group">
			<button type="submit" name="login" value="login" class="btn">Login</button>

		</div>
		<p>
			Deja inscrit?<a href="register.php">S'incrire</a>
		</p>
	</form>



</body>
</html>
