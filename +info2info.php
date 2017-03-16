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
		if ($back_or_exit == "") {
			$_SESSION['error_naglowek'] ='CVcmd:\\' . $_SESSION['user'] . '\+info\nagłówek&gt;</br><span style="color:red">Wprowadź komendę lub nazwę nagłówka</span></br></br>';
			header('Location: +info1naglowek.php');
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
				$naglowek = $_POST['naglowek'];
				$cv_info = "SELECT naglowek, info FROM info WHERE id_usera='$id' AND naglowek='$naglowek'";
					
				$rezultat_info = mysqli_query($polaczenie, $cv_info);
				if (mysqli_num_rows($rezultat_info) > 0) {
					$row = mysqli_fetch_assoc($rezultat_info);
					$_SESSION['istniejacy_naglowek'] = $row['naglowek'];
					$_SESSION['error_naglowek'] ='CVcmd:\\' . $_SESSION['user'] . '\+info\nagłówek&gt;' . $_POST['naglowek'] . '</br><span style="color:red">Sekcja o takim nagłówku już istnieje.</span></br></br>';
					header('Location: +info1naglowek.php');
					exit();
					}
					
				else $_SESSION['naglowek'] = $_POST['naglowek'];
				}
			$polaczenie->close();
		}
			catch(Exception $e)  {
				$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;+info</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o spróbowanie ponownie w innym terminie.</span></br></br>';
				header('Location: cvcmd.php');
				exit();
				//echo '</br>Informacja developoerska: '.$e;
			}
		
		
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
			2/3 Wprowadzanie nowej sekcji do CV. Wprowadź dane.</br></br>
			Podpowiedź: Aby wprowadzić symbol "&bull;" wciśnij CTRL + ENTER.</br>
			Aby zatwierdzić wprowadzanie danych wciśnij SHIFT + ENTER.</br>
			Aby powrócić do poprzedniego punktu wciśnij SHIFT + BACKSPACE. Powrót do punktu 1/3 nie nadpisze danych zawartych w punkcie 2/3 .</br>
			Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/></br>
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
		
		<form method="post" name="przekaz_info" action="+info3zatwierdz.php">
		<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\+info\info&gt;
		<textarea id="Commands" class="mousetrap" name="info" autocomplete="off" rows="20"><?php if(isset($info))echo $info ?></textarea></div>
		
	</body>
</html>