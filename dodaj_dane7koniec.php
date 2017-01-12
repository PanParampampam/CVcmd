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
			
			require_once "connect.php";
			mysqli_report(MYSQLI_REPORT_STRICT);

			try
			{
				$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
				if($polaczenie->connect_errno!=0)	{
					throw new Exception(mysqli_connect_errno());
				}
				else	{
					if ((!isset($_SESSION['godnosc'])) || (!isset($_SESSION['adres'])) || (!isset($_SESSION['tel'])) || (!isset($_SESSION['email'])) || (!isset($_SESSION['data_urodzenia']))) {
						header('Location: cvcmd.php');
						exit();
					}
					$user =  $_SESSION['user'];
					$godnosc = $_SESSION['godnosc'];
					$adres = $_SESSION['adres'];
					$tel = $_SESSION['tel'];
					$email = $_SESSION['email'];
					$data_urodzenia = $_SESSION['data_urodzenia'];
					
					$polaczenie ->query("SET NAMES 'utf8'");
					if ($polaczenie->query("UPDATE uzytkownicy SET `godnosc`='$godnosc', `adres`='$adres', `tel`='$tel', `emailcv`='$email', `data_urodzenia`='$data_urodzenia' WHERE `user`='$user'")) {
						unset($_SESSION['godnosc']);
						unset($_SESSION['adres']);
						unset($_SESSION['tel']);
						unset($_SESSION['email']);
						unset($_SESSION['data_urodzenia']);
						$_SESSION['info'] = 'C:' . $_SESSION['user'] . '&gt;+dane</br><span style="color:green">Podane dane zostały zapisane w bazie.</span></br></br>';
						header('Location: cvcmd.php');
					}
					else	{
						throw new Exception($polaczenie->error);
					}
				
				
				$polaczenie->close();
				}
			}
				catch(Exception $e)  {
					$_SESSION['info'] = 'C:\\' . $_SESSION['user'] . '&gt;+dane</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie</span></br></br>';
					header('Location: cvcmd.php');
					exit();
					//echo '</br>Informacja developoerska: '.$e;
				}
				exit();
			}
		
		else {
			$_SESSION['error_dane'] ='C:\\' . $_SESSION['user'] . '\+dane\koniec&gt;</br><span style="color:red">Polecenie "' . $_POST['koniec'] . '" nie jest rozpoznawalne.</span></br></br>';
			header('Location: dodaj_dane6zatwierdz.php');
			exit();
		}
			
	}
	else {
		header('Location: index.php');
		exit;
	}
?>