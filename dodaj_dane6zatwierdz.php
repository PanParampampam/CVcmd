<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['data_urodzenia'])) {
		
		$back_or_exit = strtolower($_POST['data_urodzenia']);
		if ($back_or_exit == "back") {
			header('Location: dodaj_dane4email.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['godnosc']);
			unset($_SESSION['adres']);
			unset($_SESSION['tel']);
			unset($_SESSION['email']);
			header('Location: cvcmd.php');
			exit();
		}
		if ($back_or_exit == "") {
			$_SESSION['error_dane'] ='CVcmd:\\' . $_SESSION['user'] . '\+dane\data urodzenia&gt;</br><span style="color:red">Podaj dane</span></br></br>';
			header('Location: dodaj_dane5data_urodzenia.php');
			exit();
		}
		
		else $_SESSION['data_urodzenia'] = $_POST['data_urodzenia'];
	}
	
	else if ((!isset($_SESSION['godnosc'])) || (!isset($_SESSION['adres'])) ||  (!isset($_SESSION['tel'])) || (!isset($_SESSION['email'])) || (!isset($_SESSION['data_urodzenia']))) {
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
		<title>CVcmd:\+dane</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Formularz wprowadzania danych osobowych 6/6. Poniższe dane osobiste zostaną wprowadzone do CV.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez wprowadzania danych wpisz EXIT. Aby zatwierdzić wpisz ACCEPT.<br/><br/>
		</div>
	</head>
	
	<body>
	
		<?php 
			echo "Imię i nazwisko: " . $_SESSION['godnosc'] . "</br>";
			echo "Adres: " . $_SESSION['adres'] . "</br>";
			echo "Tel.: " . $_SESSION['tel'] . "</br>";
			echo "E-mail: " . $_SESSION['email'] . "</br>";
			echo "Data urodzenia: " . $_SESSION['data_urodzenia'] . "</br></br>";	
			if(isset($_SESSION['error_dane'])) {
				echo $_SESSION['error_dane'];
				unset($_SESSION['error_dane']);
			}
		?>
	
		<form method="post" action="dodaj_dane7koniec.php">
			<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\+dane\koniec&gt;<input type="text" id="Commands" name="koniec" autocomplete="off" class="mousetrap"/>
		</form>
	</body>
</html>