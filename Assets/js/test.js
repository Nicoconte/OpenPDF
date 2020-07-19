function uploadTest()
{
	$(document).on("click", "#test-btn", function(e) {

		e.preventDefault();

		let filesAmount = document.getElementById("file").files.length;
		var formData = new FormData();
		
		for (let i = 0; i < filesAmount; i++)
		{	
			console.log(document.getElementById("file").files[i]);
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
				if(response.success)
				{
					alert("El archivo se subio!");
				}	
				else
				{
					alert(response.error);
				}
			}
		});
	});
}

function ready()
{
	uploadTest();
}



$(document).ready(ready);