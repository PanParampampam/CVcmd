<?php
	session_start();
	
	if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: cvcmd.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="script.js"></script>
		<script src="focus.js"></script>
		<title>CVcmd</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Program do tworzenia CV. Wersja 0.9<br/>
			Twórca: Jakub Giedrys. Projekt na zasadzie open source. <br/>
			Aby zobaczyć listę komend wpisz HELP.<br/><br/>
		</div>
	</head>
	
	<body>
			<?php
			if (isset($_SESSION['info'])) {
				 echo $_SESSION['info'];
				 unset($_SESSION['info']);
			}
			?>
		<div id="PastCommands"></div>
		<div id="Result"></div>
		<div id="C">CVcmd:\&gt;<input type="text" id="Commands" autocomplete="off" onkeydown="Submit(event)"/>
	</body>
</html>