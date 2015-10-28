<?php 
	 $data=$_GET['data'];
	 $prid=(htmlspecialchars($_GET["prid"]));
	 $f=(htmlspecialchars($_GET["f"]));
	 
	 if ($f=="editar")
	 	$title="Editar Producto [$prid]";
	 		else
	 	$title="Agregar Producto";



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
		if (!$inventariable) $checado_inv="";

		$precio_compra=dinero($precio_compra*1.16);
		$precio_contado=dinero($precio_contado*1.16);
		$precio_credito=dinero($precio_credito*1.16);


		$queryWhere="";
	 }else
	 {
	 	$proveedor_id=$_GET['pid'];
	 	echo $subcategoria_id=$_GET['subcat'];
	 }



	 		if ($f=="editar")
			echo "<p><a href=\"/index.php?data=$data&op=inventario&prid=$prid\" ><button class=\"btn btn-small btn-primary\">Editar Inventario</button></a></p>"

?>
					<?php echo error($_GET['eed']);	?>	
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
						<form class="form-horizontal" action="/functions/crud_productos.php">
							<fieldset>

								<input type="hidden" name="data" value="<?php echo $_GET['data']?>" >
								<input type="hidden" name="op" value="<?php echo $_GET['op']?>">
								<input type="hidden" name="f" value="<?php echo $_GET['f']?>">
								<?php 
								if ($f=="agregar")
									echo "<input type=\"hidden\" name=\"func\" value=\"c\">";
									else
									echo "<input type=\"hidden\" name=\"func\" value=\"u\">";
								?>
								<input type="hidden" name="prid" value=<?php echo $prid?> >
								



								<div class="row-fluid condensed">	
									<div class="box span6">
								<div class="control-group">
								<!-- <label class="control-label" for="activo">Activo</label> -->

								 <div class="controls">
								  <label class="checkbox inline">Activo
									<input type="checkbox" id="activo" name="activo"  value="1"  <?php echo $checado?>> 
								  </label>

								  <label class="checkbox inline">Inventariable
									<input type="checkbox" id="inventariable" name="inventariable"  value="1"  <?php echo $checado_inv?>> 
								  </label>
								 </div>
								</div>

							<?php combobox("subcategoria",$subcategoria_id)?>


							  <div class="control-group ">
								<label class="control-label" for="producto">Producto</label>
								<div class="controls">
								  <input classe="input-xlarge focused" id="producto" name="producto" type="text" value="<?php echo strtoupper(stripslashes($producto))?>">
								</div>
							  </div>

						<?php combobox("talla",$talla_id)?>


					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Precios</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
					
					
<!-- 
							  <div class="control-group ">
								<label class="control-label" for="descripcion">Descripcion</label>
								<div class="controls">
								  <textarea class="cleditor" id="descripcion" name="descripcion" rows="3"><?php echo strtoupper($detalle)?></textarea>
								</div>
							  </div>
							   -->
							 


							  <div class="control-group">
								<label class="control-label" >Precio Compra</label>
								<div class="controls">
								  <input class="input-small" id="precio_compra" name="precio_compra" type="text" value="<?php echo $precio_compra?>"> <?php echo dinero($precio_compra/1.16)?>
								</div>
							  </div>
							  

							<div class="control-group">
							  <label class="control-label" for="precio_contado">Precio Contado</label>
							  <div class="controls">
								<input type="text" class="input-small" id="precio_contado" name="precio_contado" value="<?php echo $precio_contado?>"> <?php echo dinero($precio_contado/1.16)?>
							  </div>
							</div>

							  <div class="control-group">
								<label class="control-label" >Precio Credito</label>
								<div class="controls">
								  <input class="input-small" id="precio_credito" name="precio_credito" type="text" value="<?php echo $precio_credito?>"> <?php echo dinero($precio_credito/1.16)?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" >Precio Promocion</label>
								<div class="controls">
								  <input class="input-small" id="precio_promocion" name="precio_promocion" type="text" value="<?php echo $precio_promocion?>">
								</div>
							  </div>
							 
							  <div class="control-group">
								<label class="control-label" >Descuento</label>
								<div class="controls">
								  <input class="input-small" id="descuento" name="descuento" type="text" value="<?php echo $descuento?>">%
								</div>
							  </div>

							 






					</div>
		</div><!--/span-->
			

		<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Proveedor</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						

						<?php combobox("proveedor",$proveedor_id)?>


					</div>
		</div><!--/span-->

		<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Caracteristicas</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						
						<?php combobox("marca",$marca_id)?>
						<?php combobox("unidad",$unidad_id)?>
						
						 <div class="control-group">
								<label class="control-label" >Estilo</label>
								<div class="controls">
								  <input class="input-xlarge" id="estilo" name="estilo" type="text" value="<?php echo $estilo?>">
								</div>
							  </div>

					</div>
		</div><!--/span-->
			
</div><!--/row-->








































						
							



						


							  


							  <div class="form-actions">
								<button type="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
