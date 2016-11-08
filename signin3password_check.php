<?php
	session_start();
	
	if(isset($_POST['password'])) {
	
		if ((strlen($_POST['password'])) < 6 || (strlen($_POST['password']) > 20)) {
			$_SESSION['error_password'] ="<span style=color:red>Hasło musi posiadać od 6 do 20 znaków.</span></br>";
			header('Location: signin2password.php');
			exit();
		}
		
		else $_SESSION['password'] = $_POST['password'];
	}
	else {
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
			Formularz rejestracji 3/5. Powtórz hasło.<br/><br/>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="signin4email.php">
			<div id = "C">Hasło: <input type="password" id="Commands" name="password_check"/>
		</form>
	
	</body>
</html>