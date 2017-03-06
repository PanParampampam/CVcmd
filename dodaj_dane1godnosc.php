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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="focus.js"></script>
		<title>CVcmd:\+dane</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Formularz wprowadzania danych osobowych 1/6. Podaj imię i nazwisko.<br/>
			Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
		<?php
			if(isset($_SESSION['error_dane'])) {
			echo $_SESSION['error_dane'];
			unset($_SESSION['error_dane']);
			}
		?>
		<form method="post" action="dodaj_dane2adres.php">
			<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\+dane\imię i nazwisko&gt; <input type="text" id="Commands" name="godnosc" autocomplete="off"/>
		</form>
	
	</body>
</html>