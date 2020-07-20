<?php

include ($_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Classes/PDF.php");

$pdf = new PDF();

$pdf->mergePDF($_POST['filesToMerge']);

?>