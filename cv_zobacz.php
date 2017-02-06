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
	
			<form method="post" enctype="multipart/form-data" name="pokaz_foto" style>
				<input type="file" name="fileToUpload" id="fileToUpload" onchange="this.form.submit();" style="display: none;">
			</form>


			<?php
				error_reporting(0);
				$target_file = "uploads/" . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = true;
				$extension = pathinfo($target_file, PATHINFO_EXTENSION);
				$new_foto = $id . '.' . $extension;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

				if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check == false) {
						$uploadOk = false;
					}
				}

				if ($_FILES["fileToUpload"]["size"] > 5000000) {
					echo "Sorry, your file is too large.";
					$uploadOk = false;
				}
				
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
					echo "nie zjecie";
					$uploadOk = false;
				}

				if ($uploadOk == false) {
					//echo "Sorry, your file was not uploaded.";

				} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/$new_foto")) {
						include('smart_resize_image.function.php');
						$resize = "uploads/" . $new_foto;
						smart_resize_image($resize , null, 0 , 134 , true , $resize , true , false ,100 );
						echo "<img id='foto' src='uploads/$new_foto'>";
						$_SESSION['usun_zdjecie'] = $resize;
					} else {
						//echo "Sorry, there was an error uploading your file.";
					}
				}
			?>

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
						echo "Żadne informacje nie zostały wprowadzone do CV";
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