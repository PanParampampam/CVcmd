<?php
	session_start();
	
	include('session_timeout.php');
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit;
	}
	
	if(isset($_POST['koniec'])) {
		
		$back_or_exit = strtolower($_POST['koniec']);
		if ($back_or_exit == "back") {
			header('Location: dodaj_dane5data_urodzenia.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['godnosc']);
			unset($_SESSION['adres']);
			unset($_SESSION['tel']);
			unset($_SESSION['email']);
			unset($_SESSION['data_urodzenia']);
			header('Location: cvcmd.php');
			exit();
		}
		
		if ($back_or_exit == "accept") {
			unset($_SESSION['godnosc']);
			unset($_SESSION['adres']);
			unset($_SESSION['tel']);
			unset($_SESSION['email']);
			unset($_SESSION['data_urodzenia']);
			$_SESSION['info'] = 'C:\\' . $_SESSION['user'] . '&gt;+dane</br><span style="color:green">Podane dane zostały zapisane w bazie.</span></br></br>';
			header('Location: cvcmd.php');
			exit();
		}
		
		else {
			$_SESSION['error_dane'] ='C:\'' . $_SESSION['user'] . '\+dane\koniec&gt;</br><span style="color:red">Polecenie "' . $_POST['koniec'] . '" nie jest rozpoznawalne.</span></br></br>';
			header('Location: dodaj_dane6zatwierdz.php');
			exit();
		}
			
	}
	
	else if ((!isset($_SESSION['godnosc'])) || (!isset($_SESSION['adres'])) ||  (!isset($_SESSION['telefon'])) || (!isset($_SESSION['email'])) || (!isset($_SESSION['data_urodzenia']))) {
		header('Location: cvcmd.php');
		exit();
	}

?>