<?php
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit;
	}
	
	if(isset($_POST['adres'])) {
		
		$back_or_exit = strtolower($_POST['adres']);
		if ($back_or_exit == "back") {
			header('Location: dodaj_dane1godnosc.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			header('Location: cvcmd.php');
			exit();
		}
		
		else $_SESSION['adres'] = $_POST['adres'];
	}
	
	else if (!isset($_SESSION['adres'])) {
	header('Location: cvcmd.php');
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
			Formularz wprowadzania danych osobowych 3/5. Podaj numer/numery telefonu.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="dodaj_dane4email.php">
			<div id = "C">Nr tel: <input type="text" id="Commands" name="tel"/>
		</form>
	
	</body>
</html>