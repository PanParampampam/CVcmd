<?php
	session_start();
	
	include('session_timeout.php');
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit;
	}
	
	if(isset($_POST['info'])) {
		
		$back_or_exit = strtolower($_POST['info']);
		if ($back_or_exit == "back") {
			unset($_SESSION['info']);
			header('Location: dodaj_info1naglowek.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['naglowek']);
			unset($_SESSION['info']);
			header('Location: cvcmd.php');
			exit();
		}
		
		else $_SESSION['info'] = $_POST['info'];
	}
	
	else if (!isset($_SESSION['info'])) {
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
			Twoje CV zostanie zaktualizowane o poniższe informacje.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez wprowadzania danych wpisz EXIT. Aby zatwierdzić wpisz ACCEPT.<br/><br/>
		</div>
	</head>
	
	<body>
	
		<?php
		echo "Nagłówek: " . $_SESSION['naglowek'] . "</br></br>";
		echo $_SESSION['info'];
		if(isset($_SESSION['error_typ'])) {
		echo $_SESSION['error_typ'];
		unset($_SESSION['error_typ']);
		}
		?>
		
		<form method="post" action="dodaj_info4koniec.php">
		<div id = "C">C:\<?php echo $_SESSION['user']?>\+info\koniec&gt; <input type="text" id="Commands" name="koniec" autocomplete="off"/>
		</form>
		
	</body>
</html>