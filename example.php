<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<link rel="stylesheet" type="text/css" href="print.css" media="print" />
		<div id = "pomoc">
			<p>Tak wygląda Twoje CV!</p>
			<p>Dodaj do niego swoje zdjęcie wciskając 1 (zostanie ono usunięte z naszej bazy po tym jak się wylogujesz).</p>
			<p>Następnie możesz je wydrukować z poziomu przeglądarki wciskając 2 (zależnie od używanej przeglądarki konieczne może się okazać ustawienie marginesów i wyłączenie nagłówka/stopki)
			<p>lub <strong>zapisać jako pdf wciskając 3.</strong></p>
			<p>Możesz także skopiować tę stronę do pliku doc lub odt zachowując stworzone na tej stronie formatowanie.</p>
			<p>Aby powrócić wciśnij ENTER.</p>

		</div>
		
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
	
	
			<form method="post" enctype="multipart/form-data" name="pokaz_foto" style>
				<input type="file" name="zdjecie" id="zdjecie" onchange="this.form.submit();" style="display: none;">
			</form>

			<button id="pdf" style="display: none;" onclick="window.location.href = 'generator/cv_na_pdf.php';"></button>

		<div id = "CurriculumVitae">
			<strong>Curriculum Vitae</strong>
		</div>
	
		<div id = "Naglowek"><strong>&#9632; Dane osobowe</strong><hr></div>	
			<form method="post" enctype="multipart/form-data" name="pokaz_foto" style>
				<input type="file" name="zdjecie" id="zdjecie" onchange="this.form.submit();" style="display: none;">
			</form>

			<button id="pdf" style="display: none;" onclick="window.location.href = 'generator/cv_na_pdf.php';"></button>

			
			<table><tr><td>Imię i nazwisko:<td>Jakub Giedrys</td></tr><tr><td>Adres:<td>os. Bolesława Śmiałego 37/108, 60-682 Poznań</td></tr><tr><td>Telefon:<td>727 933 007</td></tr><tr><td>E-mail:<td>kuba@gmail.com</td></tr><tr><td>Data urodzenia:<td>01.11.1991</td></tr></table></br></br><div id = "Strona"><span id = "Naglowek"><strong>&#9632; Wykształcenie</strong><hr></span><span id = "Info">1998 - 2003 - Jakaś szkoła
2003 - 2007 - Inna szkoła
2007 - 2013 - Studia</span></div></br></br><div id = "Strona"><span id = "Naglowek"><strong>&#9632; Doświadczenie</strong><hr></span><span id = "Info">•Praca w jakimś miejscu
•Praca w innym miejscu</span></div></br></br><div id = "Strona"><span id = "Naglowek"><strong>&#9632; costa</strong><hr></span><span id = "Info">;sadljfs;lfk</span></div></br></br>		
		<div id="footer">Wyrażam zgodę na przetwarzanie moich danych osobowych zawartych w mojej ofercie pracy dla potrzeb niezbędnych do realizacji procesu rekrutacji 
		(zgodnie z Ustawą z dnia 29.08.1997 roku o Ochronie Danych Osobowych; Dz. U. z 2002r. Nr 101, poz. 926 z póź. zm.).</div>

		
		
		
	</body>
</html>