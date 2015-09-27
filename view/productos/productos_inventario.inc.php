<?php 
	 $data=$_GET['data'];
	 $op=$_GET['op'];
	 $prid=(htmlspecialchars($_GET["prid"]));
	 $f=(htmlspecialchars($_GET["f"]));
	 if ($f=="editar")
	 	$title="Caracteristicas [$prid]";
	 		else
	 	$title="Caracteristicas";



	 $checado="checked";
	 $checado_inv="checked";

	 if ($prid>0)
	 {
		$query = "SELECT producto_id,proveedor_id,producto,detalle,talla_id,precio_credito,precio_contado,precio_promocion,precio_compra,descuento,
				subcategoria_id,categoria_id,unidad_id,marca_id,estilo,color_id,codigo,stock,up,activo,consultas,inventariable
			 FROM producto WHERE producto_id=$prid";
		list( $producto_id,$proveedor_id,$producto,$detalle,$talla_id,$precio_credito,$precio_contado,$precio_promocion,$precio_compra,$descuento,
				$subcategoria_id,$categoria_id,$unidad_id,$marca_id,$estilo,$color_id,$codigo,$stock,$up,$activo,$consultas,$inventariable) = $database->get_row( $query );
		if (!$activo) $checado="";


		$queryWhere="";
	 }



	 	

?>

						<p><a href='<?php echo"/index.php?data=$data&op=inventario&prid=$prid"?>' ><button class="btn btn-small btn-primary">Editar Inventario</button></a></p>

			<div class="row-fluid">
				<div class="box  span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span><?=$title?></h2>
						<div class="box-icon">
							
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href='<?php echo "/index.php?data=clientes&op=detalles&cid=$cid"?>' ><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<!-- <form class="form-horizontal" action="/functions/crud_productos.php"> -->
							<!-- <fieldset> -->

							<!-- 	<input type="hidden" name="data" value="<?php echo $_GET['data']?>" >
								<input type="hidden" name="op" value="<?php echo $_GET['op']?>">
								<input type="hidden" name="f" value="<?php echo $_GET['f']?>">
								<?php 
								if ($f=="agregar")
									echo "<input type=\"hidden\" name=\"func\" value=\"c\">";
									else
									echo "<input type=\"hidden\" name=\"func\" value=\"u\">";
								?>
								<input type="hidden" name="cid" value=<?php echo $cid?> >
								 -->



<div class="row-fluid condensed">	


		<div class="box span6">



<div class="control-group">
								<!-- <label class="control-label" for="activo">Activo</label> -->

								 <div class="controls">
								  <label class="checkbox inline">Activo
									<input type="checkbox" id="activo" name="activo"  value="1"  <?php echo $checado?>> 
								  </label>

								  <label class="checkbox inline">Inventariable
									<input type="checkbox" id="inventariable" name="activo"  value="1"  <?php echo $checado_inv?>> 
								  </label>
								 </div>
								</div>



							    <strong><?php echo strtoupper($producto)?></strong><br><br>
								




					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Tallas</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
					
						<table>

							  <?php
								$query = "SELECT talladet_id,talladet FROM talladet WHERE talla_id=$talla_id ORDER BY orden ";
								//list( $colonia_casa ) = $database->get_row( $query );	
								$results = $database->get_results( $query );
								foreach( $results as $row )
								{
									if ($row['talladet_id'])
								 echo " <tr><td><label class=\"control-label\" >".$row['talladet']."</label></td>
								 		<td>
								<div class=\"controls\">
								  <input class=\"input-small\" id=\"apellidopaterno\" name=\"apellidop\" type=\"text\" value=\"$precio_compra\">
								</div>
							  </td></tr> ";
							  	else
							  		echo "<tr><td><br>Es necesario asginar las tallas en la descripcion del producto.<br><br><br><br></td></tr>";


    							}
							  ?>
						</table>	





					</div>
		</div><!--/span-->
			

		<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Color</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
									

<form action='/functions/crud_caracteristicas.php' class="form-horizontal">
	<fieldset>
		<input type=hidden name=data value=<?php echo $data?> >
		<input type=hidden name=op value=<?php echo $op?> >
		<input type=hidden name=prid value=<?php echo $prid?> >
		<input type=hidden name=func value=c>



								 <div class="control-group">
								<label class="control-label" >Crear Color</label>
								<div class="controls">
								  <input class="input-small" id="color" name="color" type="text" value=""> 
								  <input type=submit value=crear>
								</div>
							  </div>
							  	<table>
							  		<tr ><td align=right>Codigo</td><td></td><td>Color</td></tr>
  								<?php
								$query = "SELECT color_id,color,codigo_color FROM color WHERE producto_id=$prid ORDER BY color ";
								//list( $colonia_casa ) = $database->get_row( $query );	
								$results = $database->get_results( $query );
								foreach( $results as $row )
								{
									
									echo "<tr><td><label class=\"control-label\" >".$row['codigo_color']."</label></td>
											  <td>&nbsp;&nbsp;</td><td>".$row['color']."</td></tr>";
								 //echo " <label class=\"control-label\" >".$row['color']." - ".$row['codigo']."</label>";


    							}
							  ?>
							</table>
</fieldset>
</form>

					</div>
		</div><!--/span-->

		<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Imagenes</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						
						No hay imagenes por el momento

					</div>
		</div><!--/span-->
			
</div><!--/row-->








































						
							



						


							  


							  <div class="form-actions">
								<button type="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
							<!-- </fieldset> -->
						  <!-- </form> -->
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
