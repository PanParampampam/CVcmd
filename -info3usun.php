<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['zatwierdz'])) {
		
		$back_or_exit = strtolower($_POST['zatwierdz']);
		if ($back_or_exit == "back") {
			unset($_SESSION['wybierz']);
			header('Location: -info1wybierz.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['wybierz']);
			header('Location: cvcmd.php');
			exit();
		}
		
		if ($back_or_exit == "delete") {
			
			require_once "connect.php";
			mysqli_report(MYSQLI_REPORT_STRICT);

			try
			{
				$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
				if($polaczenie->connect_errno!=0)	{
					throw new Exception(mysqli_connect_errno());
				}
				else	{
					$id = $_SESSION['id'];
					$wybierz = $_SESSION['wybierz'];
					$polaczenie ->query("SET NAMES 'utf8'");
					if ($polaczenie->query("DELETE FROM info WHERE id_usera='$id' AND naglowek='$wybierz'")) {
						$_SESSION['error_wybierz'] = 'CVcmd:' . $_SESSION['user'] . '\-info&gt;' . $_SESSION['wybierz'] . '</br><span style="color:green">Podana sekcja została usunięta z bazy danych.</span></br></br>';
						unset($_SESSION['wybierz']);
						header('Location: -info1wybierz.php');
						exit();
					}
					else	{
						throw new Exception($polaczenie->error);
					}
				
				
				$polaczenie->close();
				}
			}
				catch(Exception $e)  {
					$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;-info</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o spróbowanie ponownie w innym terminie.</span></br></br>';
					header('Location: cvcmd.php');
					exit();
					//echo '</br>Informacja developoerska: '.$e;
				}
				exit();
			}
		
		else {
			$_SESSION['error_zatwierdz'] ='CVcmd:\\' . $_SESSION['user'] . '\-info\zatwierdź&gt;</br><span style="color:red">Polecenie "' . $_POST['koniec'] . '" nie jest rozpoznawalne.</span></br></br>';
			header('Location: -info2zatwierdz.php');
			exit();
		}
			
	}
	else {
		header('Location: index.php');
		exit;
	}
?>