<div class="test-container w-100" style="height:780px;">
	<div class='w-100 d-flex justify-content-center align-items-center bg-primary text-white' style='height:20%'>
		<h1>OpenPDF playground</h1>
	</div>
	<div class="test-field w-100 h-100 d-flex flex-row">
		<div class="test-action w-50 d-flex flex-column justify-content-center align-items-center" style='height:80%'>
			
			<form data-form-number='1' data-action='merge-files' method="POST" enctype="multipart/form-data">
				<input class='ml-4 mt-4' type="file" name='file[]' multiple id='file-1'>
				<button id='test-btn' class='btn ml-2 btn-primary text-white'>Subir archivos!</button>
			</form>			
			<button id='merge-btn' class='btn bg-danger ml-2 mt-3 text-white'>Combinar PDF</button>
			
			<form data-form-number='2' data-action='modify-pdf' method="POST" enctype="multipart/form-data" class='mt-3'>
				<input class='ml-4 mt-4' type="file" name='file[]' multiple id='file-2'>
				<button id='test-btn' class='btn ml-2 btn-primary text-white'>Subir archivos!</button>
			</form>			
			<button class='btn bg-danger mt-3 ml-2 text-white'>Modificar PDF</button>
			
			<form data-form-number='3' data-action='word-to-pdf' method="POST" enctype="multipart/form-data" class='mt-3'>
				<input class='ml-4 mt-4' type="file" name='file[]' multiple id='file-3'>
				<button id='test-btn' class='btn ml-2 btn-primary text-white'>Subir archivos!</button>
			</form>			
			<button id="word-btn" class='btn bg-info mt-3 ml-2 text-white'>Word a PDF</button>
			
			<form data-form-number='4' data-action='excel-to-pdf' method="POST" enctype="multipart/form-data" class='mt-3'>
				<input class='ml-4 mt-4' type="file" name='file[]' multiple id='file-4'>
				<button id='test-btn' class='btn ml-2 btn-primary text-white'>Subir archivos!</button>
			</form>			
			<button id="excel-btn" class='btn bg-success mt-3 ml-2 text-white'>Excel a PDF</button>
			
			<form data-form-number='5' data-action='img-to-pdf' method="POST" enctype="multipart/form-data" class='mt-3'>
				<input class='ml-4 mt-4' type="file" name='file[]' multiple id='file-5'>
				<button id='test-btn' class='btn ml-2 btn-primary text-white'>Subir archivos!</button>
			</form>															
			<button id="img-btn" class='btn bg-warning mt-3 ml-2 text-white'>Img a PDF</button>

		</div>
		<div class="test-display w-50 h-100 d-flex justify-content-center">
			<table class='table table-striped'>
				<thead class='thead-dark'>
					<tr>
						<td>Archivo</td>
						<td>Acciones</td>
					</tr>
				</thead>
				<tbody id='file-display'></tbody>
			</table>
		</div>
	</div>
</div>

<!-- 
	<div class="test-field w-100 h-50 d-flex flex-column justify-content-center align-items-center">
		<form method="POST" action=""  enctype="multipart/form-data" class='w-100 h-10 d-flex flex-row justify-content-center align-items-center'>
			<blockquote>
				<input class='ml-4 mt-4' type="file" name='file[]' multiple id='file'>
				<button id='test-btn' class='btn bg-info ml-2 text-white'>Subir archivo!</button>
			</blockquote>
		</form>
		<div class="mt-4 button-to-action">
			<button class='btn bg-danger text-white ml-2' id="merge-btn">Unir PDF</button>
			<button class='btn bg-danger text-white ml-2'>Modificar PDF</button>
			<button class='btn bg-info text-white ml-2'>Convertir Word a PDF</button>
			<button class='btn bg-success text-white ml-2'>Convertir Excel a PDF</button>
			<button class='btn bg-warning text-white ml-2' id="test-btn-2">Test</button>
		</div>
	</div>
 -->