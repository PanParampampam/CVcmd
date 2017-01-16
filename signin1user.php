<?php
	session_start();
	
	include('session_timeout.php');
	
	$_SESSION['validate_count'] = 3;
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
			Formularz rejestracji 1/5. Podaj nazwę użytkownika (od 3 do 15 znaków alfanumerycznych, bez polskich).<br/>
			Aby opuścić formularz bez rejestrowania wpisz EXIT.<br/><br/>
			<?php
				if(isset($_SESSION['error_nick'])) {
				echo $_SESSION['error_nick'];
				unset($_SESSION['error_nick']);
				}
			?>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="signin2password.php">
			<div id = "C">CVcmd:\signin\uzytkownik&gt;<input type="text" id="Commands" name="nick" autocomplete="off"/>
		</form>
	
	</body>
</html>