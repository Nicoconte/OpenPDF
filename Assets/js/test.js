const selectedFiles = [];

function resetFileInput()
{
	document.getElementById("file").value = "";
}

function uploadTest()
{
	$(document).on("click", "#test-btn", function(e) {

		e.preventDefault();

		let filesAmount = document.getElementById("file").files.length;
		var formData = new FormData();
		
		let correctFilesAmount = 0;

		for (let i = 0; i < filesAmount; i++)
		{	
			formData.append("file[]", document.getElementById("file").files[i]);
		}

		$.ajax({
			type : "POST",
			dataType : "JSON",
			url : "Source/Scripts/UploadTest.php",
			cache : false,
			contentType : false,
			processData : false,			
			data : formData,
			success : function(response)
			{	
				response.forEach(res => {
					if (res.success === true)
					{
						correctFilesAmount++;
						selectedFiles.push(res.name);
					}
				});

				if (response.length === correctFilesAmount)
				{	
					alert("Los archivos se subieron correctamente");
					resetFileInput();
				}
				else
				{
					alert("Error al subir el archivo " + response.name);
					resetFileInput();
				}
			}
		});
	});
}

function mergeFiles()
{
	$("#merge-btn").click(function(e) {
		e.preventDefault();

		let fileInfo = {"filesToMerge" : selectedFiles}
		downloadFileWithAjax("Source/Scripts/MergeTest.php", fileInfo, "PDfMergedByOpenPDF.pdf")
		
		//Clear array
		selectedFiles.length = 0;
	})
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
		success : function(blob) {
			var link = document.createElement("a");
			link.href=window.URL.createObjectURL(blob);
			link.download=name;
			link.click();
		}
	});	
}


function ready()
{
	uploadTest();
	resetFileInput();
	mergeFiles();
}



$(document).ready(ready);