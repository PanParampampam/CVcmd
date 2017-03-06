<?php
	$time = $_SERVER["REQUEST_TIME"];
	$timeout_duration = 1800;
	if (isset($_SESSION["LAST_ACTIVITY"]) && ($time - $_SESSION["LAST_ACTIVITY"]) > $timeout_duration) {
		if (isset($_SESSION['usun_zdjecie'])) unlink($_SESSION['usun_zdjecie']);
		if (isset($_SESSION['usun_cv'])) unlink($_SESSION['usun_cv']);
		session_unset();     
		session_destroy();
		header('Location: index.php');  
	}
	$_SESSION["LAST_ACTIVITY"] = $time;
?>