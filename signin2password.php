<?php
	session_start();
	
	if(isset($_POST['nick'])) {
		
		if ((strlen($_POST['nick'])) < 3 || (strlen($_POST['nick']) > 15)) {
			$_SESSION['error_nick'] ="<span style=color:red>Nazwa użytkownika musi posiadać od 3 do 15 znaków.</span></br>";
			header('Location: signin1user.php');
			exit();
		}
		
		if(ctype_alnum($_POST['nick']) == false) {
			$_SESSION['error_nick'] = "<span style=color:red>Nick nie może zawierać polskich znaków, musi się składać z liter i/lub cyfr.</span></br>";
			header('Location: signin1user.php');
			exit();
		}
		
		else $_SESSION['nick'] = $_POST['nick'];
	}
	else if (!isset($_SESSION['nick'])) {
		header('Location: signin1user.php');
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
			Formularz rejestracji 2/5. Podaj hasło (od 6 do 20 znaków)<br/><br/>
			<?php
				if(isset($_SESSION['error_password'])) {
				echo $_SESSION['error_password'];
				unset($_SESSION['error_password']);
				}
			?>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="signin3password_check.php">
			<div id = "C">Hasło: <input type="password" id="Commands" name="password"/>
		</form>
	
	</body>
</html>