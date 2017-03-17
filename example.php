<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<link rel="stylesheet" type="text/css" href="print.css" media="print" />
		<div id = "pomoc">
			<p>Tak wygląda CV po dodaniu danych osobowych i sekcji z informacjami.</p>
			<p>W fazie końcowej można dodać swoje zdjęcie klikając 1 (dla ułatwienia, tutaj zdjęcie zostało już zamieszczone). </p>
			<p>Zdjęcie które zamieszczach zostanie automatycznie usunięte z naszej bazy danych po Twoim wylogowaniu, wygaśnięciu sekcji lub po upływie 12 godzin od jego zamieszczenia. </p>
			<p>Następnie możesz wydrukować swoje CV z poziomu przeglądarki wciskając 2 (zależnie od używanej przeglądarki konieczne może się okazać ustawienie marginesów i wyłączenie nagłówka/stopki)
			<p>lub <strong>zapisać jako pdf wciskając 3 (Działa również na stronie testowej).</strong></p>
			<p>Możesz także skopiować tę stronę do pliku doc lub odt zachowując stworzone na tej stronie formatowanie.</p>
			<p>Aby powrócić wciśnij ENTER.</p>

		</div>
		
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="cv_zobacz.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="mousetrap.min.js"></script>
		<title>CVcmd:\CV</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

	</head>
	
	<body>
	
		<div id = "CurriculumVitae">
			<strong>Curriculum Vitae</strong>
		</div>
	
		<div id = "Naglowek"><strong>&#9632; Dane osobowe</strong><hr></div>	

		<button id="pdf" style="display: none;" onclick="window.location.href = 'generator/who.php';"></button>

		<img id='foto' src='http://localhost/cvcmd/uploads/who.jpg'>
		<table><tr><td>Imię i nazwisko:<td>Doktor</td></tr><tr><td>Adres:<td>TARDIS</td></tr><tr><td>Telefon:<td>07700 900461</td></tr><tr><td>E-mail:<td>dwho@allonsy.com</td></tr><tr><td>Data urodzenia:<td>23.11.1963</td></tr></table></br></br><div id = "Strona"><span id = "Naglowek"><strong>&#9632; Umiejętności</strong><hr></span><span id = "Info">• Podróże w czasie
		• Komunikatywność
		• Bieganie
		• Wiedza ogólna</span></div></br></br><div id = "Strona"><span id = "Naglowek"><strong>&#9632; Doświadczenie</strong><hr></span><span id = "Info">SPORE.</span></div></br></br><div id = "Strona"><span id = "Naglowek"><strong>&#9632; Zainteresowania</strong><hr></span><span id = "Info">Wszechświat, ludzie, czas... wszystko poza jabłkami, jabłka są ohydne.</span></div></br></br><div id = "Strona"><span id = "Naglowek"><strong>&#9632; Dodatkowe atuty</strong><hr></span><span id = "Info">Mobilność, śrubokręt soniczny, papier parapsychiczny</span></div></br></br>		
		<div id="footer">Wyrażam zgodę na przetwarzanie moich danych osobowych zawartych w mojej ofercie pracy dla potrzeb niezbędnych do realizacji procesu rekrutacji 
		(zgodnie z Ustawą z dnia 29.08.1997 roku o Ochronie Danych Osobowych; Dz. U. z 2002r. Nr 101, poz. 926 z póź. zm.).</div>
		
		<script>
		Mousetrap.bind ('enter', function (){
		window.location.href = "index.php";
		});

		Mousetrap.bind ('2', function (){
			window.print();
		});

		Mousetrap.bind ('3', function (){
			document.getElementById("pdf").click();
		});
		</script>
			
	</body>
</html>