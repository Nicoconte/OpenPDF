//contain the files to validate the extension by action
const selectedFiles = [];

//This var will contain the files after upload
const uploadedFiles = [];

//Set configuration
const configuration = [];

/*
* @param var str
*/
function resetFileInput(documentID)
{
	document.getElementById(documentID).value = "";
}

function clearFilesArray() 
{	
	selectedFiles.length = 0;
	uploadedFiles.length = 0;
}

/*
* @return var blob
*/
function getBlobFiles(id)
{

	let filesAmount = document.getElementById(id).files.length;

	if (filesAmount === 0)
	{
		alert("Debe seleccionar un archivo!");
		return;
	}

	var formData = new FormData();
	
	for (let i = 0; i < filesAmount; i++)
	{		
		selectedFiles.push(document.getElementById(id).files[i]);
		formData.append("file[]", document.getElementById(id).files[i]);
	}	

	return formData;
}


/*
* @param var blob, var str, 
*/

function uploadFilesToServer(files, documentID)
{

	let correctFilesAmount = 0;
	let notAllowedFiles = "";

	$.ajax({
		type : "POST",
		dataType : "JSON",
		url : "Source/Scripts/UploadFiles.php",
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
					uploadedFiles.push(res.name);
				}
				else
				{
					notAllowedFiles += " " + "\n" + res.name;
				}
			});

			if (response.length === correctFilesAmount)
			{	
				alert("Los archivos se subieron correctamente");
				resetFileInput(documentID);	
				showFilesOnTable(uploadedFiles);	
			}
			else
			{
				alert("Error al subir el archivo " + notAllowedFiles);
				resetFileInput(documentID);
			}
		}
	});

}

/*
* Get an action and base itself, it'll return the extension to validate in another function
* @param var str
*/
function getExtensionByAction(action)
{
	var extensionToValidate = "";

	switch(action)
	{
		case "merge-files":
			extensionToValidate = ["pdf"];
			break;
		case "modify-pdf":
			extensionToValidate = ["pdf"];
			break;
		case "word-to-pdf":
			extensionToValidate = ["doc", "docx"];
			break;
		case "excel-to-pdf":
			extensionToValidate = ["xls", "xlsx"];
			break;
		case "img-to-pdf":
			extensionToValidate = ["png", "jpeg", "jpg"];
			break;
		default:
			break;
	}	

	return extensionToValidate;
}


/*
* @param var array, var array
* @return bool
*/
//Merge funciona | word funciona | img funciona
function validateExtension(files, extensions)
{	

	var areValid = true;

	if (files.length > 0)
	{
		files.forEach(file => {
			fileExt = file.name.split(".");
			if (extensions.indexOf(fileExt[1]) === -1)
			{
				areValid = false;
				//console.log("Extension to validate " + extensions +  " | " + "File => " + file.name + " | Extension " + fileExt[1] + " | isValid => " + areValid);
			} 
		})		
	}

	return areValid;
}

function mergeFiles()
{
	$("#merge-btn").click(function(e) {
		e.preventDefault();

		let fileInfo = {"filesToMerge" : uploadedFiles}

		if (uploadedFiles.length <= 1)
		{
			alert("Deben ser 2 archivos como minimo");
			return;
		}
		else
		{	
			downloadFile("Source/Scripts/MergeFiles.php", fileInfo, "PDMergedByOpenPDF.pdf");

		}
		//Clear array after download
		clearFilesArray();
		showFilesOnTable(uploadedFiles);

	});
}


/*
* Lib "jquery-ajax-native" https://github.com/acigna/jquery-ajax-native
* @param str, object, str
*/

function downloadFile(url, data, name)
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


/*
* @param var array
*/
function showFilesOnTable(files)
{
	let template = ""
	let amountOfFilesOnScreen = 0;
	let id = 0;

	files.forEach(file => {
		template += 
		`<tr data-file-name=${file}> 
			<td> ${id++} </td>
			<td class='small'>
				${file}
			</td>
			<td>
				<button class='btn btn-sm btn-dark text-white'><i class='fa fa-pencil'></i></button>
				<button class='delete-file btn btn-sm btn-danger text-white mt-1'><i class='fa fa-trash'></i></button>
			</td>
		</tr>`
		amountOfFilesOnScreen++;
	});

	$("#file-display").html((amountOfFilesOnScreen <= 0) ? "<tr> <td> <h4> No hay archivos </h4> </td> </tr>" : template);
}

function deleteFileFromPreview()
{
	$(document).on("click", ".delete-file", function() {

								//button  =>    td    =>   tr
		let elementFromTable = $(this)[0].parentElement.parentElement;
		let fileToDelete = $(elementFromTable).attr("data-file-name");

		deleteFileFromServer([fileToDelete]);

		uploadedFiles.forEach(file => {
			if(file === fileToDelete)
			{
				index = uploadedFiles.indexOf(file);
					
				if (index > -1)
				{
					uploadedFiles.splice(index, 1);
				}	
			}
		})

		showFilesOnTable(uploadedFiles);

	})
}

/*
* @param var array
*/
function deleteFileFromServer(file)
{
	$.post("Source/Scripts/DeleteSpecificFile.php", {"fileToDelete" : file});
}

function setConfigurationOnMerger(config)
{
	$("#save-config-merger").click(function() {

	});
}

function main()
{
	$(document).on("click", "#test-btn", function(e) {
		e.preventDefault();

		let element = $(this)[0].parentElement;
		let action = $(element).attr("data-action");	

		//Get data number form attr and concat with file- to use it as ID for 
		let documentID = "file-" + $(element).attr("data-form-number");

		//We must get the files before doing a verification over them 
		blobFiles = getBlobFiles(documentID);	

		if(validateExtension( selectedFiles , getExtensionByAction(action) ))
		{
			uploadFilesToServer( blobFiles, documentID );
		}
		else
		{
			alert("Los archivos subidos no corresponden a la accion!");
			resetFileInput(documentID);
			clearFilesArray();
		}

	});
}


function test(files)
{
	//$(document).on("click", "#test-btn", function() {
		//validateExtension(getFiles(), getExtensionByAction("merge-files"));
		//let element = $(this)[0].parentElement;
		//alert($(element).attr("data-action"));
	//});

	files.forEach(file => {
		console.log(file);
	})
}

function ready()
{
	main();
	clearFilesArray();
	mergeFiles();
	deleteFileFromPreview();
	showFilesOnTable(uploadedFiles);
	//test();
}



$(document).ready(ready);