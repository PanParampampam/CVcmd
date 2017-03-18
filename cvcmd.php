<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="mousetrap.min.js"></script>
		<script src="script_cvcmd.js"></script>
		<script src="focus.js"></script>
		<title>CVcmd:\</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Strona do tworzenia CV z możliwością zapisania go jako PDF.<br/>
			Twórca: Jakub Giedrys. Kontakt: giedrysjakub@gmail.com. <br/>
			Aby zobaczyć listę komend wpisz HELP (Wielkość liter przy wpisywaniu komend nie ma znaczenia).<br/><br/>
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
		<textarea hidden  id="User"><?php echo $user?></textarea>
		<div id="Result"></div>
		<div id="C">CVcmd:\<?php echo $user?>&gt;<input type="text" id="Commands" autocomplete="off" onkeydown="Submit(event)" class="mousetrap"/>
	</body>
</html>