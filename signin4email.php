<?php
	session_start();
	
	include('session_timeout.php');
	
	if(isset($_POST['password_check'])) {
		
		$back_or_exit = strtolower($_POST['password_check']);
		if ($back_or_exit == "back") {
			header('Location: signin2password.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['nick']);
			unset($_SESSION['password']);
			unset($_SESSION['password_check']);
			header('Location: index.php');
			exit();
		}
		
		if ($_POST['password_check'] != $_SESSION['password']) {
			$_SESSION['error_password'] ="CVcmd:\signin\hasło&gt;</br><span style=color:red>Hasła nie są takie same.</span></br></br>";
			header('Location: signin2password.php');
			exit();
		}
		else {
			$_SESSION['password'] = password_hash($_SESSION['password'], PASSWORD_DEFAULT);
			$_SESSION['password_check'] = true;
		}
	}
	else if (!isset($_SESSION['password'])) {
		header('Location: signin1user.php');
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
		<script src="mousetrap.min.js"></script>
		<script src="focus.js"></script>
		<title>CVcmd:\signin</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<div id = "C">
			Formularz rejestracji 4/5. Podaj adres e-mail.<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez rejestrowania wpisz EXIT.<br/><br/>
			<?php
				if(isset($_SESSION['error_email'])) {
				echo $_SESSION['error_email'];
				unset($_SESSION['error_email']);
				}
			?>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="signin5humanordancer.php">
			<div id = "C">CVcmd:\signin\e-mail&gt;<input type="text" id="Commands" name="email" autocomplete="off" class="mousetrap"/>
		</form>
	
	</body>
</html>