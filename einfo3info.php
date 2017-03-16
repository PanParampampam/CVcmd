<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['enaglowek'])) {

		$back_or_exit = strtolower($_POST['enaglowek']);
		if ($back_or_exit == "back") {
			unset($_SESSION["stare_info"]);
			header('Location: einfo1wybierz.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['stary_naglowek']);
			unset($_SESSION["einfo"]);
			unset($_SESSION["enaglowek"]);
			header('Location: cvcmd.php');
			exit();
		}
		if ($back_or_exit == "") {
			$_SESSION['error_wybierz'] ='CVcmd:\\' . $_SESSION['user'] . '\einfo\naglowek&gt;</br><span style="color:red">Wprowadź komendę</span></br></br>';
			header('Location: einfo2naglowek.php');
			exit();
		}
		
		else $_SESSION['enaglowek'] = $_POST['enaglowek'];		
	}
	
	else if (!isset($_SESSION['enaglowek'])) {
		header('Location: cvcmd.php');
		exit();
	}
	
	if(isset($_SESSION['einfo'])) {
		$einfo = $_SESSION['einfo'];
	}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="focus.js"></script>
		<script src="mousetrap.min.js"></script>
		<title>CVcmd:\einfo</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			3/4 Edycja wybranej sekcji. Wprowadź nowe informacje.</br></br>
			Podpowiedź: Aby wprowadzić symbol "&bull;" wciśnij CTRL + ENTER.</br>
			Aby zatwierdzić wprowadzanie danych wciśnij SHIFT + ENTER.</br>
			Aby powrócić do poprzedniego punktu wciśnij SHIFT + BACKSPACE. Powrót do punktu 1/3 nie nadpisze danych zawartych w punkcie 2/3 .</br>
			Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/></br>
			<?php
				echo "Nagłówek: " . $_SESSION['enaglowek'] . "</br></br>";
			?>
		</div>
	</head>
	
	<body>
		<script>
			Mousetrap.bind ('shift+enter', function (){
				document.forms["przekaz_info"].submit();
			});
			Mousetrap.bind ('shift+backspace', function (){
				document.getElementById('Commands').value="back";
				document.forms["przekaz_info"].submit();
			});
			Mousetrap.bind ('ctrl+enter', function (){
				document.getElementById('Commands').value+="•";
			});
		</script>
		
		<form method="post" name="przekaz_info" action="einfo4zatwierdz.php">
		<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\einfo\info&gt; 
		<textarea id="Commands" class="mousetrap" name="einfo" autocomplete="off" rows="20"><?php if(isset($einfo))echo $einfo ?></textarea></div>
		</form>
		
	</body>
</html>