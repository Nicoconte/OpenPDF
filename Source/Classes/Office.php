<?php

include $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Classes/Files.php";
require $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class Office extends Files
{
	private $_template = null;
	private $_targetDir = null;

	public function __construct()
	{
		$this->_targetDir = $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Uploads";
	}

	/**
	*	@param var string
	*/
	public function convertExcelToPDF($spreadsheetToConvert)
	{

		$spreadsheetName = explode(".", $spreadsheetToConvert);
		$spreadsheetAsPDF = current($spreadsheetName) . ".pdf";

		//Get the file
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($this->_targetDir . "/excel/" . $spreadsheetToConvert);
		//Set false to get style of the spreasheet
		$reader->setReadDataOnly(false);
		//Finally we load the entire content
		$spreadsheet = $reader->load($this->_targetDir . "/excel/" . $spreadsheetToConvert);

		//By default we use MPDF as render
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');
		//Get all sheets
		$writer->writeAllSheets();

		//Save the file
		$writer->save($this->_targetDir . "/pdf/" .$spreadsheetAsPDF);
			
		$this->deleteFiles([$spreadsheetToConvert, $spreadsheetAsPDF]);		
	}

	/**
	* Get word content and put it into html file
	* @param var string => word file
	* @return string => html file
	*/
	public function getWordContent($wordToConvert) : string
	{	
		//Get resource
		$wordName = basename($wordToConvert);
		$sourceToLoad = $this->_targetDir . "/word/" . $wordName;

		//Create load resource and writer
		$wordContent = \PhpOffice\PhpWord\IOFactory::load($sourceToLoad);
		$writer = \PhpOffice\PhpWord\IOFactory::createWriter($wordContent, 'HTML');

		//Get the current name
		$wordInfo = explode(".", $wordName);
		$this->_template = current($wordInfo) . ".html";

		//write and save file
		$writer->save($this->_targetDir . "/word/" . $this->_template);


		$this->deleteFiles([$wordToConvert]);

		return $this->_template;
	}

	/**
	* @param var string => html file
	*/
	public function convertWordToPDF($wordToConvert)
	{
		$template = $this->getWordContent($wordToConvert);
		$pdf = new \Mpdf\Mpdf();

		$pdf->WriteHTML(file_get_contents($this->_targetDir . "/word/" . $template));
		$pdf->Output("", "D");

		$this->deleteFiles([$template]);

	}


}

//$excel = new Office();
//$excel->convertExcelToPDF();

//$word = new Office();
//$word->convertWordToPdf("Ej_de_analitico.xls");

?>

<!-- 
	/* Como leer los archivos de forma mas precisa
	public function wordToHTML() : string
	{	
		//Get resource
		$wordName = basename("Lorem Ipsum.docx");
		$sourceToLoad = $this->_targetDir . $wordName;

		//Create load resource and writer
		$wordContent = \PhpOffice\PhpWord\IOFactory::load($sourceToLoad);
		$writer = \PhpOffice\PhpWord\IOFactory::createWriter($wordContent, 'HTML');

		//Get the current name
		$wordInfo = explode(".", $wordName);
		$this->_template = current($wordInfo) . ".html";

		//write and save file
		$writer->save($this->_targetDir . $this->_template);

		return $this->_template;
	}


	public function convertWordToPdf()
	{
		$template = $this->wordToHTML();
		$pdf = new \Mpdf\Mpdf();

		$pdf->WriteHTML(file_get_contents($this->_targetDir . $template));
		$pdf->Output();

	}*/

 -->