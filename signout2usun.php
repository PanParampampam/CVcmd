<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['haslo'])) {
		
		$back_or_exit = strtolower($_POST['haslo']);
		if ($back_or_exit == "exit") {
			header('Location: cvcmd.php');
			exit();
		}
			
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);

		try {
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			
			if($polaczenie->connect_errno!=0)	{
				throw new Exception(mysqli_connect_errno());
			}
			
			else	{
				$polaczenie ->query("SET NAMES 'utf8'");
				$id = $_SESSION['id'];
				$haslo = $_POST['haslo'];
				
				$user = "SELECT * FROM uzytkownicy WHERE id='$id'";
					
				$rezultat = mysqli_query($polaczenie, $user);
				if (mysqli_num_rows($rezultat) == 1) {
					while($row = mysqli_fetch_assoc($rezultat)) {
						if (password_verify($haslo, $row['pass'])) {
							if (($polaczenie->query("DELETE FROM info WHERE id_usera='$id'")) and ($polaczenie->query("DELETE FROM uzytkownicy WHERE id='$id'"))) {
								session_unset();
								$_SESSION['info']='CVcmd:\l&gt;signout</br><span style=color:green>Konto użytkownika zostało usunięte.</span></br></br>';
								header('Location: index.php');
								exit();
							}
						}
						else {
							$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;signout</br><span style="color:red">Błędne polecenie lub hasło.</span></br></br>';
							header('Location: cvcmd.php');
							exit();
						}
					}
				}
				else	{
					throw new Exception($polaczenie->error);
				}
					
			}			
			$polaczenie->close();
		}
		catch(Exception $e)  {
			$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;-info</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o spróbowanie ponownie w innym terminie.</span></br></br>';
			header('Location: cvcmd.php');
			exit();
			//echo '</br>Informacja developoerska: '.$e;
		}	
	}
	else {
		header('Location: index.php');
		exit;
	}
?>