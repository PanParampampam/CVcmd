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
			header('Location: dodaj_info2info.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['naglowek']);
			unset($_SESSION['info']);;
			header('Location: cvcmd.php');
			exit();
		}
		
		if ($back_or_exit == "accept") {
			
			require_once "connect.php";
			mysqli_report(MYSQLI_REPORT_STRICT);

			try
			{
				$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
				if($polaczenie->connect_errno!=0)	{
					throw new Exception(mysqli_connect_errno());
				}
				else	{
					$user =  $_SESSION['user'];
					$id = $_SESSION['id'];
					$naglowek = $_SESSION['naglowek'];
					$info = $_SESSION['info'];
					$polaczenie ->query("SET NAMES 'utf8'");
					if ($polaczenie->query("INSERT INTO info (`id`, `id_usera`, `naglowek`, `info`) VALUES (NULL, '$id', '$naglowek', '$info')")) {
						unset($_SESSION['naglowek']);
						unset($_SESSION['info']);;
						$_SESSION['info'] = 'C:' . $_SESSION['user'] . '&gt;+info</br><span style="color:green">Podane informacje zostały zapisane w bazie.</span></br></br>';
						header('Location: cvcmd.php');
					}
					else	{
						throw new Exception($polaczenie->error);
					}
				
				
				$polaczenie->close();
				}
			}
				catch(Exception $e)  {
					$_SESSION['info'] = 'C:\\' . $_SESSION['user'] . '&gt;+info</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie</span></br></br>';
					header('Location: cvcmd.php');
					exit();
					//echo '</br>Informacja developoerska: '.$e;
				}
				exit();
			}
		
		else {
			$_SESSION['error_info'] ='C:\\' . $_SESSION['user'] . '\+info\koniec&gt;</br><span style="color:red">Polecenie "' . $_POST['koniec'] . '" nie jest rozpoznawalne.</span></br></br>';
			header('Location: dodaj_info3zatwierdz.php');
			exit();
		}
			
	}
	else {
		header('Location: index.php');
		exit;
	}
?>