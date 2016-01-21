	<div class="box span8">
                    <div class="box-header orange">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>PEDIDOS</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div><!--/span-->

                    <div class="box-content">


                        <form class="form-horizontal" action="?data=estadisticas&op=ventas">
	    			    <fieldset>
								<input type="hidden" name="data" value="estadisticas" >
								<input type="hidden" name="op" value="ventas">


								<input type="hidden" name="f" value="<?php echo $_GET['f']?>">

                    <div class="control-group">
							  <label class="control-label" for="date02"><b>Telefono</b></label>
							  <div class="controls">
								<input type="text" class="input-small" id="ff" name="ff" value="686">
							  </div>
					</div>

                    <div class="control-group">
							  <label class="control-label" for="date01"><b>Nombre del Cliente</b></label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="fi" name="fi" value="<?php echo $fecha_inicio?>">
							  </div>
					</div>

                    <div class="control-group">
							  <label class="control-label" for="date02"><b>Cantidad</b></label>
							  <div class="controls">
								$ <input type="text" class="input-small " id="ff" name="ff" value="<?php echo $fecha_final?>">
							  </div>
					</div>

                    <div class="control-group">
							  <label class="control-label" for="date02"><b>Notas</b></label>
							  <div class="controls">
								 <input type="text" class="input-xlarge" id="ff" name="ff" value="<?php echo $fecha_final?>">
							  </div>
					</div>

					 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Ordenar</button>
							  </div>
						</fieldset>
		        	</form>

                     </div>



					</div>

			<div class="box span4 hidden-print">
                    <div class="box-header orange">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Articulos</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div><!--/span-->

                    <div class="box-content">
						<table class="table table-condensed">

							  <tbody>

                                    <?php

                                    	//$fecha_inicio=fechaustomysql($fecha_inicio);
                                    	//$fecha_final =fechaustomysql($fecha_final);
                                   // mostrar_transacciones($fecha_inicio,$fecha_final,$user);?>
							  	<?php  getticket(139);?>



  				</tbody>
						 </table>

					</div>
			</div><!--/row-->
		</div>
		</div>