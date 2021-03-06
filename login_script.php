<?php
	session_start();
	
	if((!isset($_SESSION['login'])) || (!isset($_POST['haslo']))) {
		header('Location: index.php');
		exit();
	}
	
	$back_or_exit = strtolower($_POST['haslo']);
	if ($back_or_exit == "back") {
		header('Location: login.php');
		exit();
	}
	if ($back_or_exit == "exit") {
		header('Location: index.php');
		exit();
	}
	
	require_once('connect.php');
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0) {
		$_SESSION['info'] = "CVcmd:\&gt;<span style=color:red>Error: $polaczenie->connect_errno</span></br></br>";
		header('Location: index.php');
		exit();
	}
	else {	
		$login = $_SESSION['login'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
		if ($rezultat = @$polaczenie->query(sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
		mysqli_real_escape_string($polaczenie,$login)))) {
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow==1) {
				$wiersz = $rezultat->fetch_assoc();
				
				if (password_verify($haslo, $wiersz['pass'])) {
					$_SESSION['zalogowany'] = true;
					$_SESSION['id'] = $wiersz['id'];
					$_SESSION['user'] = $wiersz['user'];
					;
					unset($_SESSION['login']);
					$rezultat->close();
					$_SESSION['info']='CVcmd:\&gt;login</br><span style=color:green>Zalogowano. Witaj ' . $_SESSION['user'] . '!</span></br></br>';
					header('Location: cvcmd.php');
				}
				else {
					$_SESSION['info']='CVcmd:\l&gt;login</br><span style=color:red>Nieprawidłowy login lub hasło.</span></br></br>';
					header('Location: index.php');
					exit();
				}
			}
			else {
				$_SESSION['info']='CVcmd:\&gt;login</br><span style=color:red>Nieprawidłowy login lub hasło.</span></br></br>';
				header('Location: index.php');
				exit();
			}
		}
		
		$polaczenie->close();
	}
?>