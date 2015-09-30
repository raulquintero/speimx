

<?php
include 'clientes_detalles.scr.php';


?>

<?php 
if ($_GET['eed']==2)
	 			echo	"<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Registro Agregado!</strong> El Registro $cid esta listo para usarse.
						</div>";

	$cliente=$nombre.' '.$apellidop.' '.$apellidom;
?>						


<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon th"></i><span class="break">Detalles del Cliente</span></h2>
					</div>
					<div class="box-content">
						<ul class="nav tab-menu nav-tabs" id="myTab">
							<li class="active"><a href="#info">Datos Personales</a></li>
							<li><a href="#custom">Credito</a></li>
							<li><a href="#messages">Notas</a></li>
						</ul>
						 
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane active" id="info">
								<p>
											
											<img class=grayscale src=fotos/images.jpeg width=150 align=right></img>									
											
											<b><?php echo strtoupper($nombre.' '.$apellidop.' '.$apellidom)?></b> &nbsp;&nbsp;											
											
											<?php
											if (!$_GET['h'])
											echo "<br>Direccion: $domicilio_casa
											<br>Telefono:  $telefono_personal											
											<br>Trabajo:  $empresa
											<br>Grupo Nomina: <a href='index.php?data=cobronomina&op=empresas&nid=$gruponomina_id' >". strtoupper($gruponomina)."</a>";
											else
												echo "<br><a href=\"#\" class=\"btn btn-info blue btn-setting\" data-toggle=\"modal\" data-target=\"#abonaracuenta\">Abonar a Cuenta</a>";


											?>

											
											<br><br>
											<?php
											if (!$_GET['h'])
											{
												echo "<a href=\"index.php?data=clientes&op=cliente_form&f=editar&cid=$cliente_id\">
													<button class=\"btn btn-primary\"><i class=\"halflings-icon white edit\"></i></button></a>
												
												<a href=\"index.php?data=clientes&op=subirfoto&cid=$cliente_id\">
												<button class=\"btn btn-primary\"><i class=\"halflings-icon white camera\"></i></button></a>";
												
												echo " <a href=\"/index.php?data=clientes&op=cartainvitacion\" class=\"btn btn-primary hidden-print\">*</a>";
											}

											?>											
											<!-- <a href="index.php?data=clientes&op=cliente_form&f=editar&cid=<?=$cliente_id?>"><button 
													class="btn btn-mini btn-primary">Editar Cliente</button></a> 
											<br>
											<a href="index.php?data=clientes&op=cliente_form&f=editar&cid=<?=$cliente_id?>"><button 
													class="btn btn-mini btn-primary">Cambiar Imagen</button></a> 
											 -->	
										
								</p>

							</div>
							<div class="tab-pane" id="custom">
								<img class=grayscale src=fotos/images.jpeg width=150 align=right></img>
									<p><b><?php echo $nombre.' '.$apellidop.' '.$apellidom?></b> &nbsp;&nbsp;</p>
									<table><tr><td valign=top align=right>																			
									<p>Limite de Credito:<b> <?php echo dinero($credito)?></b></p>
									<p>Total Financiado:<b>	<?php echo dinero($total_ultimo)?></b>	</p>
								</td>
								<td>&nbsp;&nbsp;</td>
								<td
									<p>Inicio Plazo:<b> <?=$fecha_total_inicio?></b></p>
									<p>Fin Plazo: <b><?=$fecha_total_ultimo?></b></p>
									</td>
									<td>&nbsp;&nbsp;</td>
									<td valign=top align=right>
										<p>Monedero:<b>   <?php echo dinero($monedero)?></b></p>
									</td></tr>
								</table>
							</div>
							<div class="tab-pane" id="messages">
								<p>
									<?php echo "Notas:". $obsevarciones?>									
								</p>
								
							</div>
						</div>
					</div>
				</div><!--/span-->


			<div class="row-fluid condensed">	

				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Movimientos</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped">
							  <thead>
								  <tr>
									  <th>ID</th>
									  <th>Fecha</th>
									  <th>Cargo</th>
									  <th>Abono</th>
									  <th>Saldo</th>
									  <th>Mov</th>
									  <th>Agente</th>                                          
								  </tr>
							  </thead>   
							  <tbody>


							  	<?php movimientos($cid,$saldo);?>

							
 							 </tbody>
						 </table>  
						 <div class="pagination pagination-centered">
						  <ul>
							<li><a href="#">Prev</a></li>
							<li class="active">
							  <a href="#">1</a>
							</li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">Next</a></li>
						  </ul>
						</div>     
					</div>
				</div><!--/span-->
			

				<div class="box span6">

							  		<?php plandepagos($total_ultimo,$fecha_total_inicio,$abono,$saldo)?>
					
				</div><!--/span-->
			
			</div><!--/row-->


			<div class="modal hide fade" id="abonaracuenta">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Abonar a Cuenta</h3>
		</div>
		<div class="modal-body">

			<form class="form-horizontal" action="./functions/abono.php" >
				<input type="hidden" name="data" value="clientes">
				<input type="hidden" name="op" value="abono">
				<input type="hidden" name="f" value="a">

			<fieldset>

				<div class="control-group">
								<label class="control-label" for="focusedInput">Cantidad</label>
								<div class="controls">
								  $<input class="input-xlarge focused" id="focusedInput" type="cantidad" value="">
								</div>
							  </div>

		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<button type="submit" class="btn btn-primary">Abonar</button>
		</div>
			</fieldset>
	</div>