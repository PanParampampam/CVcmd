<?php
	session_start();
	
	include('session_timeout.php');
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit;
	}
	
	if(isset($_POST['naglowek'])) {
		
		$back_or_exit = strtolower($_POST['naglowek']);
		if ($back_or_exit == "exit") {
			unset($_SESSION['naglowek']);
			header('Location: cvcmd.php');
			exit();
		}
		
		else $_SESSION['naglowek'] = $_POST['naglowek'];
	}
	
	else if (!isset($_SESSION['naglowek'])) {
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
		<script src="focus.js"></script>
		<title>CVcmd - rejestracja</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Formularz wprowadzania informacji do CV. Wprowadź dane.</br>
			Podpowiedź: Aby wprowadzić symbol "&bull;" wpisz '&#38;bull;'. Będzie on widoczny po zatwierdzeniu.</br>
			Aby przejść do następnej linii wciśnij ENTER. Na końcu linii pojawi się symbol '&#60;/br>' - oznacza on przejście do następnej linii i zniknie po zatwierdzeniu.</br>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/>
			Aby zatwierdzić wprowadzanie danych wciśnij SHIFT + ENTER.</br></br>
			<?php
				echo "Nagłówek: " . $_SESSION['naglowek'] . "</br>";
				if(isset($_SESSION['error_info'])) {
				echo $_SESSION['error_info'];
				unset($_SESSION['error_info']);
				}
			?>
		</div>
	</head>
	
	<body>
		<script>
		document.addEventListener("keypress", function(key) {
			if(key.keyCode == 13 && key.shiftKey) {
				document.forms["przekaz_info"].submit();
			}
			if(key.keyCode == 13) {
				document.getElementById('Commands').value+="</br>";
			}});
		</script>
		
		<form method="post" name="przekaz_info" action="dodaj_info3zatwierdz.php">
		<div id = "C">C:\<?php echo $_SESSION['user']?>\+info\info&gt; <textarea id="Commands" name="info" autocomplete="off" rows="20"></textarea>
		</form>
		
	</body>
</html>