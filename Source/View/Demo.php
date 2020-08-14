<div class="demo-container w-100" style='height:654px;'>
	
	<div class="demo-header text-white w-100 h-25 bg-danger d-flex flex-column justify-content-center align-items-center">
		<h1><i class='fa fa-file-pdf-o'></i> OpenPDF Demo</h1>
		<p class='mt-2'>Your 100% free solution!</p>
	</div>
	<div class="demo-information w-100  d-flex flex-row justify-content-center align-items-center" style='height:65%'>
		
		<div class="demo-card card text-white bg-secondary w-25 h-75 mr-5" style=''>
			<div class='card-body d-flex flex-column justify-content-center align-items-center'>
				<h1><i class='fa fa-file-pdf-o'></i></h1>
				<p>Combina los PDF que tu quieras!</p>
				<button class='btn btn-danger text-white mt-1' data-toggle='modal' data-target="#merge-modal">Quiero combinar PDF</button>
			</div>
		</div>

		<div class="demo-card card text-white bg-secondary w-25 h-75" style=''>
			<div class='card-body d-flex flex-column justify-content-center align-items-center'>
				<h1><i class='fa fa-file-word-o'></i></h1>
				<p>Convierte tus documentos Word a PDF</p>
				<button class='btn btn-primary text-white mt-1' data-toggle='modal' data-target="#word-modal">Quiero convertir mis documentos!</button>				
			</div>
		</div>

		<div class="demo-card card text-white bg-secondary w-25 h-75 ml-5" style=''>
			<div class='card-body d-flex flex-column justify-content-center align-items-center'>
				<h1><i class='fa fa-file-excel-o'></i></h1>
				<p>Convierte tus planillas Excel a PDF</p>
				<button class='btn btn-success text-white mt-1' data-toggle='modal' data-target="#excel-modal">Quiero convertir mis planillas!</button>				
			</div>
		</div>				

			
	</div>
	
	<div class="demo-contact w-100 bg-danger d-flex align-items-center justify-content-start text-white" style='height:10%'>
		<p class='ml-3 mt-4'>Fork me on Github! <a href="http://www.github.com/NicoConte" target="_blank" class='text-white'><i class='fa fa-github'></i></a></p>
	</div>

</div>


  <!-- The Modal -->
<div class="modal fade" id="merge-modal">
  <div class="modal-dialog  modal-xl">
    <div class="modal-content">
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-danger">Combinar PDF!</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        
      <!-- Modal body -->
      <div class="modal-body">
		<form data-form-number='1' data-action='merge-files' method="POST" enctype="multipart/form-data">
			<input class='ml-4' type="file" name='file[]' multiple id='file-1'>
			<button id='test-btn' class='btn ml-2 btn-primary text-white'>Subir PDF!</button>
		</form>	
		<button id='merge-btn' class='btn bg-danger mt-1 ml-4 text-white'>Combinar PDF</button>
        <table class='table mt-2'>
        	<thead>
        		<tr>
        			<td>ID</td>
        			<td>Archivos</td>
        			<td>Accion</td>
        		</tr>
        	</thead>
        	<tbody class='file-display'>
        		
        	</tbody>
        </table>
      </div>
        
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        
    </div>
  </div> 
</div>

  <!-- The Modal -->
<div class="modal fade" id="word-modal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Convierta sus documentos Word</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        
      <!-- Modal body -->
      <div class="modal-body">
		<form data-form-number='3' data-action='word-to-pdf' method="POST" enctype="multipart/form-data" >
			<input class='ml-4' type="file" name='file[]' multiple id='file-3'>
			<button id='test-btn' class='btn ml-2 btn-primary text-white'>Subir archivos!</button>
		</form>			
		<button id="word-btn" class='btn bg-info mt-1 ml-4 text-white'>Word a PDF</button>
        <table class='table mt-2'>
        	<thead>
        		<tr>
        			<td>ID</td>
        			<td>Archivos</td>
        			<td>Accion</td>
        		</tr>
        	</thead>
        	<tbody class='file-display'>
        		
        	</tbody>
        </table>		
      </div>
        
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        
    </div>
  </div> 
</div>

  <!-- The Modal -->
<div class="modal fade" id="excel-modal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Convierta sus planillas Excel!</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        
      <!-- Modal body -->
      <div class="modal-body">
 		<form data-form-number='4' data-action='excel-to-pdf' method="POST" enctype="multipart/form-data">
			<input class='ml-4' type="file" name='file[]' multiple id='file-4'>
			<button id='test-btn' class='btn ml-2 btn-primary text-white'>Subir archivos!</button>
		</form>			
		<button id="excel-btn" class='btn bg-success ml-4 text-white'>Excel a PDF</button>     	
       <table class='table mt-2'>
        	<thead>
        		<tr>
        			<td>ID</td>
        			<td>Archivos</td>
        			<td>Accion</td>
        		</tr>
        	</thead>
        	<tbody class='file-display'>
        		
        	</tbody>
        </table>
      </div>
        
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        
    </div>
  </div> 
</div>