<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['adres'])) {
		
		$back_or_exit = strtolower($_POST['adres']);
		if ($back_or_exit == "back") {
			header('Location: dodaj_dane1godnosc.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['godnosc']);
			unset($_SESSION['adres']);
			header('Location: cvcmd.php');
			exit();
		}
		if ($back_or_exit == "") {
			$_SESSION['error_dane'] ='C:\\' . $_SESSION['user'] . '\+dane\adres&gt;</br><span style="color:red">Podaj dane</span></br></br>';
			header('Location: dodaj_dane2adres.php');
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
			Formularz wprowadzania danych osobowych 3/6. Podaj numer/numery telefonu.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
		<?php
			echo "Imię i nazwisko: " . $_SESSION['godnosc'] . "</br>";
			echo "Adres: " . $_SESSION['adres'] . "</br></br>";
			if(isset($_SESSION['error_dane'])) {
				echo $_SESSION['error_dane'];
				unset($_SESSION['error_dane']);
			}
		?>
		<form method="post" action="dodaj_dane4email.php">
			<div id = "C">C:\<?php echo $_SESSION['user']?>\+dane\tel&gt; <input type="text" id="Commands" name="tel" autocomplete="off"/>
		</form>
	
	</body>
</html>