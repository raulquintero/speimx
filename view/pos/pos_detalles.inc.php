

<?php
include 'pos_detalles.scr.php';

if (!$producto_id)
{
	echo "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Producto no Encontrado.
						</div>";
	echo "<a href=\"/index.php\" class=\"btn btn-info blue \">Regresar</a>";
}
else
{
?>

<?php 
if ($_GET['eed']==2)
	 			echo	"<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Registro Agregado!</strong> El Registro $cid esta listo para usarse.
						</div>";
?>						




			<form action=/functions/cart.php>
				<input type=hidden name="func" value="add_item">
				<input type=hidden name="prid" value="<?php echo $producto_id?>">
				<input type=hidden name="producto" value="<?php echo $producto?>">
				<input type=hidden name="marca" value="<?php echo $marca?>">
				<input type=hidden name="codigo" value="<?php echo $codigo?>">

				<input type=hidden name="precio_credito" value="<?php echo $precio_credito?>">
				<input type=hidden name="precio_contado" value="<?php echo $precio_contado?>">



			 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Agregar al Carrito</button>
								<a href="/index.php?data=pos" class="btn" data-dismiss="modal">Cancelar</a>

								<!-- <a href=/><button class="btn">Cancelar</button></a> -->
							  </div>
<br><br>
			<div class="row-fluid condensed">	

				<div class="box span6">

					<div class="box-content">


											<b><?php echo $producto?> </b> &nbsp;&nbsp;											
											<br>Marca: <?php echo $marca?>
											<br>Subcategoria: <?php echo $subcategoria?>
											<br>Id:<?php echo $producto_id?>	<br><br>
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Seleccione Color</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
													
						<br>





						 <div class="control-group">
								<label class="control-label">Colores Disponibles</label>
								<div class="controls">

						<?php
								$query = "SELECT color_id,color FROM  color WHERE producto_id=$producto_id ORDER BY  color";
								//list( $colonia_casa ) = $database->get_row( $query );	
								$results = $database->get_results( $query );
								
								 if(!$results)
								 	{	echo "<label class=\"btn btn-info\"  style=\"border:1px solid #336699;color:black\" >
									<input type=\"radio\" name=\"color\" id=\"color\" value=\"0\" checked=\"\"> SIN COLOR ASIGNADO</label>";
									}
									
								foreach( $results as $row )
								{

									echo "<label class=\"btn btn-info\"  style=\"border:1px solid #336699;color:black\" >
									<input type=\"radio\" name=\"color\" id=\"color\" value=\"".$row['color']."\" checked=\"\">
									".strtoupper($row['color'])."
								  </label>
								  <!--div style=\"clear:both\"></div-->";

									// if ($row[$campo_id]==$var)  $seleccionado="selected='true' "; else $seleccionado="";
    					// 			echo "<option $seleccionado value='".$row[$campo_id]."' >".ucfirst($row[$campo])."</option>";
    							}

						?>
								</div>
							  </div> 


							  <!-- ************************************************************************ -->



							  		 <div class="control-group">
								<label class="control-label">Tallas Disponibles</label>
								<div class="controls">

						<?php
								$query = "SELECT talladet_id,talladet FROM talladet WHERE talla_id=$talla_id ORDER BY orden";
								//list( $colonia_casa ) = $database->get_row( $query );	
								$results = $database->get_results( $query );

								foreach( $results as $row )
								{

									echo "<label class=\"btn btn-warning\"  style=\"border:1px solid orange;color:black\" >
									<input type=\"radio\" name=\"talla\" id=\"talla\" value=\"".$row['talladet']."\" checked=\"\">
									".strtoupper($row['talladet'])."
								  </label>
								  <!--div style=\"clear:both\"></div-->";

									// if ($row[$campo_id]==$var)  $seleccionado="selected='true' "; else $seleccionado="";
    					// 			echo "<option $seleccionado value='".$row[$campo_id]."' >".ucfirst($row[$campo])."</option>";
    							}

						?>
								</div>
							  </div>


					</div>
				</div><!--/span-->
			
			<!-- **************************** siguiente columna ********************************* -->

				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Imagenes</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>



					<div class="box-content">


							  	
									SIn Imagenes por el momento


     
					</div>
				</div><!--/span-->

	</form>			
			</div><!--/row-->


<?php



}   // fin del if si no se encontro propducto


?>