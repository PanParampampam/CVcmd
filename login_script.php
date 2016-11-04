<?php
	session_start();
	
	if((!isset($_SESSION['tlogin'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once('connect.php');
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{	
		$login = $_SESSION['tlogin'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
		
		if ($rezultat = @$polaczenie->query(sprintf("SELECT * FROM uzytkownicy WHERE user='%s' AND pass='%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$haslo))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow==1)
			{
				$_SESSION['zalogowany'] = true;
				$_SESSION['id'] = $wiersz['id'];
				$wiersz = $rezultat->fetch_assoc();
				$_SESSION['user'] = $wiersz['user'];
				
				unset($_SESSION['blad']);
				unset($_SESSION['tlogin']);
				$rezultat->close();
				header('Location: cvcmd.php');
			}
			else
			{
				$_SESSION['blad']='Nieprawidłowy login lub hasło';
				header('Location: index.php');
				
			}
		}
		
		$polaczenie->close();
	}
?>