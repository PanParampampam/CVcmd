<?php
	session_start();
	
	include('session_timeout.php');
	
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
		if ($back_or_exit == "") {
			$_SESSION['error_dane'] ='C:\\' . $_SESSION['user'] . '\+dane\tel&gt;</br><span style="color:red">Podaj dane</span></br></br>';
			header('Location: dodaj_dane3telefon.php');
			exit();
		}
		
		else $_SESSION['tel'] = $_POST['tel'];
	}
	
	else if (!isset($_SESSION['tel'])) {
	header('Location: cvcmd.php');
	exit();
	}
	
	require_once('connect.php');
	$polaczenie =  @new mysqli($host, $db_user, $db_password, $db_name);
	$user = $_SESSION['user'];
	$email = $polaczenie->query("SELECT email FROM uzytkownicy WHERE user='$user'");
	$domyslny_email = mysqli_fetch_row($email);
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
			Formularz wprowadzania danych osobowych 4/6. Podaj adres/adresy e-mail.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
		<?php
			echo "Imię i nazwisko: " . $_SESSION['godnosc'] . "</br>";
			echo "Adres: " . $_SESSION['adres'] . "</br>";
			echo "Tel.: " . $_SESSION['tel'] . "</br></br>";
			if(isset($_SESSION['error_dane'])) {
			echo $_SESSION['error_dane'];
			unset($_SESSION['error_dane']);
			}
		?>
		<form method="post" action="dodaj_dane5data_urodzenia.php">
			<div id = "C">C:\<?php echo $_SESSION['user']?>\+dane\e-mail&gt; <input type="text" id="Commands" name="email" value='<?php echo $domyslny_email[0] ?>'autocomplete="off"/>
		</form>
	
	</body>
</html>