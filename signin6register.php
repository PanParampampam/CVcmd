<?php
	session_start();
	
	if(isset($_POST['robot'])) {
		if ($_POST['robot'] == 3) {
		}
		else {
			$_SESSION['error_robot'] ="<span style=color:red>Nieudana walidacja.</span></br>";
			header('Location: signin5humanordancer.php');
			exit();
		}
	}
	else if ((!isset($_SESSION['nick'])) || (!isset($_SESSION['password'])) ||  (!isset($_SESSION['password_check'])) || (!isset($_SESSION['email']))) {
		header('Location: signin1user.php');
		exit();
	}
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	//dzieki tej funkcji raportujemy tylko wyjatki, czyli nie wycieka za duzo info do uzytkownikow
	//np o nazwie roota
	
	try
	{
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if($polaczenie->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
			//rzuc nowym wyjatkiem - po to by sekcja catch zlapala go, zeby sekcja catch
			//zlapala go i wyrzucila na ekranie
		}
		else
		{
				$nick = $_SESSION['nick'];
				$password = $_SESSION['password'];
				$email = $_SESSION['email'];
				if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$password', '$email')"))
				{
				 unset($_SESSION['nick']);
				 unset($_SESSION['password']);
				 unset($_SESSION['password_check']);
				 unset($_SESSION['email']);
				}
				else
				{
					throw new Exception($polaczenie->error);
				}
			
			
			$polaczenie->close();
		}
	}
	catch(Exception $e) //zlap wyjatek i umiesc go w zmiennej $e
	{
		$_SESSION['blad'] = '<span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie</span>';
		header('Location: index.php');
		exit();
		//echo '</br>Informacja developoerska: '.$e;
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
			Udana rejestracja! Możesz się zalogować na swoje konto.<br/><br/>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="index.php">
			<div id = "C">Aby kontynuować do strony głównej wciśnij ENTER <input type="text" id="Commands"/>
		</form>
	
	</body>
</html>