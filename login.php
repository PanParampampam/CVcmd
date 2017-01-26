<?php
	session_start();
	include('session_timeout.php');
?>


<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="focus.js"></script>
		<title>CVcmd:\login</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Formularz logowania 1/2. Podaj login.<br/>
			Aby opuścić formularz logowania wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
		<form action="password.php" method="post">
		<div id = "C">CVcmd:\login\login&gt;<input type="text" id="Commands" name="login" autocomplete="off"/>
		</form>
	</body>
</html>