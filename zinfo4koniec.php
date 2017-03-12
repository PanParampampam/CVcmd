<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['koniec'])) {
		
		$back_or_exit = strtolower($_POST['koniec']);
		if ($back_or_exit == "back") {
			header('Location: zinfo2wybierz2.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['id1']);
			unset($_SESSION['naglowek1']);
			unset($_SESSION['info1']);
			unset($_SESSION['id2']);
			unset($_SESSION['naglowek2']);
			unset($_SESSION['info2']);
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
					
					if ((!isset($_SESSION['naglowek1'])) || (!isset($_SESSION['naglowek2']))) {
						header('Location: cvcmd.php');
						exit();
					}
					
					$id = $_SESSION['id'];
					$id1 = $_SESSION['id1'];
					$id2 = $_SESSION['id2'];
					$naglowek1 = $_SESSION['naglowek1'];
					$info1 = $_SESSION['info1'];
					$naglowek2 = $_SESSION['naglowek2'];
					$info2 = $_SESSION['info2'];
					
					$polaczenie ->query("SET NAMES 'utf8'");
					if ($polaczenie->query("UPDATE info SET `naglowek`='$naglowek1', `info`='$info1' WHERE `id_usera`='$id' AND `id`='$id2'")) {
						if ($polaczenie->query("UPDATE info SET `naglowek`='$naglowek2', `info`='$info2' WHERE `id_usera`='$id' AND `id`='$id1'")) {
							$_SESSION['error_wybierz'] = 'CVcmd:' . $_SESSION['user'] . '\zinfo&gt;accept</br><span style="color:green">Podane sekcje zostały zamienione.</span></br></br>';
							unset($_SESSION['id1']);
							unset($_SESSION['info1']);
							unset($_SESSION['id2']);
							unset($_SESSION['info2']);
							header('Location: zinfo1wybierz.php');
							exit();
						}
					}
					else	{
						throw new Exception($polaczenie->error);
					}
				
				
				$polaczenie->close();
				}
			}
				catch(Exception $e)  {
					$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;zinfo</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o spróbowanie ponownie w innym terminie.</span></br></br>';
					header('Location: cvcmd.php');
					exit();
					//echo '</br>Informacja developoerska: '.$e;
				}
				exit();
			}
		
		else {
			$_SESSION['error_info'] ='CVcmd:\\' . $_SESSION['user'] . '\zinfo\zatwierdz&gt;</br><span style="color:red">Polecenie "' . $_POST['koniec'] . '" nie jest rozpoznawalne.</span></br></br>';
			header('Location: zinfo4zatwierdz.php');
			exit();
		}
			
	}
	else {
		header('Location: index.php');
		exit;
	}
?>