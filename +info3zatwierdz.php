﻿<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['info'])) {
		
		$back_or_exit = strtolower($_POST['info']);
		if ($back_or_exit == "back") {
			header('Location: +info1naglowek.php');
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="mousetrap.min.js"></script>
		<script src="focus.js"></script>
		<title>CVcmd:\+info</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			3/3 Wprowadzanie nowej sekcji CV. Twoje CV zostanie zaktualizowane o poniższe informacje.<br/></br>
			Aby zatwierdzić wpisz ACCEPT.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. (Powrót do punktu 1/3 nie usunie danych zawartych w punkcie 2/3)<br/>
			Aby opuścić formularz bez wprowadzania danych wpisz EXIT. <br/><br/>
		</div>
	</head>
	
	<body>
		
		<?php
		echo "Treść: <strong>" . $_SESSION['naglowek'] . "</strong></br></br>";
		echo '<div style="white-space: pre-line; margin-left: 40px; width: 205mm">' . $_SESSION['info'] . "</br></br></div>";
		if(isset($_SESSION['error_info'])) {
			echo $_SESSION['error_info'];
			unset($_SESSION['error_info']);
		}
		?>
		
		<form method="post" action="+info4koniec.php">
		<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\+info\zatwierdz&gt; <input type="text" id="Commands" name="koniec" autocomplete="off" class="mousetrap"/>
		</form>
		
	</body>
</html>