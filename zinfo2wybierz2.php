<?php
	session_start();
	include('session_timeout.php');
	include('zalogowany.php');
	
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	if(isset($_POST['wybierz'])) {

		$back_or_exit = strtolower($_POST['wybierz']);
		if ($back_or_exit == "exit") {
			unset($_SESSION['naglowek1']);
			unset($_SESSION['info1']);
			unset($_SESSION['naglowek2']);
			unset($_SESSION['info2']);
			header('Location: cvcmd.php');
			exit();
		}
		if ($back_or_exit == "") {
			$_SESSION['error_wybierz'] ='CVcmd:\\' . $_SESSION['user'] . '\zinfo\wybierz1&gt;</br><span style="color:red">Wprowadź komendę</span></br></br>';
			header('Location: zinfo1wybierz.php');
			exit();
		}

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
						$_SESSION['naglowek1'] = $row["naglowek"];
						$_SESSION['info1'] = $row["info"];
					}
				}
				else {
					$_SESSION['error_wybierz'] ='CVcmd:\\' . $_SESSION['user'] . '\zinfo\wybierz1&gt;' . $_POST['wybierz'] . '</br><span style="color:red">Podaj nazwę nagłówka lub polecenie.</span></br></br>';
					header('Location: zinfo1wybierz.php');
					exit();
				}
					
			}			
		}
			catch(Exception $e)  {
				$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;zinfo</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o spróbowanie ponownie w innym terminie.</span></br></br>';
				header('Location: cvcmd.php');
				exit();
				//echo '</br>Informacja developoerska: '.$e;
			}
	}
	
	else if (!isset($_SESSION['naglowek1'])) {
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
		<script src="focus.js"></script>
		<title>CVcmd:\zinfo</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

	</head>
	
	<body>
	
			2/3 Poniżej znajdują się wszystkie dodane przez Ciebie sekcje z naznaczonym <span style="color:green">nagłówkiem</span> pierwszej do zamiany.<br/></br>
			Wybierz nazwę drugiego <span style="color:yellow">nagłówka</span> sekcji, które chcesz pozamieniać.</br>
			Aby wrócić do wyboru pierwszej z nich wpisz BACK.<br/>
			Aby wyjść bez zmieniania danych wpisz EXIT.<br/><br/>
			
		<?php
			if(isset($_SESSION['error_wybierz'])) {
				echo $_SESSION['error_wybierz'];
				unset($_SESSION['error_wybierz']);
			}
		?>
	
		<form method="post" action="zinfo3zatwierdz.php">
			<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\zinfo\wybierz1&gt;<input type="text" id="Commands" name="wybierz2" autocomplete="off"/>
		</form>
		
		</br></br>========================================================</br></br>
		
		<?php	

			try {
				$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
				
				if($polaczenie->connect_errno!=0)	{
					throw new Exception(mysqli_connect_errno());
				}
				
				else	{
					$polaczenie ->query("SET NAMES 'utf8'");
					$id = $_SESSION['id'];
					$cv_info = "SELECT naglowek, info FROM info WHERE id_usera='$id'";
						
					$rezultat_info = mysqli_query($polaczenie, $cv_info);
					if (mysqli_num_rows($rezultat_info) > 1) {
						while($row = mysqli_fetch_assoc($rezultat_info)) {
							if ($row["naglowek"] == $_SESSION['naglowek1']) {
								echo '<div style="white-space: pre-line;">Nagłówek: <span style="color:green">' . $row["naglowek"] . "</span></br>Info: " . $row["info"] . "</div></br>";
								echo "========================================================</br></br>";
							}
							else {
								echo '<div style="white-space: pre-line;">Nagłówek: <span style="color:yellow">' . $row["naglowek"] . "</span></br>Info: " . $row["info"] . "</div></br>";
								echo "========================================================</br></br>";
							}
						}			
					}
					else {
					$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;zinfo</br><span style="color:red">Brak sekcji. Stwórz sekcje wpisując +INFO.</span></br></br>';
					header('Location: cvcmd.php');
					exit();
					}
						
				}			
				$polaczenie->close();
			}
				catch(Exception $e)  {
					$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;zinfo</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o spróbowanie ponownie w innym terminie.</span></br></br>';
					header('Location: cvcmd.php');
					exit();
					//echo '</br>Informacja developoerska: '.$e;
				}
		?>
	
	</body>
</html>