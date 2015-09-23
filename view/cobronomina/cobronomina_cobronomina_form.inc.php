<?php 
	 $gid=(htmlspecialchars($_GET["gid"]));
	 $f=(htmlspecialchars($_GET["f"]));
	 if ($f=="editar")
	 	$title="Editar Grupo [$gid]";
	 		else
	 	$title="Agregar Grupo";



	 $checado="checked";

	 if ($gid>0)
	 {
		$query = "SELECT gruponomina_id,gruponomina,banco,cuenta,observaciones FROM gruponomina WHERE gruponomina.gruponomina_id=$gid  ";
			//$results = $database->get_results( $query );
			//$query = "SELECT group_id, group_name, group_parent FROM your_table WHERE group_name LIKE '%production%'";
		list( $gruponomina_id, $gruponomina, $banco, $cuenta, $observaciones ) = $database->get_row( $query );

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
							<a href='<?php echo "/index.php?data=clientes&op=detalles&cid=$cid"?>' ><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="/functions/crud_cobronomina.php">
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
								<input type="hidden" name="gid" value=<?php echo $gid?> >
								
						<div class="alert alert-info">
							<strong>Datos Fiscales</strong>
						</div>
							  <!-- 
								<div class="control-group">
								<label class="control-label">Activo</label>
								 <div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox1" name="activo"  value="1"  <?php echo $checado?>> 
								  </label>
								 </div>
								</div> -->


							  <div class="control-group ">
								<label class="control-label" for="gruponomina">Nombre de Grupo</label>
								<div class="controls">
								  <input class="input-xlarge" id="gruponomina" name="gruponomina" type="text" value="<?php echo strtoupper($gruponomina)?>">
								</div>
							  </div>
							  
							<!--   <div class="control-group">
								<label class="control-label" >Contacto</label>
								<div class="controls">
								  <input class="input-xlarge" id="contacto" name="contacto" type="text" value="<?php echo $contacto?>">
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
							  -->
							 
							  <div class="control-group">
								<label class="control-label" >Banco</label>
								<div class="controls">
								  <input class="input-xlarge" id="banco" name="banco" type="text" value="<?php echo $banco?>">
								</div>
							  </div>


							  <div class="control-group">
								<label class="control-label" >No. de Cuenta</label>
								<div class="controls">
								  <input class="input-xlarge" id="cuenta" name="cuenta" type="text" value="<?php echo $cuenta?>">
								</div>
							  </div>

<!-- 
						<div class="alert alert-info">
							<strong>Domicilio</strong>
						</div>							  

							  <div class="control-group">
								<label class="control-label" for="colonia_id">Colonia</label>
								<div class="controls">
								  <select id="colonia_id" name="colonia_id">

							  <?php

								$query = "SELECT colonia_id,colonia FROM  colonia ORDER BY colonia ";
								//list( $colonia_casa ) = $database->get_row( $query );	
								$results = $database->get_results( $query );
								foreach( $results as $row )
								{
									if ($row['colonia_id']==$colonia_id)  $seleccionado="selected='true' "; else $seleccionado="";
    								echo "<option $seleccionado value='".$row['colonia_id']."' >".strtoupper($row['colonia'])."</option>";
    							}
							  ?>
								  </select>
								</div>
							  </div>

							  
							  <div class="control-group">
								<label class="control-label" >Telefono</label>
								<div class="controls">
								  <input class="input-xlarge" id="telefono_oficina" name="telefono_oficina" type="text" value="<?php echo $telefono?>">
								</div>
							  </div>
							  


						<div class="alert alert-info">
							<strong>Datos de Nomina</strong>
						</div>

							  <?php 

								$query = "SELECT gruponomina_id,gruponomina FROM  gruponomina ORDER BY gruponomina ";
								//list( $colonia_casa ) = $database->get_row( $query );	
								$results = $database->get_results( $query );
								 ?>

  							<div class="control-group">
								<label class="control-label" for="gruponomina_id">Grupo Nomina</label>
								<div class="controls">
								  <select id="gruponomina_id" name="gruponomina_id">

							  <?php

								foreach( $results as $row )
								{
									if ($row['gruponomina_id']==$gruponomina_id)  $seleccionado="selected='true' "; else $seleccionado="";
    								echo "<option $seleccionado value='".$row['gruponomina_id']."' >".strtoupper($row['gruponomina'])."</option>";
    							}
							  ?>
								  </select>
								</div>
							  </div>





						<div class="alert alert-info">
							<strong>Otros Datos</strong>
						</div>

							 -->

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
