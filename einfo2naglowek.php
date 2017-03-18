<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['wybierz'])) {

		$back_or_exit = strtolower($_POST['wybierz']);
		if ($back_or_exit == "exit") {
			unset($_SESSION['enaglowek']);
			unset($_SESSION['stary_naglowek']);
			unset($_SESSION["einfo"]);
			header('Location: cvcmd.php');
			exit();
		}
		if ($back_or_exit == "") {
			$_SESSION['error_wybierz'] ='CVcmd:\\' . $_SESSION['user'] . '\einfo\wybierz&gt;</br><span style="color:red">Wprowadź komendę</span></br></br>';
			header('Location: einfo1wybierz.php');
			exit();
		}
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);

		try {
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			
			if($polaczenie->connect_errno!=0)	{
				throw new Exception(mysqli_connect_errno());
			}
			
			else	{
				$polaczenie ->query("SET NAMES 'utf8'");
				$id = $_SESSION['id'];
				$wybierz = $_POST['wybierz'];
				$cv_info = "SELECT naglowek, info FROM info WHERE id_usera='$id' AND naglowek='$wybierz'";
					
				$rezultat_info = mysqli_query($polaczenie, $cv_info);
				if (mysqli_num_rows($rezultat_info) > 0) {
					while($row = mysqli_fetch_assoc($rezultat_info)) {
						$stary_naglowek = $row["naglowek"];
						$_SESSION['stary_naglowek'] = $stary_naglowek;
						$_SESSION['einfo'] = $row["info"];
					}
				}
				else {
					$_SESSION['error_wybierz'] ='CVcmd:\\' . $_SESSION['user'] . '\einfo\wybierz&gt;' . $_POST['wybierz'] . '</br><span style="color:red">Podaj nazwę nagłówka lub polecenie.</span></br></br>';
					header('Location: einfo1wybierz.php');
					exit();
				}
					
			}			
			$polaczenie->close();
		}
			catch(Exception $e)  {
				$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;einfo</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o spróbowanie ponownie w innym terminie.</span></br></br>';
				header('Location: cvcmd.php');
				exit();
				//echo '</br>Informacja developoerska: '.$e;
			}
	}
	
	else if (!isset($_SESSION['enaglowek'])) {
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="mousetrap.min.js"></script>
		<script src="focus.js"></script>
		<title>CVcmd:\einfo</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

	</head>
	
	<body>
	
		2/4 Edycja wybranej sekcji. Podaj nową nazwę nagłówka.<br/></br>
		Aby powrócić do wyboru sekcji wpisz BACK.</br>
		Aby wyjść bez zmieniania danych wpisz EXIT.<br/><br/>
	
		<form method="post" action="einfo3info.php">
		<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\einfo\nagłówek&gt;<input type="text" id="Commands" name="enaglowek" 
		autocomplete="off" class="mousetrap" value="<?php if(isset($stary_naglowek))echo htmlspecialchars($stary_naglowek)?>"/></form>
		
	</body>
</html>