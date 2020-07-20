<?php

require $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/vendor/autoload.php";

class PDF
{
	public function mergePDF($pdfToMerge)
	{

		try {
			$merger = new \Clegginabox\PDFMerger\PDFMerger;

			foreach($pdfToMerge as $pdf)
			{
				$merger->addPDF($_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Uploads/pdf/" . $pdf, "all");
			}

			$merger->merge("browser", "default.pdf", "P");

		} catch (Exception $e) {
			json_encode(array("error" => "No se pudo unir los archivos!"));
		}
	}
}

?>