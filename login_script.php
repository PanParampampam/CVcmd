<?php
	session_start();
	
	require_once('connect.php');
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{	
		$login = $_SESSION['tlogin'];
		$haslo = $_POST['haslo'];
		
		$sql = "SELECT * FROM uzytkownicy WHERE user='$login' AND pass='$haslo'";
		
		if ($rezultat = @$polaczenie->query($sql))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow==1)
			{
				$wiersz = $rezultat->fetch_assoc();
				$_SESSION['user'] = $wiersz['user'];
				
				
				$rezultat->close();
				header('Location: cvcmd.php');
			}
			else
			{
				
			}
		}
		
		$polaczenie->close();
	}
?>