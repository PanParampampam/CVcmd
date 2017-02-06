<?php
	session_start();
	unlink($_SESSION['usun_zdjecie']);
	session_unset();
	$_SESSION['info']='CVcmd:\&gt;logout</br><span style=color:green>Wylogowano</span></br></br>';
	header('Location: index.php');
?>