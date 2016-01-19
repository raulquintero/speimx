
<?php 
	if(!$_GET['fi'])
		$fecha_inicio=date("m/d/Y"); else $fecha_inicio=$_GET['fi'];
	if(!$_GET['ff'])
		$fecha_final=date("m/d/Y");else $fecha_final=$_GET['ff'];
?>
	<div class="row-fluid condensed">


				<div class="box span4">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Corte de Caja</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">








			<form class="form-vertical" action="?data=pos&op=cortedecaja">
				<fieldset>

								<input type="hidden" name="data" value="pos" >
								<input type="hidden" name="op" value="cortedecaja">
								<input type="hidden" name="f" value="<?php echo $_GET['f']?>">

                    <div class="control-group">
							  <label class="control-label" for="date01"><b>Fecha Inicio</b> (m/d/A)</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="fi" name="fi" value="<?php echo $fecha_inicio?>">
							  </div>
					</div>

                    <div class="control-group">
							  <label class="control-label" for="date02"><b>Fecha Fin</b> (m/d/A)</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="ff" name="ff" value="<?php echo $fecha_final?>">
							  </div>
					</div>

					 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Generar</button>
							  </div>
							</fieldset>
			</form>



<br><br>

<?php
 $query = "SELECT sum(cantidad) as total from movimiento where fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'
 	 AND (movimiento.tipomov_id=1 OR movimiento.tipomov_id=13 or movimiento.tipomov_id=14) and admin_id=".$_SESSION['user_id'];
		list( $total ) = $database->get_row( $query );

$query = "SELECT sum(cantidad) as total from movimiento 
	where movimiento.tipomov_id=2 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'  and admin_id=".$_SESSION['user_id'];
		list( $devoluciones ) = $database->get_row( $query );

?>

						<table class="table table-condensed">
							  <thead>
								  <tr>
									  <th>Total</th>


								  </tr>
							  </thead>
							  <tbody>
                                <tr><td style="text-align:right"><h1><?php echo dinero($total-$devoluciones)?></h1></td></tr>

							  	<?//php catalogo();?>



  				</tbody>
						 </table>


						<table class="table table-condensed">
							  <thead>
								  <tr>
									  <th>Venta del dia</th>


								  </tr>
							  </thead>
							  <tbody>
                                <tr><td style="text-align:right"><h2><?php echo dinero($total)?></h1></td></tr>
			  				</tbody>
						 </table>


						 <table class="table table-condensed">
							  <thead>
								  <tr>
									  <th>Devoluciones</th>
								  </tr>
							  </thead>
							  <tbody>
                                <tr><td style="text-align:right"><h2><?php echo dinero($devoluciones)?></h1></td></tr>
			  				</tbody>
						 </table>




					</div>
				</div><!--/span-->


				<div class="box span8">
                    <div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Transacciones</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div><!--/span-->

                    <div class="box-content">
						<table class="table table-condensed">
							  <thead>
                                <tr><th bgcolor="#cccccc" colspan=5>Movimientos Efectivo</th></tr>
								  <tr>
									  <th>Fecha</th>
									  <th>Movimiento</th>
									  <th>Cantidad</th>
                                      <th>Descuento</th>
                                      <th>Total</th>
								  </tr>
							  </thead>
							  <tbody>

                                    <?php 

                                    	$fecha_inicio=fechaustomysql($fecha_inicio);
                                    	$fecha_final =fechaustomysql($fecha_final);
                                    mostrar_transacciones($fecha_inicio,$fecha_final,$_SESSION['user_id']);?>




  				</tbody>
						 </table>

					</div>
			</div><!--/row-->