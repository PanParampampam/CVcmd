﻿<?php
	session_start();
	
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
		<script src="jquery-3.1.1.min.js"></script>
		<script src="focus.js"></script>
		<script src="dodaj_info2script.js"></script>
		<title>CVcmd - rejestracja</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Formularz wprowadzania informacji do CV. Podaj typ wprowadzanych danych:<br/>
			1 - lista<br/>
			2 - lista z datami<br/>
			3 - tekst<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/><br/>
			<?php
				if(isset($_SESSION['error_info'])) {
				echo $_SESSION['error_info'];
				unset($_SESSION['error_info']);
				}
			?>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="dodaj_info3zatwierdz.php">
			<div id = "C">C:\<?php echo $_SESSION['user']?>\+info\typ&gt; <input type="textarea" id="Commands" name="info" autocomplete="off"/>
			<input type="text" style="display: none;" />
		</form>
	
	</body>
</html>