<?php

include $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Classes/Files.php";

if(isset($_FILES['file']))
{

	$file = new Files();

	$file->uploadFile($_FILES['file']);
 
}


?>