<?php
	session_start();
	
	include('session_timeout.php');
	
	if(isset($_POST['password'])) {
		
		$back_or_exit = strtolower($_POST['password']);
		if ($back_or_exit == "back") {
			header('Location: signin1user.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['nick']);
			unset($_SESSION['password']);
			header('Location: index.php');
			exit();
		}
	
		if ((strlen($_POST['password'])) < 6 || (strlen($_POST['password']) > 20)) {
			$_SESSION['error_password'] ="CVcmd:\signin\hasło&gt;</br><span style=color:red>Hasło musi posiadać od 6 do 20 znaków.</span></br></br>";
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
		<title>CVcmd:\signin</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Formularz rejestracji 3/5. Powtórz hasło.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez rejestrowania wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="signin4email.php">
			<div id = "C">CVcmd:\signin\hasło&gt;<input type="password" id="Commands" name="password_check"/>
		</form>
	
	</body>
</html>