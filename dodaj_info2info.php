<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['naglowek'])) {
		
		$back_or_exit = strtolower($_POST['naglowek']);
		if ($back_or_exit == "exit") {
			unset($_SESSION['naglowek']);
			unset($_SESSION['info']);
			header('Location: cvcmd.php');
			exit();
		}
		
		else $_SESSION['naglowek'] = $_POST['naglowek'];
	}
	
	else if (!isset($_SESSION['naglowek'])) {
	header('Location: cvcmd.php');
	exit();
	}
	
	if(isset($_SESSION['info'])) {
		$info = $_SESSION['info'];
	}
	
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="focus.js"></script>
		<script src="mousetrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<title>CVcmd:\+info</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Formularz wprowadzania informacji do CV 2/3. Wprowadź dane.</br>
			Podpowiedź: Aby wprowadzić symbol "&bull;" wciśnij CTRL + ENTER.</br>
			Aby powrócić do poprzedniego punktu wpisz BACK (lub wciśnij SHIFT + BACKSPACE). Powrót do punktu 1/3 nie nadpisze danych zawartych w punkcie 2/3 .</br>
			Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/>
			Aby zatwierdzić wprowadzanie danych wciśnij SHIFT + ENTER.</br></br>
			<?php
				echo "Nagłówek: " . $_SESSION['naglowek'] . "</br></br>";
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
		
		<form method="post" name="przekaz_info" action="dodaj_info3zatwierdz.php">
		<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\+info\info&gt; 
		<textarea id="Commands" class="mousetrap" name="info" autocomplete="off" rows="20"><?php if(isset($info))echo $info ?></textarea>
		</form>
		
	</body>
</html>