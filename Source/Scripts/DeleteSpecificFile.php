<?php

include $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Classes/Files.php";

if (isset($_POST['fileToDelete']))
{
	$file = new Files();
	$file->deleteFiles($_POST['fileToDelete']);
}
else
{
	echo die(json_encode(array("error" => "datos vacios!")));
}

?>