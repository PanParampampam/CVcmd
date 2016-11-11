<?php
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit;
	}
	
	if(isset($_POST['data_urodzenia'])) {
		
		$back_or_exit = strtolower($_POST['data_urodzenia']);
		if ($back_or_exit == "back") {
			header('Location: dodaj_dane4email.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			header('Location: cvcmd.php');
			exit();
		}
		
		else $_SESSION['data_urodzenia'] = $_POST['data_urodzenia'];
	}
	
	else if ((!isset($_SESSION['godnosc'])) || (!isset($_SESSION['adres'])) ||  (!isset($_SESSION['telefon'])) || (!isset($_SESSION['email'])) || (!isset($_SESSION['data_urodzenia']))) {
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
	
		<?php 
			echo $_SESSION['godnosc'] . "</br>";
			echo $_SESSION['adres'] . "</br>";
			echo $_SESSION['tel'] . "</br>";
			echo $_SESSION['email'] . "</br>";
			echo $_SESSION['data_urodzenia'] . "</br>";
		?>
	
	</body>
</html>