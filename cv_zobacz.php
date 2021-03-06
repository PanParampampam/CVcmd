﻿<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<link rel="stylesheet" type="text/css" href="print.css" media="print" />
		<div id = "pomoc">
			<p>Tak wygląda Twoje CV!</p>
			<p>Dodaj do niego swoje zdjęcie wciskając 1 (zostanie ono usunięte z naszej bazy po tym jak się wylogujesz).</p>
			<?php
				if(isset($_FILES['zdjecie'])){
					$error= null;
					error_reporting(0);
					$target_file = "uploads/" . basename($_FILES["zdjecie"]["name"]);
					$extension = pathinfo($target_file, PATHINFO_EXTENSION);
					$new_foto = $id . '.' . $extension;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				  
					$expensions= array("jpeg","jpg","png");
					if(in_array($extension, $expensions)=== false) {
						$error="<p style=color:red>Zdjęcie musi być w formacie jpg/jpeg/png.</p>";
					}
				  
					if($file_size > 10485760){
						$error="<p style=color:red>Zdjęcie nie może mieć więcej niż 10MB.</p>";
					}
				}
				
				if(empty($error) == false) {
					echo $error;
				}
			?>
			<p>Następnie możesz je wydrukować z poziomu przeglądarki wciskając 2 (zależnie od używanej przeglądarki konieczne może się okazać ustawienie marginesów i wyłączenie nagłówka/stopki)
			<p>lub <strong>zapisać jako pdf wciskając 3.</strong></p>
			<p>Możesz także skopiować tę stronę do pliku doc lub odt zachowując stworzone na tej stronie formatowanie.</p>
			<p>Aby powrócić wciśnij ENTER.</p>

		</div>
		
		<?php
			ob_start();
		?>
		
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="cv_zobacz.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="mousetrap.min.js"></script>
		<script src="cv_zobacz.js"></script>
		<title>CVcmd:\CV</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

	</head>
	
	<body>

	
		<div id = "CurriculumVitae">
			<strong>Curriculum Vitae</strong>
		</div>
	
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
					
					echo '<div id = "Naglowek"><strong>&#9632; Dane osobowe</strong></div><hr>';
			?>
	
			<form method="post" enctype="multipart/form-data" name="pokaz_foto" style>
				<input type="file" name="zdjecie" id="zdjecie" onchange="this.form.submit();" style="display: none;">
			</form>

			<button id="pdf" style="display: none;" onclick="window.location.href = 'generator/cv_na_pdf.php';"></button>

			<?php
				if((isset($_FILES['zdjecie'])) and (empty($error)==true)) {
					error_reporting(0);
					$target_file = "uploads/" . basename($_FILES["zdjecie"]["name"]);
					$extension = pathinfo($target_file, PATHINFO_EXTENSION);
					$new_foto = $id . '.' . $extension;
					if (move_uploaded_file($_FILES["zdjecie"]["tmp_name"], "uploads/$new_foto")) {
						include('smart_resize_image.function.php');
						$resize = "uploads/" . $new_foto;
						smart_resize_image($resize , null, 0 , 134 , true , $resize , true , false ,100 ); //nazwa/nie wazne/szer/wys/proporcje/nowa nazwa/usun stare/nie wazne/jakosc
						echo "<img id='foto' src='http://localhost/cvcmd/uploads/$new_foto'>";
						$_SESSION['usun_zdjecie'] = $resize;
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
							'<tr><td>Data urodzenia:<td>'  . $row["data_urodzenia"] . '</td></tr></table><p></p>';
							
							$_SESSION["godnosc"] = $row["godnosc"]; //zapisane do nazwy CV
							
						}
					}
					
					$rezultat_info = mysqli_query($polaczenie, $cv_info);
					if (mysqli_num_rows($rezultat_info) > 0) {
						while($row = mysqli_fetch_assoc($rezultat_info)) {
							echo '<div id = "Strona"><span id = "Naglowek"><strong>&#9632; ' . $row["naglowek"] . '</strong></span><hr>' .
							'<span id = "Info">' . $row["info"] . "</span></div><p></p>";
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

		
		<?php
			file_put_contents('generator/' . $id . '.html', ob_get_contents());
			$_SESSION['usun_cv'] = "generator/" . $id . ".html";
		?>
		
	</body>
</html>