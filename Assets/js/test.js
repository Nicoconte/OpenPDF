//This var will contain the files after upload
const selectedFiles = [];

//contain the files to validate the extension by action
const uploadedFiles = [];

function resetFileInput()
{
	document.getElementById("file").value = "";
}

function clearFilesArray() 
{
	selectedFiles.length = 0;
}

/*
* @return var blob
*/
function getFiles()
{
	let filesAmount = document.getElementById("file").files.length;

	if (filesAmount === 0)
	{
		alert("Debe seleccionar un archivo!");
		return;
	}

	var formData = new FormData();
	
	for (let i = 0; i < filesAmount; i++)
	{	
		uploadedFiles.push(document.getElementById("file").files[i]);
		formData.append("file[]", document.getElementById("file").files[i]);
	}	

	return formData;
}

function test()
{
	$("#test-btn-2").click(function() {
		getFiles();
		uploadedFiles.forEach(file => {
			console.log(file.name);
		})
	})
}

/*
* @param var blob
*/

function uploadFileWithAjax(files)
{

	let correctFilesAmount = 0;
	let notAllowedFiles = "";

	$.ajax({
		type : "POST",
		dataType : "JSON",
		url : "Source/Scripts/UploadTest.php",
		cache : false,
		contentType : false,
		processData : false,			
		data : files,
		success : function(response)
		{	
			response.forEach(res => {
				if (res.success === true)
				{
					correctFilesAmount++;
					selectedFiles.push(res.name);
				}
				else
				{
					notAllowedFiles += " " + "\n" + res.name;
				}
			});

			if (response.length === correctFilesAmount)
			{	
				alert("Los archivos se subieron correctamente");
				resetFileInput();
			}
			else
			{
				alert("Error al subir el archivo " + notAllowedFiles);
				resetFileInput();
			}
		}
	});

}


function uploadFileToServer()
{
	$(document).on("click", "#test-btn", function(e) {
		e.preventDefault();

		uploadFileWithAjax( getFiles() );

	});
}

/*
* @param var array, var str 
* @return bool
*/
function validateExtensionByAction(files, extension)
{
	//...........
}

function mergeFiles()
{
	$("#merge-btn").click(function(e) {
		e.preventDefault();

		let fileInfo = {"filesToMerge" : selectedFiles}

		console.log(fileInfo);

		if (selectedFiles.length <= 1)
		{
			alert("Deben ser 2 archivos como minimo");
			return;
		}
		else
		{
			downloadFileWithAjax("Source/Scripts/MergeTest.php", fileInfo, "PDfMergedByOpenPDF.pdf")
		}
		//Clear array after download
		clearFilesArray();
	});
}


/*
* Lib "jquery-ajax-native" https://github.com/acigna/jquery-ajax-native
* @param str, object, str
*/

function downloadFileWithAjax(url, data, name)
{
	$.ajax({
		type : "POST",
		dataType : "native",
		url : url,
		data : data,
		xhrFields : {
			responseType : "blob"
		},
		success : function(response) {

			var link = document.createElement("a");
			link.href=window.URL.createObjectURL(response);
			link.download=name;
			link.click();

		}
	});	
}


function ready()
{
	uploadFileToServer();
	resetFileInput();
	clearFilesArray();
	mergeFiles();
	test();
}



$(document).ready(ready);