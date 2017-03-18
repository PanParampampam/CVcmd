<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['einfo'])) {
		
		$back_or_exit = strtolower($_POST['einfo']);
		if ($back_or_exit == "back") {
			header('Location: einfo2naglowek.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['stary_naglowek']);
			unset($_SESSION['enaglowek']);
			unset($_SESSION['einfo']);
			header('Location: cvcmd.php');
			exit();
		}
		
		else $_SESSION['einfo'] = $_POST['einfo'];
	}
	
	else if (!isset($_SESSION['einfo'])) {
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
		<title>CVcmd:\einfo</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			4/4 Edycja wybranej sekcji. Twoje CV zostanie zaktualizowane o poniższe informacje.<br/></br>
			Aby zatwierdzić wpisz ACCEPT.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. (Powrót do punktu 1/3 nie nadpisze danych zawartych w punkcie 2/3)</br>
			Aby opuścić formularz bez zmieniania danych wpisz EXIT.</br> </br>
		</div>
	</head>
	
	<body>
		
		<?php
		echo "Treść: <strong>" . $_SESSION['enaglowek'] . "</strong></br></br>";
		echo '<div style="white-space: pre-line; margin-left: 40px; width: 205mm">' . $_SESSION['einfo'] . "</br></br></div>";
		if(isset($_SESSION['error_zatwierdz'])) {
			echo $_SESSION['error_zatwierdz'];
			unset($_SESSION['error_zatwierdz']);
		}
		?>
		
		<form method="post" action="einfo5koniec.php">
		<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\einfo\zatwierdz&gt; <input type="text" id="Commands" name="koniec" autocomplete="off" class="mousetrap"/>
		</form>
		
	</body>
</html>