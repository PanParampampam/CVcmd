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
		<title>CVcmd:\cv</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

	</head>
	
	<body>
	
		Aby edytować lub wprowadzić dane osobowe wpisz +DANE. </br>
		Aby dodać nową sekcje wpisz +INFO.</br>
		Aby edytować sekcje wpisz eINFO.</br>
		Aby zamienić sekcje miejscami wpisz zINFO.</br>
		Aby usunąć sekcje wpisz -INFO.</br>
		<strong>Aby przejśc do ostatniego kroku po którym będziesz mógł wydrukować/ściągnąć swoje CV wpisz DALEJ.</strong></br>
		Aby wyjść do strony głównej wpisz EXIT.</br></br>
	
		<form method="post">
			<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\CV&gt;<input type="text" id="Commands" name="cv" autocomplete="off"/>
		</form>
		
		<?php
			if(isset($_POST['cv'])) {
				$cv = strtolower($_POST['cv']);
				switch ($cv) {
					case "+dane":
						header('Location: dodaj_dane1godnosc.php');
						break;
					case "+info":
						header('Location: dodaj_info1naglowek.php');
						break;
					case "einfo":
						header('Location: einfo1wybierz.php');
						break;
					case "zinfo":
						header('Location: zinfo1wybierz.php');
						break;
					case "-info":
						header('Location: -info1wybierz.php');
						break;
					case "dalej":
						header('Location: cv_zobacz.php');
						break;
					case "exit":
						header('Location: cvcmd.php');
						break;
					default:
						echo 'CVcmd:\\' . $_SESSION['user'] . '\CV&gt;' . $_POST['cv'] . '</br><span style="color:red">Polecenie "' . $_POST['cv'] . '" nie jest rozpoznawalne.</span></br>';
				}
			}
		?>

		
		<div id = "C">
			</br>Informacje zawarte w bazie danych:</br></br>
		</div>
		
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
					$cv_dane = "SELECT godnosc, adres, tel, emailcv, data_urodzenia FROM uzytkownicy WHERE id='$id'";
					$cv_info = "SELECT naglowek, info FROM info WHERE id_usera='$id'";
					
					$rezultat_dane = mysqli_query($polaczenie, $cv_dane);
					if (mysqli_num_rows($rezultat_dane) == 1) {
						while($row = mysqli_fetch_assoc($rezultat_dane)) {
							echo 'Imię i Nazwisko: ' . $row["godnosc"] . "</br>Adres: " . $row["adres"] . "</br>Nr telefonu: " . $row["tel"] .
							"</br>E-mail: " . $row["emailcv"] . "</br>Data urodzenia: " . $row["data_urodzenia"] .
							"</br></br>========================================================</br></br>";
						}
					}
					
					$rezultat_info = mysqli_query($polaczenie, $cv_info);
					if (mysqli_num_rows($rezultat_info) > 0) {
						while($row = mysqli_fetch_assoc($rezultat_info)) {
							echo '<div style="white-space: pre-line;">Nagłówek: ' . $row["naglowek"]. "</br>Info: " . $row["info"] . "</div></br>";
						}
						echo "========================================================</br></br>";
					}
					else {
						echo "Brak wyników";
					}
						
				}			
				$polaczenie->close();
			}
				catch(Exception $e)  {
					$_SESSION['info'] = 'CVcmd:\\' . $_SESSION['user'] . '&gt;+info</br><span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o spróbowanie ponownie w innym terminie.</span></br></br>';
					header('Location: cvcmd.php');
					exit();
					//echo '</br>Informacja developoerska: '.$e;
				}
		?>
		

		

		
	</body>
</html>