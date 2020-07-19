function uploadTest()
{
	$(document).on("click", "#test-btn", function(e) {

		e.preventDefault();

		let file = document.getElementById("file").files[0];
		formData = new FormData();
		formData.append("file", file);

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