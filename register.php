
<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Systeme d'enregistrement d'utilisateurs</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>S'enregristrer</h2>
	</div>
	<form method="post" action="register.php">
		<!--validation errors-->
<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Pseudo</label>
			<input type="text" name="username"  >
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email"  >

		</div>

		<div class="input-group">
			<label>Mot de passe</label>
			<input type="password" name="password_1">

		</div>
		<div class="input-group">
			<label>Confirmer Mot de passe</label>
			<input type="password" name="password_2">

		</div>
		<div class="input-group">
			<button type="submit" name="register" value="submit" class="btn">Register</button>

		</div>
		<p>
			Deja Membre?<a href="login.php">Se connecter</a>
		</p>
	</form>


</body>
</html>