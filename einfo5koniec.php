<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['koniec'])) {
		
		$back_or_exit = strtolower($_POST['koniec']);
		if ($back_or_exit == "back") {
			header('Location: einfo3info.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			$SESSION['stary_naglowek'];
			unset($_SESSION['enaglowek']);
			unset($_SESSION['einfo']);;
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
					if ((!isset($_SESSION['einfo'])) || (!isset($_SESSION['enaglowek']))) {
						header('Location: cvcmd.php');
						exit();
						}
					$id = $_SESSION['id'];
					$stary_naglowek = $_SESSION['stary_naglowek'];
					$naglowek = $_SESSION['enaglowek'];
					$info = $_SESSION['einfo'];
					$polaczenie ->query("SET NAMES 'utf8'");
					if ($polaczenie->query("UPDATE info SET `naglowek`='$naglowek', `info`='$info' WHERE `id_usera`='$id' AND `naglowek`='$stary_naglowek'")) {
						unset($SESSION['stary_naglowek']);
						unset($_SESSION['enaglowek']);
						unset($_SESSION['einfo']);
						$_SESSION['info'] = 'CVcmd:' . $_SESSION['user'] . '&gt;einfo</br><span style="color:green">Podane informacje zostały zapisane w bazie.</span></br></br>';
						header('Location: cvcmd.php');
					}
					else	{
						throw new Exception($polaczenie->error);
					}
				
				
				$polaczenie->close();
				}
			}
				catch(Exception $e)  {
					$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;einfo</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o spróbowanie ponownie w innym terminie.</span></br></br>';
					header('Location: cvcmd.php');
					exit();
					//echo '</br>Informacja developoerska: '.$e;
				}
				exit();
			}
		
		else {
			$_SESSION['error_info'] ='CVcmd:\\' . $_SESSION['user'] . '\einfo\zatwierdz&gt;</br><span style="color:red">Polecenie "' . $_POST['koniec'] . '" nie jest rozpoznawalne.</span></br></br>';
			header('Location: einfo4zatwierdz.php');
			exit();
		}
			
	}
	else {
		header('Location: index.php');
		exit;
	}
?>