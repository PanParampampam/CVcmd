﻿<?php
	session_start();
	
	include('session_timeout.php');
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit;
	}
	
	if(isset($_POST['naglowek'])) {
		
		$back_or_exit = strtolower($_POST['naglowek']);
		if ($back_or_exit == "exit") {
			unset($_SESSION['naglowek']);
			header('Location: cvcmd.php');
			exit();
		}
		
		else $_SESSION['naglowek'] = $_POST['naglowek'];
	}
	
	else if (!isset($_SESSION['naglowek'])) {
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
			Formularz wprowadzania informacji do CV. Wprowadź dane.</br>
			Podpowiedź: Aby wprowadzić symbol "&bull;" wpisz '&#38;bull;'.</br>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/>
			Aby zakończyć wprowadzanie danych wciśnij SHIFT + ENTER.</br></br>
			<?php
				if(isset($_SESSION['error_info'])) {
				echo $_SESSION['error_info'];
				unset($_SESSION['error_info']);
				}
			?>
		</div>
	</head>
	
	<body>
			<script>
			document.addEventListener("keypress", function(key) {
				if(key.keyCode == 13 && key.shiftKey) {
					window.location.href = "dodaj_info1naglowek.php";
				}});
		</script>
			<div id = "C">C:\<?php echo $_SESSION['user']?>\+info\info&gt; <textarea id="Commands" name="info" autocomplete="off" rows="20"></textarea>
			<p id="wynik"></p>
	</body>
</html>