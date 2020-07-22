<?php

class Files 
{

	private $_fileName;

	private $_extension;
	private $_allowedEntensions;

	private $_target;
	private $_finalDir;
	private $_rootDir;

	private $_response = array();

	public function __construct()
	{	
		$this->_allowedEntensions = array("pdf", "xls", "docx", "doc", "jpg", "jpeg", "png", "xlsx");
		$this->_rootDir = $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Uploads/";
	}

	/*
	*
	*We´ll use this method to check the extension of the file in a global way. 
	*For an specific validation, we should use/create the class Validators
	*
	* @param var str
	* @return var bool 
	*/
	private function validateExtension($extension) : bool 
	{

		$isValid = false;

		if (in_array($extension, $this->_allowedEntensions))
		{
			$isValid = true;
		}

		return $isValid;

	}

	/*
	*@param var $_FILES['file']
	*/
	public function uploadFile($files) 
	{
		if($files['error'] < 0)
		{
			echo die(json_encode(array("error" => "Error inesperado!")));
		}

		//Get the amount of files we uploaded by name
		$filesAmount = count($files['name']);

		for($i = 0; $i < $filesAmount; $i++)
		{

			//Convert the current string into array by dot. Example: 'hello_word.pdf' => ["helloword", "pdf"]
			$currentFileInfo = explode(".", $files['name'][$i]);

			$this->_extension = end($currentFileInfo);
			$this->_fileName = str_replace(" ", "_", basename($files['name'][$i]));

			if($this->validateExtension($this->_extension)) 
			{	

				//Assemble the path to drop the files
				$this->_target = $this->_rootDir . $this->getFolder($this->_extension) . $this->_fileName;

				//If the file exist in that target, we break the loop and go on with the anothers
				if(file_exists($this->_target)) break;

				if(move_uploaded_file($files['tmp_name'][$i], $this->_target))
				{
					$this->_response[] = array("success" => true, "name" => $this->_fileName); 
				}

			}
			else
			{
				$this->_response[] = array("success" => false, "name" => $this->_fileName);				
			}

		}


		echo json_encode($this->_response);

	}

	/*
	*
	*Depend the extension of the file, it will be in different folder. Left it to the end
	*
	* @param var str
	* return (str)
	*/
	private function getFolder($extension) : string
	{

		switch ($extension) {
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

	/*
	*  @param var array
	*/
	public function deleteFiles($filesToDelete)
	{	

		foreach($filesToDelete as $file)
		{	
			$fileInfo = explode(".", $file);
			unlink($_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Uploads/" . $this->getFolder(end($fileInfo)) . str_replace(" ", "_", $file));
		}

	}
}

?>