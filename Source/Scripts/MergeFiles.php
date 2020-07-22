<?php

include ($_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Classes/PDF.php");

if (isset($_POST['filesToMerge']))
{
	$pdf = new PDF();

	$pdf->mergePDF($_POST['filesToMerge']);
}
else 
{
	echo die(json_encode(array("error" => "datos vacios!")));
}


?>