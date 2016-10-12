<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link type="text/css" rel="stylesheet" href="CVcmd.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="jquery-3.1.1.min.js"></script>
		<script src="CVcmd.js"></script>
		<title>CVcmd0.4.5</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Program do tworzenia CV. Wersja 0.5<br/>
			Twórcy: Jakub Giedrys i Dawid Kędzierski. Projekt na zasadzie open source. <br/>
			Aby zobaczyć listę komend wpisz "help". Aby zobaczyć poradnik wpisz "hts".<br/><br/>
		</div>
	</head>
	
	<body>
		<div id="PastCommands"></div>
		<div id = "Result"></div>
		<div id = "C">C:\&gt;<input type="text" id="Commands" onkeydown="Submit(event)"/>
	</body>
</html>