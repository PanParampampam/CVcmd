<?php
	session_start();
	
	require_once 'dompdf/autoload.inc.php';
	
	use Dompdf\Dompdf;
	use Dompdf\Options;

	$dompdf = new Dompdf();
	$options = new Options();
	$options->setIsRemoteEnabled(true);
	$dompdf->setOptions($options);
	$dompdf->output();
	
	$html = file_get_contents("who.html");
	$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream("CV - Doctor Who");
?>
