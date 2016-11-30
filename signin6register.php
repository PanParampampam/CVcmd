<?php
	session_start();
	
	include('session_timeout.php');
	
	if(isset($_POST['robot'])) {
		
		$back_or_exit = strtolower($_POST['robot']);
		if ($back_or_exit == "back") {
			header('Location: signin4email.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['nick']);
			unset($_SESSION['password']);
			unset($_SESSION['password_check']);
			unset($_SESSION['email']);
			unset($_SESSION['robot']);
			header('Location: index.php');
			exit();
		}
		
		if ($_POST['robot'] == 3) {
		}
		else {
			$_SESSION['error_robot'] ="C:\signin\walidacja&gt;" . $_POST['robot'] . "</br><span style=color:red>Nieudana walidacja.</span></br></br>";
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
				 $_SESSION['info'] = 'C:\&gt;Udana rejestracja! Możesz się zalogować na swoje konto.</br></br>';
				 header('Location: index.php');
				 exit();
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
		$_SESSION['info'] = 'C:\&gt;<span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie</span></br></br>';
		header('Location: index.php');
		exit();
		//echo '</br>Informacja developoerska: '.$e;
	}
?>