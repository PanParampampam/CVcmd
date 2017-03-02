<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	if(isset($_POST['wybierz'])) {
	
		$back_or_exit = strtolower($_POST['wybierz']);
		if ($back_or_exit == "exit") {
			unset($_SESSION['wybierz']);
			header('Location: cvcmd.php');
			exit();
		}
		if ($back_or_exit == "") {
			$_SESSION['error_wybierz'] ='CVcmd:\\' . $_SESSION['user'] . '\-info&gt;</br><span style="color:red">Wprowadź komendę</span></br></br>';
			header('Location: -info1wybierz.php');
			exit();
		}
	}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
		<script src="focus.js"></script>
		<title>CVcmd:\cv</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

	</head>
	
	<body>
	
			<?php
				if(isset($_SESSION['error_zatwierdz'])) {
					echo $_SESSION['error_zatwierdz'];
					unset($_SESSION['error_zatwierdz']);
				}
			?>
	
			Poniżej znajdują się wybrana do usunięcia sekcja.<br/></br>
			Aby ją usunąć wpisz USUN</br>
			Aby wybrać inną sekcję wpisz BACK</br>
			Aby wyjść bez usuwania danych wpisz EXIT.<br/><br/>
	
		<form method="post" action="-info3usun.php">
			<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\-info\zatwierdz&gt;<input type="text" id="Commands" name="zatwierdz" autocomplete="off"/>
		</form>
		
		</br></br>========================================================</br></br>
		
		<?php	
		
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
					$_SESSION['wybierz'] = $_POST['wybierz'];
					
					$cv_info = "SELECT naglowek, info FROM info WHERE id_usera='$id' AND naglowek='$wybierz'";
						
					$rezultat_info = mysqli_query($polaczenie, $cv_info);
					if (mysqli_num_rows($rezultat_info) > 0) {
						while($row = mysqli_fetch_assoc($rezultat_info)) {
							echo '</br></br><div style="white-space: pre-line;">Nagłówek: <span style="color:red">' . $row["naglowek"]. "</span></br>Info: " . $row["info"] . "</div></br>";
							echo "========================================================</br></br>";
						}			
					}
					else {
						$_SESSION['error_wybierz'] ='CVcmd:\\' . $_SESSION['user'] . '\-info&gt;' . $_POST['wybierz'] . '</br><span style="color:red">Podaj nazwę nagłówka lub polecenie.</span></br></br>';
						header('Location: -info1wybierz.php');
					}
						
				}			
				$polaczenie->close();
			}
				catch(Exception $e)  {
					$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;-info</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o spróbowanie ponownie w innym terminie.</span></br></br>';
					header('Location: cvcmd.php');
					exit();
					//echo '</br>Informacja developoerska: '.$e;
				}
		?>
		

		

		
	</body>
</html>