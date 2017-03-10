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
		<title>CVcmd:\+info</title>
		<meta name="description" content="Tworzenie CV w środowisku podobnym do lini poleceń"/>
		<meta name="keywords" content="CV, cmd, cvcmd, command line, wiersz poleceń"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	</head>
	
	<body>
	
		1/3 Wprowadzanie nowej sekcji do CV. Podaj nagłówek (np. Wykształcenie, Doświadczenie, Umiejętności, Zainteresowania itp.)<br/></br>
		Aby opuścić formularz bez wprowadzania danych wpisz EXIT.<br/><br/>
		
		<?php
			if(isset($_SESSION['error_naglowek'])) {
				echo $_SESSION['error_naglowek'];
				unset($_SESSION['error_naglowek']);
			}
		?>
	
		<form method="post" action="+info2info.php">
			<div id = "C">CVcmd:\<?php echo $_SESSION['user']?>\+info\nagłówek&gt;<input type="text" id="Commands" name="naglowek" autocomplete="off"/>
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
					$cv_info = "SELECT naglowek, info FROM info WHERE id_usera='$id'";
						
					$rezultat_info = mysqli_query($polaczenie, $cv_info);
					if (mysqli_num_rows($rezultat_info) > 0) {
						while($row = mysqli_fetch_assoc($rezultat_info)) {
							if ((isset($_SESSION['utworzony_naglowek'])) and ($row["naglowek"] == $_SESSION['utworzony_naglowek'])) {
								echo '<div style="white-space: pre-line;">Nagłówek: <span style="color:green">' . $row["naglowek"]. "</span></br>Info: " . $row["info"] . "</div></br>";
								echo "========================================================</br></br>";
								unset($_SESSION['utworzony_naglowek']);
							}
							else if ((isset($_SESSION['istniejacy_naglowek'])) and ($row["naglowek"] == $_SESSION['istniejacy_naglowek'])) {
								echo '<div style="white-space: pre-line;">Nagłówek: <span style="color:red">' . $row["naglowek"]. "</span></br>Info: " . $row["info"] . "</div></br>";
								echo "========================================================</br></br>";
								unset($_SESSION['istniejacy_naglowek']);
							}
							else {
								echo '<div style="white-space: pre-line;">Nagłówek: <span style="color:yellow">' . $row["naglowek"]. "</span></br>Info: " . $row["info"] . "</div></br>";
								echo "========================================================</br></br>";
							}
						}
					}
					else {
						echo 'W tym miejscu pokazane będą utworzone przez Ciebie sekcje, na przykładzie: </br>';
						echo 'Nagłówek: Umiejętności</br>';
						echo 'Info: Podróże w czasie, znajomość różnych kultur, bieganie</br></br>';
						echo "========================================================</br></br>";
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
		?>
	
	</body>
</html>