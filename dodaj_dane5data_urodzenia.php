<?php
	session_start();
	
	include('session_timeout.php');
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit;
	}
	
	if(isset($_POST['email'])) {
		
		$back_or_exit = strtolower($_POST['email']);
		if ($back_or_exit == "back") {
			header('Location: dodaj_dane3telefon.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['godnosc']);
			unset($_SESSION['adres']);
			unset($_SESSION['tel']);
			unset($_SESSION['email']);
			header('Location: cvcmd.php');
			exit();
		}
		
		else $_SESSION['email'] = $_POST['email'];
	}
	
	else if (!isset($_SESSION['email'])) {
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
			Formularz wprowadzania danych osobowych 5/5. Podaj datę urodzenia.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="dodaj_dane6zatwierdz.php">
			<div id = "C">C:\<?php echo $_SESSION['user']?>\+dane\data urodzenia&gt; <input type="text" id="Commands" name="data_urodzenia" autocomplete="off"/>
		</form>
	
	</body>
</html>