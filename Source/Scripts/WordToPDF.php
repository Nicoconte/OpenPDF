<?php

include $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Classes/Office.php";

if (isset($_POST['wordFile']))
{
	$word = new Office();
	$word->convertWordToPDF($_POST['wordFile']);
}
else
{
	echo json_encode(array("error" => "Variable vacia"));
}


?>