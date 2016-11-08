<?php
	session_start();
	
	if(isset($_POST['email'])) {
		$email_check = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		if (filter_var($email_check, FILTER_VALIDATE_EMAIL) == false || ($email_check != $_POST['email'])) {
			$_SESSION['error_email'] ="<span style=color:red>Niepoprawny adres e-mail.</span></br>";
			header('Location: signin4email.php');
			exit();
		}
		else  $_SESSION['email'] = $_POST['email'];
	}
	else if (!isset($_SESSION['password_check'])) {
		header('Location: signin1user.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="focus.js"></script>
		<title>CVcmd - rejestracja</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Formularz rejestracji 5/5. Udowodnij żeś człek. Do poprawienia. Póki co wpisz 3.<br/><br/>
			<?php
				if(isset($_SESSION['error_robot'])) {
				echo $_SESSION['error_robot'];
				unset($_SESSION['error_robot']);
				}
			?>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="signin6register.php">
			<div id = "C">Walidacja: <input type="text" id="Commands" name="robot"/>
		</form>
	
	</body>
</html>