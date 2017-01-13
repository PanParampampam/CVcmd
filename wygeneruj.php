﻿<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="focus.js"></script>
		<title>CVcmd - rejestracja</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Wyświetlenie informacji zawartych w bazie danych.</br></br>
		</div>
	</head>
	
	<body>
		
		<?php
			require_once "connect.php";
			mysqli_report(MYSQLI_REPORT_STRICT);

			try
			{
				$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
				
				if($polaczenie->connect_errno!=0)	{
					throw new Exception(mysqli_connect_errno());
				}
				
				else	{
					$polaczenie ->query("SET NAMES 'utf8'");
					$id = $_SESSION['id'];
					$sql = "SELECT * FROM info WHERE id_usera='$id'";
					$rezultat = mysqli_query($polaczenie, $sql);

					if (mysqli_num_rows($rezultat) > 0) {
						while($row = mysqli_fetch_assoc($rezultat)) {
							echo "Nagłówek: " . $row["naglowek"]. " - Info: " . $row["info"] . "<br>";
						}
					}
					else {
						echo "Brak wyników";
					}
						
				}			
				$polaczenie->close();
			}
				catch(Exception $e)  {
					$_SESSION['info'] = 'C:\\' . $_SESSION['user'] . '&gt;+info</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o spróbowanie ponownie w innym terminie.</span></br></br>';
					header('Location: cvcmd.php');
					exit();
					//echo '</br>Informacja developoerska: '.$e;
				}
				exit();
		?>
		
		<form method="post" action="dodaj_info4koniec.php">
		<div id = "C">C:\<?php echo $_SESSION['user']?>\wygeneruj&gt; <input type="text" id="Commands" name="koniec" autocomplete="off"/>
		</form>
		
	</body>
</html>