<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['godnosc'])) {
		
		$back_or_exit = strtolower($_POST['godnosc']);
		if ($back_or_exit == "exit") {
			unset($_SESSION['godnosc']);
			header('Location: cvcmd.php');
			exit();
		}

		if ($back_or_exit == "") {
			$_SESSION['error_dane'] ='CVcmd:\\' . $_SESSION['user'] . '\+dane\imię i nazwisko&gt;</br><span style="color:red">Podaj dane</span></br></br>';
			header('Location: dodaj_dane1godnosc.php');
			exit();
		}
		
		else $_SESSION['godnosc'] = $_POST['godnosc'];
	}
	
	else if (!isset($_SESSION['godnosc'])) {
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
		<script src="focus.js"></script>
		<title>CVcmd:\+dane</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Formularz wprowadzania danych osobowych 2/6. Podaj adres zamieszkania.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
		<?php
			echo "Imię i nazwisko: " . $_SESSION['godnosc'] . "</br></br>";
			if(isset($_SESSION['error_dane'])) {
				echo $_SESSION['error_dane'];
				unset($_SESSION['error_dane']);
			}
		?>
		<form method="post" action="dodaj_dane3telefon.php">
			<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\+dane\adres&gt;<input type="text" id="Commands" name="adres" autocomplete="off"/>
		</form>
	
	</body>
</html>