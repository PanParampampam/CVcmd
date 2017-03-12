<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="focus.js"></script>
		<title>CVcmd:\signout</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Aby usunąć konto użytkownika wpisz swoje hasło. <span style=color:red>Wszystkie dane powiązane z tym kontem również zostaną usunięte.</span><br/>
			Aby wyjść bez usuwania konta wpisz EXIT.<br/><br/>
		</div>
	</head>
	
	<body>
		<form action="signout2usun.php" method="post">
		<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\signout\hasło&gt;<input type="password" id="Commands" name="haslo"/>
		</form>
	</body>
</html>