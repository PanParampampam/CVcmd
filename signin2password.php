<?php
	session_start();
	
	include('session_timeout.php');
	
	if(isset($_POST['nick'])) {
		
		require_once('connect.php');
		$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie->connect_errno!=0) {
			$_SESSION['info'] = "CVcmd:\&gt;signin</br><span style=color:red>Error: $polaczenie->connect_errno</span>";
			header('Location: index.php');
			exit();
		}
		
		else {
			
			$back_or_exit = strtolower($_POST['nick']);
			if ($back_or_exit == "back") {
				$_SESSION['error_nick'] ="CVcmd:\signin\uzytkownik&gt;back</br><span style=color:red>Podana nazwa użytkownika jest już zajęta.</span></br></br>";
				header('Location: signin1user.php');
				exit();
			}
			if ($back_or_exit == "exit") {
				unset($_SESSION['nick']);
				header('Location: index.php');
				exit();
			}
			
			$nick = $_POST['nick'];
			$nick = htmlentities($nick, ENT_QUOTES, "UTF-8");
			$rezultat = $polaczenie->query(sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
			mysqli_real_escape_string($polaczenie, $nick)));
			$istnieje_w_bazie = $rezultat->num_rows;
			if($istnieje_w_bazie > 0) {
				$_SESSION['error_nick'] ="CVcmd:\signin\uzytkownik&gt;" . $_POST['nick'] . "</br><span style=color:red>Podana nazwa użytkownika jest już zajęta.</span></br></br>";
				header('Location: signin1user.php');
				exit();
			}
			
		
			if ((strlen($_POST['nick'])) < 3 || (strlen($_POST['nick']) > 15)) {
				$_SESSION['error_nick'] ="CVcmd:\signin\uzytkownik&gt;" . $_POST['nick'] . "</br><span style=color:red>Nazwa użytkownika musi posiadać od 3 do 15 znaków.</span></br></br>";
				header('Location: signin1user.php');
				exit();
			}
			
			if(ctype_alnum($_POST['nick']) == false) {
				$_SESSION['error_nick'] = "CVcmd:\signin\uzytkownik&gt;" . $_POST['nick'] . "</br><span style=color:red>Nick nie może zawierać polskich znaków, musi się składać z liter i/lub cyfr.</span></br></br>";
				header('Location: signin1user.php');
				exit();
			}
			
			else $_SESSION['nick'] = $_POST['nick'];
		}
	}
	else if (!isset($_SESSION['nick'])) {
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
			Formularz rejestracji 2/5. Podaj hasło (od 6 do 20 znaków)<br/>
			Aby powrócić do poprzedniego punktu wpisz BACK. Aby opuścić formularz bez rejestrowania wpisz EXIT.<br/><br/>
			<?php
				if(isset($_SESSION['error_password'])) {
				echo $_SESSION['error_password'];
				unset($_SESSION['error_password']);
				}
			?>
		</div>
	</head>
	
	<body>
	
		<form method="post" action="signin3password_check.php">
			<div id = "C">CVcmd:\signin\hasło&gt;<input type="password" id="Commands" name="password" class="mousetrap"/>
		</form>
	
	</body>
</html>