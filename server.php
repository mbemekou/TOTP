<?php
	session_start();

	$errors = [];
	try{
//	$db=new PDO("mysql:host=ec2-34-244-101-12.eu-west-1.compute.amazonaws.com;dbname=registration","root","root");
		$db=new PDO("mysql:host=localhost;dbname=registration","root","root");
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e) {
		die('Erreur:'.$e->getMessage());
	}



	if(isset($_SESSION['ru'])&& isset($_SESSION['rp']) && isset($_SESSION['re']) ){
		require_once 'GoogleAuthenticator.php';

		$username=$_SESSION['ru'];
		$password=$_SESSION['rp'];
		$email=$_SESSION['re'];
		$websiteTitle = 'ProjetTOTPFred';

		$ga = new PHPGangsta_GoogleAuthenticator();

		$secret = $ga->createSecret();
		$qr = $ga->getQRCodeGoogleUrl($websiteTitle, $secret);
		$sql = "INSERT INTO users (username,email,password,secret) VALUES ('$username','$email','$password','$secret')";
		//mysqli_query($db, $sql);
		$result=$db->prepare($sql);
		$result->execute();

		//echo 'Votre  QR-Code est:<br /><img src="'.$qr.'" />';

		//$myCode = $ga->getCode($secret);
		//$result = $ga->verifyCode($secret, $myCode, 1);
	//third parameter of verifyCode is a multiplicator for 30 seconds clock tolerance


	//if ($result) {
	  // echo 'Verified';
	//} else {
	//   echo '<br />Not verified';
	//}


	}




	if(isset($_POST['register'])){

		$username = $_POST['username'];
		$email = $_POST['email'];
		$password_1= $_POST['password_1'];
		$password_2= $_POST['password_2'];
		if (empty($username)) {
			array_push($errors, "le pseudo est obligatoire!");
		}

		if (empty($email)) {
			array_push($errors, "l'email est obligatoire");
		}
		if (empty($password_1)) {
			array_push($errors, "le mot de passe est obligatoire!");
		}
		if ($password_1 != $password_2) {
			array_push($errors, "le mot passe et le mot de passe de confirmation doivent correspondre!");
		}
		if (count($errors) == 0) {
			$password = md5($password_1);
			$_SESSION['ru']=$username;
			$_SESSION['rp']=$password;
			$_SESSION['re']=$email;
			$_SESSION['count']=1;
			header("location: generate.php");

		}
	}
	if (isset($_POST['login'])) {

		$username=$_POST['username'];
		$password=$_POST['password'];
		if(empty($username)){
			array_push($errors, "Pseudo requis !");
		}
		if(empty($password) ){
			array_push($errors, "Mot de passe requis!");

		}
		if (count($errors)==0) {
			$password =md5($password);
			//$query="SELECT * FROM users WHERE username='$username' AND password='$password'";
			//$result=mysqli_query($db,$query);
			$query=$db->prepare("SELECT * from users WHERE username='$username' AND password='$password'");
			$query->execute();

			//$result=$db->prepare($query);
			//$result->execute();
			$result=$query->fetch(PDO::FETCH_ASSOC);
			$ls=$result['secret'];
			$lu=$result['username'];
			
			//if(mysqli_num_rows($result)==1){
			if (! empty($ls) && ! empty($lu)) {
	
				$_SESSION['secret']=$ls;

				//$query="SELECT secret FROM users WHERE username='$username' AND password='$password'";
				//$result = $db->prepare($query);
				//$result->execute();

				//$_SESSION['secret']=$result->execute();
				$_SESSION['username']=$lu;
				//$_SESSION['secret'] = mysqli_query($db,$query);
				header('location: confirmation.php');
				$_SESSION['max_try']=3;
				//$_SESSION['success']="You are now logged in";
				//header('location: index.php');
			}
			else{
				array_push($errors, "Mauvais Pseudo ou Mot de passe");
			}
		}
	}


	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header('location: login.php');
		# code...
	}
	

		if (isset($_POST['code'])) {
			require_once 'GoogleAuthenticator.php';
			$code = $_POST['code'];
			$secret=$_SESSION['secret'];
			$ga = new PHPGangsta_GoogleAuthenticator();
			$result = $ga->verifyCode($secret, $code);

			if ($result == 1) {
				$_SESSION['success']="you are now logged in";
				header('location: index.php');
			}
			else {
				$_SESSION['max_try']=$_SESSION['max_try']-1;
				array_push($errors, "code de confirmation incorrect!<br/>Attention il vous reste<br/>".$_SESSION['max_try']."essaies!<br/>" );

			}
			if ($_SESSION['max_try']==0) {
				session_destroy();
				unset($_SESSION['username']);
				unset($_SESSION['max_try']);
				unset($_SESSION['secret']);
				header('location: login.php');
			}
		}
?>