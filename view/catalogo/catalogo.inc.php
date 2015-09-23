

<?php
require_once 'catalogo.src.php';


?>

<?php 
if ($_GET['eed']==2)
	 			echo	"<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Registro Agregado!</strong> El Registro $cid esta listo para usarse.
						</div>";
?>						


<div class="box span12">
				<div class="box-header">
					<h2><i class="halflings-icon th"></i><span class="break">Catalogo</span></h2>
					<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
				</div>
			
				<div class="box-content"><br>
						
						<form class="form-horizontal" action="/functions/crud_proveedores.php">
							<fieldset>

								<input type="hidden" name="data" value="<?php echo $_GET['data']?>" >
								<input type="hidden" name="op" value="<?php echo $_GET['op']?>">
								<input type="hidden" name="f" value="<?php echo $_GET['f']?>">
								<input type="hidden" name="pid" value="<?php echo $pid?>" >
								
								<div class="control-group ">
								
								<label class="control-label" for="categoria">Categoria</label>
								<div class="controls">
								  <input class="input-large" id="categoria" name="categoria" type="text" value="<?php echo strtoupper($rfc)?>"> 
								<button type="submit" class="btn btn-primary">Agregar Categoria</button>
								</div>
							  </div>
							

							</fieldset>
						</form>

					</div>

</div><!--/span-->




			<div class="row-fluid condensed">	

				<div class="box span4">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Categorias</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-condensed">
							  <thead>
								  <tr>
									  <th>Categoria</th>
									  <th>Subcategoria</th>
									  <th>Productos</th>
									                                            
								  </tr>
							  </thead>   
							  <tbody>


							  	<?php catalogo();?>

							      

  				</tbody>
						 </table>  
						     
					</div>
				</div><!--/span-->
			

				<div class="box span8">
					
				
				  		 <?php

							  	if ($_GET['subcat'])
							  		productos($_GET['subcat']); 
							  	if ($_GET['cat'])
							  		subcategorias($_GET['cat']);
									 ?>

				</div><!--/span-->
			
			</div><!--/row-->