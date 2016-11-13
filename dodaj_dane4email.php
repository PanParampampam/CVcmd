<?php
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit;
	}
	
	if(isset($_POST['tel'])) {
		
		$back_or_exit = strtolower($_POST['tel']);
		if ($back_or_exit == "back") {
			header('Location: dodaj_dane2adres.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['godnosc']);
			unset($_SESSION['adres']);
			unset($_SESSION['tel']);
			header('Location: cvcmd.php');
			exit();
		}
		
		else $_SESSION['tel'] = $_POST['tel'];
	}
	
	else if (!isset($_SESSION['tel'])) {
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
			Formularz wprowadzania danych osobowych 4/5. Podaj adres/adresy e-mail.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="dodaj_dane5data_urodzenia.php">
			<div id = "C">C:\<?php echo $_SESSION['user']?>\+dane\e-mail&gt; <input type="text" id="Commands" name="email" autocomplete="off"/>
		</form>
	
	</body>
</html>