<?php
	session_start();
	if (isset($_SESSION['usun_zdjecie'])) unlink($_SESSION['usun_zdjecie']);
	if (isset($_SESSION['usun_cv'])) unlink($_SESSION['usun_cv']);
	session_unset();
	$_SESSION['info']='CVcmd:\&gt;logout</br><span style=color:green>Wylogowano</span></br></br>';
	header('Location: index.php');
?>