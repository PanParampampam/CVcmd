<?php
	session_start();
	
	include('session_timeout.php');
	
		if((!isset($_POST['login']))) {
		header('Location: index.php');
		exit();
		}
	
		$back_or_exit = strtolower($_POST['login']);
		if ($back_or_exit == "exit") {
			header('Location: index.php');
			exit();
		}
		
		$_SESSION['login'] = $_POST['login'];
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="focus.js"></script>
		<title>CVcmd</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Formularz logowania 2/2. Podaj hasło.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz logowania wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
		<form action="login_script.php" method="post">
		<div id = "C">CVcmd:\login\hasło&gt;<input type="password" id="Commands" name="haslo"/>
		</form>
	</body>
</html>