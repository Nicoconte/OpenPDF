<?php

include $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Classes/Files.php";

require $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/vendor/autoload.php";

class PDF extends Files
{	

	/*
	* @param array
	*/
	public function mergePDF($pdfToMerge)
	{	
		try {
			$merger = new \Clegginabox\PDFMerger\PDFMerger;

			for($i=0; $i < count($pdfToMerge); $i++)
			{	

				//We filter the pdf in some way when we tell to the program where he have to get the files
				$merger->addPDF($_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Uploads/pdf/" . $pdfToMerge[$i]);
			}

			$merger->merge("browser", "default.pdf", "A");

			//We must delete everything!
			$this->deleteFiles($pdfToMerge);	

		} catch (Exception $e) {

			//we should all the uploaded files anyway!
			$this->deleteFiles($pdfToMerge);
			die("Los archivos deben ser PDF para poder unirlos. Vuelva a la aplicacion y suba PDF " . $e->getMessage());
		}
	}


	public function createTemplateByPDF($pdfFiles)
	{
		$render = new \Mpdf\Mpdf();
		$render->SetImportUse();

		$newPDF = null;

		foreach ($pdfFiles as $pdf) 
		{
			
		}
	}
}

?>