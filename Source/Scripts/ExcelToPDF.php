<?php

include $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Classes/Office.php";

if (isset($_POST['spreadsheetFile']))
{
	$excel = new Office();
	$excel->convertExcelToPDF($_POST['spreadsheetFile']);
}
else
{
	echo json_encode(array("error" => "Variable vacia"));
}


?>