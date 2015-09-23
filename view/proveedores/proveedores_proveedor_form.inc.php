<?php 
	 $pid=(htmlspecialchars($_GET["pid"]));
	 $f=(htmlspecialchars($_GET["f"]));
	 if ($f=="editar")
	 	$title="Editar Proveedor [$pid]";
	 		else
	 	$title="Agregar Proveedor";



	 $checado="checked";

	 if ($pid>0)
	 {
		$query = "SELECT proveedor_id, activo, rfc,proveedor, contacto,  
			telefono, email, domicilio, colonia_id, telefono_oficina, observaciones FROM proveedor WHERE proveedor.proveedor_id=$pid  ";
			//$results = $database->get_results( $query );
			//$query = "SELECT group_id, group_name, group_parent FROM your_table WHERE group_name LIKE '%production%'";
		list( $proveedor_id, $activo, $rfc,$proveedor, $contacto, $telefono,$email,$domicilio,$colonia_id,$telefono_oficina,$observaciones ) = $database->get_row( $query );

		if (!$activo) $checado="";


		$queryWhere="";
	 }



	 	

?>

			<div class="row-fluid">
				<div class="box  span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span><?=$title?></h2>
						<div class="box-icon">
							
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href='<?php echo "/index.php?data=clientes&op=detalles&pid=$pid"?>' ><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="/functions/crud_proveedores.php">
							<fieldset>

								<input type="hidden" name="data" value="<?php echo $_GET['data']?>" >
								<input type="hidden" name="op" value="<?php echo $_GET['op']?>">
								<input type="hidden" name="f" value="<?php echo $_GET['f']?>">
								<input type="hidden" name="pid" value=<?php echo $pid?> >
								<?php 
								if ($f=="agregar")
									echo "<input type=\"hidden\" name=\"func\" value=\"c\">";
									else
									echo "<input type=\"hidden\" name=\"func\" value=\"u\">";
								?>
								
						<div class="alert alert-info">
							<strong>Datos Fiscales</strong>
						</div>
							  
								<div class="control-group">
								<label class="control-label">Activo</label>
								 <div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox1" name="activo"  value="1"  <?php echo $checado?>> 
								  </label>
								 </div>
								</div>



							  <div class="control-group ">
								<label class="control-label" for="rfc">R.F.C</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="curp" name="rfc" type="text" value="<?php echo strtoupper($rfc)?>">
								</div>
							  </div>

							  <div class="control-group ">
								<label class="control-label" for="empresa">Nombre o Razon Social</label>
								<div class="controls">
								  <input class="input-xlarge" id="empresa" name="proveedor" type="text" value="<?php echo ucfirst($proveedor)?>">
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" >Contacto</label>
								<div class="controls">
								  <input class="input-xlarge" id="contacto" name="contacto" type="text" value="<?php echo ucfirst($contacto)?>">
								</div>
							  </div>
							  
	
							  <div class="control-group">
								<label class="control-label" >Tel Celular</label>
								<div class="controls">
								  <input class="input-xlarge" id="telefono" name="telefono" type="text" value="<?php echo $telefono?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" >Email</label>
								<div class="controls">
								  <input class="input-xlarge" id="email" name="email" type="text" value="<?php echo $email?>">
								</div>
							  </div>
							 
						<div class="alert alert-info">
							<strong>Domicilio</strong>
						</div>							  
							 
							  <div class="control-group">
								<label class="control-label" >Domicilio</label>
								<div class="controls">
								  <input class="input-xlarge" id="domicilio" name="domicilio" type="text" value="<?php echo ucfirst($domicilio)?>">
								</div>
							  </div>


							<?php combobox("colonia",$colonia_id)?>

							  
							  <div class="control-group">
								<label class="control-label" >Telefono Oficina</label>
								<div class="controls">
								  <input class="input-xlarge" id="telefono_oficina" name="telefono_oficina" type="text" value="<?php echo $telefono_oficina?>">
								</div>
							  </div>
							  







						<div class="alert alert-info">
							<strong>Informacion Adicional</strong>
						</div>

							

							  <div class="control-group hidden-phone">
							  <label class="control-label" for="observaciones">Observaciones</label>
							  <div class="controls">
								<textarea class="cleditor" id="observaciones" name="observaciones" rows="3"><?php echo $observaciones?></textarea>
							  </div>
							</div>



							  


							  <div class="form-actions">
								<button type="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
