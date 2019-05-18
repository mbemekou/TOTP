<?php 
include('server.php');

if (empty($_SESSION['username'])) {
	header('location: login.php');
} 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Bienvenue</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Bienvenue dans le monde du TOTP</h2>
	</div>
	<div class="content">
		
		<?php if(isset($_SESSION['success'])): ?>

		<div class="error success">
			<h3>
				<?php
				echo $_SESSION['success'];
				unset($_SESSION['success']);
				?>
			</h3>
		</div>
		<?php endif ?>

		<?php if(isset($_SESSION['username'])): ?>

		<p>Bienvenue <strong><?php echo $_SESSION['username']; ?></strong></p>
		<p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
		<?php endif ?>



	</div>



</body>
</html>