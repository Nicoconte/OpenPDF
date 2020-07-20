<?php
require $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/vendor/autoload.php";

class PDF
{	

	/*
	* @param array
	*/
	public function mergePDF($pdfToMerge)
	{	

		try {

			$merger = new \Clegginabox\PDFMerger\PDFMerger;

			foreach($pdfToMerge as $pdf)
			{	

				//We filter the pdf in some way when we tell to the program where he have to get the files
				$merger->addPDF($_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Uploads/pdf/" . $pdf, "all");
			}

			$merger->merge("browser", "default.pdf", "P");

		} catch (Exception $e) {
			die("No se pudo unir los archivos!");
		}
	}
}

?>