<?php
	session_start();
	
	include('session_timeout.php');
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit;
	}
	
	if(isset($_POST['godnosc'])) {
		
		$back_or_exit = strtolower($_POST['godnosc']);
		if ($back_or_exit == "exit") {
			unset($_SESSION['godnosc']);
			header('Location: cvcmd.php');
			exit();
		}
		
		else $_SESSION['godnosc'] = $_POST['godnosc'];
	}
	
	else if (!isset($_SESSION['godnosc'])) {
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
			Formularz wprowadzania danych osobowych 2/5. Podaj adres zamieszkania.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="dodaj_dane3telefon.php">
			<div id = "C">C:\<?php echo $_SESSION['user']?>\+dane\adres&gt; <input type="text" id="Commands" name="adres" autocomplete="off"/>
		</form>
	
	</body>
</html>