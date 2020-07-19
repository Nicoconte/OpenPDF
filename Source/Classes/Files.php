<?php

class Files 
{

	private $_fileName;

	private $_allowedEntensions;

	private $_target;
	private $_finalDir;
	private $_rootDir;


	public function __construct($name, $extension)
	{	

		$this->_fileName = basename($name);

		$this->_extension = $extension;
		$this->_allowedEntensions = array("pdf", "xls", "docx", "doc", "jpg", "jpeg", "png", "xlsx");

		$this->_rootDir = $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Uploads/";
		$this->_target = $this->_rootDir . $this->getFinalDir() . $this->_fileName;
	}

	private function validateExtension() : bool 
	{

		$isValid = false;

		if (in_array($this->_extension, $this->_allowedEntensions))
		{
			$isValid = true;
		}

		return $isValid;

	}

	/* We'll see if this method is useful in a future. Maybe we could try to get the files to delete with this
	private function getSelectedFiles($file) : string
	{
		return explode(".", $file['name']);
	}*/


	public function uploadFile($file) 
	{
		if($file['error'] > 0)
		{
			echo die(json_encode(array("error" => "Error detectado!")));
		} 

		if(!$this->validateExtension()) 
		{
			echo die(json_encode(array("error" => "Extension invalida")));
		}

		if(move_uploaded_file($file['tmp_name'], $this->_target))
		{
			echo json_encode(array("success" => true));
		}

	}

	//Depend the extension of the file, it will be in different folder. Left it to the end
	private function getFinalDir() : string
	{

		switch ($this->_extension) {
			case 'docx':
				$this->_finalDir = "word/";
				break;
			
			case "doc":
				$this->_finalDir = "word/";
				break;

			case 'pdf':
				$this->_finalDir = "pdf/";
				break;
			
			case 'xls':
				$this->_finalDir = "excel/";
				break;

			case "xlsx":
				$this->_finalDir = "excel/";
				break;

			case 'jpg':	 
				$this->_finalDir = 'image/';
				break;

			case "jpeg":
				$this->_finalDir = "image/";
				break;

			case 'png':	 
				$this->_finalDir = 'image/';
				break;	

			default:
				break;
		}

		return $this->_finalDir;
	}

}

?>