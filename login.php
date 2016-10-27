<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="focus.js"></script>
		<title>CVcmd0.4.5</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Podaj login.<br/><br/>
		</div>
	</head>
	
	<body>
		<form action="password.php" method="post">
		<div id = "C">Login: <input type="text" id="Commands" name="login"/>
		</form>
	</body>
</html>