<?php

include $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/autoloader.php";

if(isset($_FILES['file']))
{

	$currentFileInfo = explode(".", $_FILES['file']['name']);

	//end($currentFileInfo) = The extension of the file
	$file = new Files($_FILES['file']['name'], end($currentFileInfo));

	$file->uploadFile($_FILES['file']);
 
}


?>