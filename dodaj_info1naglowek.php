<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
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
			Formularz wprowadzania informacji do CV 1/3. Podaj nagłówek (np. Wykształcenie, Doświadczenie, Umiejętności, Zainteresowania itp.)<br/>
			Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="dodaj_info2info.php">
			<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\+info\nagłówek&gt; <input type="text" id="Commands" name="naglowek" autocomplete="off"/>
		</form>
	
	</body>
</html>