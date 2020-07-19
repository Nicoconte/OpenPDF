<?php

include $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/autoloader.php";

if(isset($_FILES['file']))
{

	//$currentFileInfo = explode(".", $_FILES['file']['name']);

	//current($currentFileInfo) = The name of the file | end($currentFileInfo) = The extension of the file
	$file = new Files();

	$file->uploadFile($_FILES['file']);
 
}


?>