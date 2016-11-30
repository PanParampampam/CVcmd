<?php
	session_start();
	
	include('session_timeout.php');
	
	if(isset($_POST['email'])) {
		
		$back_or_exit = strtolower($_POST['email']);
		if ($back_or_exit == "back") {
			header('Location: signin2password.php');
			exit();
		}
		if ($back_or_exit == "exit") {
			unset($_SESSION['nick']);
			unset($_SESSION['password']);
			unset($_SESSION['password_check']);
			unset($_SESSION['email']);
			header('Location: index.php');
			exit();
		}
		
		require_once('connect.php');
		$polaczenie =  @new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie->connect_errno!=0) {
			$_SESSION['info'] = "C:\&gt;signin</br><span style=color:red>Error: $polaczenie->connect_errno</span></br></br>";
			header('Location: index.php');
			exit();
		}
		
		else {
		
			$email_check = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
			if (filter_var($email_check, FILTER_VALIDATE_EMAIL) == false || ($email_check != $_POST['email'])) {
				$_SESSION['error_email'] ="C:\signin\e-mail&gt;" . $_POST['email'] . "</br><span style=color:red>Nieprawidłowy adres e-mail.</span></br></br>";
				header('Location: signin4email.php');
				exit();
			}
			
			$rezultat = $polaczenie->query("SELECT * FROM uzytkownicy WHERE email='$email_check'");
			$istnieje_w_bazie = $rezultat->num_rows;
			if($istnieje_w_bazie > 0) {
				$_SESSION['error_email'] ="C:\signin\e-mail&gt;" . $_POST['email'] . "</br><span style=color:red>Podany adres e-mail jest zajęty.</span></br></br>";
				header('Location: signin4email.php');
				exit();
			}
			
			else  $_SESSION['email'] = $_POST['email'];
		}
	}
	else if (!isset($_SESSION['password_check'])) {
		header('Location: signin1user.php');
		exit();
	}
	
	$_SESSION['validate'] = rand(0, 9);
	
	include('signin5validate.php');
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
			Formularz rejestracji 5/5. Udowodnij żeś człek. <?php echo $pytanie[$_SESSION['validate']] ?><br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez rejestrowania wpisz EXIT.<br/><br/>
			<?php
				if(isset($_SESSION['error_robot'])) {
				echo $_SESSION['error_robot'];
				unset($_SESSION['error_robot']);
				}
			?>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="signin6register.php">
			<div id = "C">C:\signin\walidacja&gt;<input type="text" id="Commands" name="robot" autocomplete="off"/>
		</form>
	
	</body>
</html>