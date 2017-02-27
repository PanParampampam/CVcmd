<?php
	session_start();
	include('../session_timeout.php');
	include('../zalogowany.php');
	
	require_once 'dompdf/autoload.inc.php';


use Dompdf\Dompdf;
use Dompdf\Options;


$dompdf = new Dompdf();
$options = new Options();
$options->setIsRemoteEnabled(true);

$dompdf->setOptions($options);
$dompdf->output();
	$id = $_SESSION['id'] . ".html";
	$html = file_get_contents($id);
	$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream();

?>
