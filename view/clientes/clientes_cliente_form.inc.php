<?php

	 $cid=(htmlspecialchars($_GET["cid"]));
	 $f=(htmlspecialchars($_GET["f"]));
	 if ($f=="editar")
	 	$title="Editar Cliente [$cid]";
	 		else
	 	$title="Agregar Cliente";


	 $checado="checked";

	 if ($cid>0)
	 {
		$query = "SELECT activo, curp, cliente_id,cliente.gruponomina_id ,nombre, apellidop, apellidom, domicilio_casa,colonia_casa_id, credito,tipocredito_id, total_ultimo, fecha_total_ultimo,fecha_total_inicio,
			email,telefono_personal, telefono_casa, credito,saldo,abono,antiguedad_empleo,cliente.observaciones,cliente.empresa_id FROM cliente,gruponomina WHERE cliente.cliente_id=$cid
			AND cliente.gruponomina_id=gruponomina.gruponomina_id";
		//$results = $database->get_results( $query );
		//$query = "SELECT group_id, group_name, group_parent FROM your_table WHERE group_name LIKE '%production%'";
		list( $activo, $curp, $cliente_id, $gruponomina_id,  $nombre, $apellidop,$apellidom,$domicilio_casa,$colonia_casa_id,$credito,$tipocredito_id, $total_ultimo, $fecha_total_ultimo,$fecha_total_inicio,
			$email, $telefono_personal,$telefono_casa,
			$credito,$saldo,$abono,$antiguedad_empleo,$observaciones, $empresa_id ) = $database->get_row( $query );
		if (!$activo) $checado="";


		$queryWhere="";
	 }


    if ($tipocredito_id==0) $tipocredito_id=4; 


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
						<form class="form-horizontal" action="/functions/crud_clientes.php">
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
								<input type="hidden" name="cid" value=<?php echo $cid?> >
								
						<div class="alert alert-info">
							<strong>Datos Personales</strong>
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
								<label class="control-label" for="curp">CURP</label>
								<div class="controls">
								  <input class="input-xlarge" id="curp" name="curp" type="text" value="<?php echo $curp?>">
								</div>
							  </div>

							  <div class="control-group ">
								<label class="control-label" for="nombre">Nombre</label>
								<div class="controls">
								  <input class="input-xlarge" id="nombre" name="nombre" type="text" value="<?php echo $nombre?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" >Apellido Paterno</label>
								<div class="controls">
								  <input class="input-xlarge" id="apellidopaterno" name="apellidop" type="text" value="<?php echo $apellidop?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" >Apellido Materno</label>
								<div class="controls">
								  <input class="input-xlarge" id="apellidomaterno" name="apellidom" type="text" value="<?php echo $apellidom?>">
								</div>
							  </div>

							<div class="control-group">
							  <label class="control-label" for="date01">Fecha Nacimiento (m/d/A)</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="fechanac" name="fechanac" value="02/16/1980">
							  </div>
							</div>

							<div class="control-group">
								<label class="control-label">Sexo</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="sexo_id" id="sexo" value="0" checked="">
									Femenino
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="sexo_id" id="sexo" value="1">
									Masculino
								  </label>
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" >Tel Celular</label>
								<div class="controls">
								  <input class="input-xlarge" id="telefono_personal" name="telefono_personal" type="tel" value="<?php echo $telefono_personal?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" >Email</label>
								<div class="controls">
								  <input class="input-xlarge" id="email" name="email" type="email" value="<?php echo $email?>">
								</div>
							  </div>

                              <?php combobox("tipocredito",$tipocredito_id)?>

						<div class="alert alert-info">
							<strong>Domicilio</strong>
						</div>							  

							  <div class="control-group">
								<label class="control-label" >Domicilio</label>
								<div class="controls">
								  <input class="input-xlarge" id="domicilio_casa" name="domicilio_casa"type="text" value="<?php echo $domicilio_casa?>">
								</div>
							  </div>


							<?php combobox("colonia",$colonia_casa_id)?>


							

							  
							  <div class="control-group">
								<label class="control-label" >Telefono</label>
								<div class="controls">
								  <input class="input-xlarge" id="telefono_casa" name="telefono_casa" type="text" value="<?php echo $telefono_casa?>">
								</div>
							  </div>
							  

						<div class="alert alert-info">
							<strong>Datos Laborales</strong>
						</div>

							<?php combobox("empresa",$empresa_id)?>



						  <div class="control-group">
								<label class="control-label" >Antiguedad Empleo</label>
								<div class="controls">
								  <input class="input-xlarge" id="antiguedad_empleo" name="antiguedad_empleo" type="text" value="<?php echo $antiguedad_empleo?>">
								</div>
							  </div>

							  


						<div class="alert alert-info">
							<strong>Datos Nomina</strong>
						</div>
<!-- 
							  <div class="control-group">
								<label class="control-label" for="selectError3">Grupo Nomina</label>
								<div class="controls">
								  <select id="gruponomina_id" name="gruponomina_id">
										<?php
									$query = "SELECT gruponomina_id,gruponomina FROM  gruponomina ORDER BY gruponomina ";
									//list( $colonia_casa ) = $database->get_row( $query );	
									$results = $database->get_results( $query );
									foreach( $results as $row )
										{
										if ($row['gruponomina_id']==$gruponomina_id)  $seleccionado="selected='true' "; else $seleccionado="";
    									echo "<option $seleccionado value='".$row['gruponomina_id']."' >".$row['gruponomina_id'].'  '.$row['gruponomina']."</option>";
    									}

							  ?>
							    </select>
								</div>
							  </div> -->

							  <div class="control-group hidden-phone">
							  <label class="control-label" for="observaciones">Observaciones</label>
							  <div class="controls">
								<textarea class="cleditor" id="observaciones" name="observaciones" rows="3"><?php echo $observaciones?></textarea>
							  </div>
							</div>



							<?php

							if ($f=="editar")
								include 'clientes_cliente_formfull.inc.php';
							?>


							  


							  <div class="form-actions">
								<button type="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
