﻿<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="cv_zobacz.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="mousetrap.min.js"></script>
		<script src="cv_zobacz.js"></script>
		<title>CVcmd:\zobaczCV</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "CurriculumVitae">
			<strong>Curriculum Vitae</strong>
		</div>
	</head>
	
	<body>
	
		<?php
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
					$cv_dane = "SELECT godnosc, adres, tel, emailcv, data_urodzenia FROM uzytkownicy WHERE id='$id'";
					$cv_info = "SELECT naglowek, info FROM info WHERE id_usera='$id'";
					$rezultat_dane = mysqli_query($polaczenie, $cv_dane);
					
					echo '<div id = "Naglowki"><strong>&#9632; Dane osobowe</strong><hr></div>';
			?>
	
					<div class="image-upload">
						<label for="file-input">
							<img id="Foto"/>
						</label>
						<input id="file-input" type="file" accept="image/*"  onchange="showMyImage(this)"/>
					</div>

			<?php	
					if (mysqli_num_rows($rezultat_dane) == 1) {
						while($row = mysqli_fetch_assoc($rezultat_dane)) {
							echo '<table><tr><td>Imię i nazwisko:<td>' . $row["godnosc"] . '</td></tr>' .
							'<tr><td>Adres:<td>'  . $row["adres"] . '</td></tr>' .
							'<tr><td>Telefon:<td>'  . $row["tel"] . '</td></tr>' .
							'<tr><td>E-mail:<td>' . $row["emailcv"] . '</td></tr>' .
							'<tr><td>Data urodzenia:<td>'  . $row["data_urodzenia"] . '</td></tr></table></br></br>';
						}
					}
					
					$rezultat_info = mysqli_query($polaczenie, $cv_info);
					if (mysqli_num_rows($rezultat_info) > 0) {
						while($row = mysqli_fetch_assoc($rezultat_info)) {
							echo '<div id = "Naglowki"><strong>&#9632; ' . $row["naglowek"] . '</strong><hr></div>' .
							'<div id = "Info">' . $row["info"] . "</div></br></br>";
						}
					}
					else {
						echo "Brak wyników";
					}
						
				}			
				$polaczenie->close();
			}
				catch(Exception $e)  {
					$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;CV</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o spróbowanie ponownie w innym terminie.</span></br></br>';
					header('Location: cvcmd.php');
					exit();
					//echo '</br>Informacja developoerska: '.$e;
				}
		?>
		
		<div id="footer">Wyrażam zgodę na przetwarzanie moich danych osobowych zawartych w mojej ofercie pracy dla potrzeb niezbędnych do realizacji procesu rekrutacji 
		(zgodnie z Ustawą z dnia 29.08.1997 roku o Ochronie Danych Osobowych; Dz. U. z 2002r. Nr 101, poz. 926 z póź. zm.).</div>

	</body>
</html>