<?php
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit;
	}
	
	if(isset($_POST['typ'])) {
		
		$back_or_exit = strtolower($_POST['typ']);
		if ($back_or_exit == "back") {
			header('Location: dodaj_info1naglowek.php');
			exit();
		}
			
		if ($back_or_exit == "exit") {
			unset($_SESSION['naglowek']);
			unset($_SESSION['typ']);
			header('Location: cvcmd.php');
			exit();
		}
		
		switch($_POST['typ']) {
			case "1":
				$_SESSION['typ'] = $_POST['typ'];
				header('Location: dodaj_info3lista.php');
				exit();
			case "2":
				$_SESSION['typ'] = $_POST['typ'];
				header('Location: dodaj_info3lista_z_datami.php');
				exit();
			case "3":
				$_SESSION['typ'] = $_POST['typ'];
				header('Location: dodaj_info3tekst.php');
				exit();
			default:
				$_SESSION['error_typ'] = "C:\\" . $_SESSION['user'] . "\+info\\typ&gt;<span style=color:red>Polecenie '" . $_POST['typ'] . "' nie jest rozpoznawalne.</span></br></br>";
				header('Location: dodaj_info2typ.php');
				exit();
		}
	}
	
	else if (!isset($_SESSION['typ'])) {
	header('Location: cvcmd.php');
	exit();
	}
?>