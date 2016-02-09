
<?php

	echo$fecha_inicio=isset($_GET['fi']) ? fechaustomysql($_GET['fi']) : date("Y-m-d");

    $fecha_final=isset($_GET['ff']) ? fechaustomysql($_GET['ff']) : date("Y-m-d");

?>
      <br><bR>







	<div class="row-fluid condensed">
				<div class="box span4 hidden-print">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Corte de Caja</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div>
					<div class="box-content">

    			    <form class="form-vertical" action="?data=estadisticas&op=ventas">
	    			    <fieldset>
								<input type="hidden" name="data" value="estadisticas" >
								<input type="hidden" name="op" value="ventas">


								<input type="hidden" name="f" value="<?php echo $_GET['f']?>">

                    <div class="control-group">
							  <label class="control-label" for="date01"><b>Fecha Inicio</b> (m/d/A)</label>
							  <div class="controls">
								<input type="text" class="input-small datepicker" id="fi" name="fi" value="<?php echo fechamysqltous($fecha_inicio)?>">
								<input type="text" class="input-small datepicker" id="hi" name="hi" value="8:00:00">
							  </div>
					</div>

                    <div class="control-group">
							  <label class="control-label" for="date02"><b>Fecha Fin</b> (m/d/A)</label>
							  <div class="controls">
								<input type="text" class="input-small datepicker" id="ff" name="ff" value="<?php echo fechamysqltous($fecha_final)?>">
								<input type="text" class="input-small datepicker" id="hf" name="hf" value="<?php echo date("G:i:s")?>">
							  </div>
					</div>

					 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Generar</button>
							  </div>
						</fieldset>
		        	</form>

                    </div>

                    </div>

                    <div class="box span8">
                     <div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Reporte Global </h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>



<?php
  $query = "SELECT sum(cantidad) as total from movimiento,cliente
 where fecha>='".$fecha_inicio."' AND fecha<='".$fecha_final." 23:59:59' AND (movimiento.tipomov_id=1 OR movimiento.tipomov_id=13 or movimiento.tipomov_id=14)
 AND movimiento.cliente_id=cliente.cliente_id  AND cliente.empresa_id<>2";
		list( $total ) = $database->get_row( $query );
$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=2 AND fecha>='".$fecha_inicio."' AND fecha<='".$fecha_final." 23:59:59'";
		list( $devoluciones ) = $database->get_row( $query );

$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=14 AND fecha>='".$fecha_inicio."' AND fecha<='".$fecha_final." 23:59:59'";
		list( $ventas_contado ) = $database->get_row( $query );
$query = "SELECT sum(cantidad) as total from movimiento,cliente
	where movimiento.tipomov_id=3 AND fecha>='".$fecha_inicio."' AND fecha<='".$fecha_final." 23:59:59'
    AND movimiento.cliente_id=cliente.cliente_id AND cliente.empresa_id<>2";
		list( $ventas_credito ) = $database->get_row( $query );
$query = "SELECT sum(cantidad) as total from movimiento,cliente
	where movimiento.tipomov_id=1 AND fecha>='".$fecha_inicio."' AND fecha<='".$fecha_final." 23:59:59'
    AND movimiento.cliente_id=cliente.cliente_id AND cliente.empresa_id=0";
		list( $abonos ) = $database->get_row( $query );
$query = "SELECT sum(cantidad) as total from movimiento,cliente
	where movimiento.tipomov_id=1 AND fecha>='".$fecha_inicio."' AND fecha<='".$fecha_final." 23:59:59'
    AND movimiento.cliente_id=cliente.cliente_id AND cliente.empresa_id<>0 AND cliente.empresa_id<>2";
		list( $abonos_nomina ) = $database->get_row( $query );

$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=13 AND fecha>='".$fecha_inicio."' AND fecha<='".$fecha_final." 23:59:59'";
		list( $enganche ) = $database->get_row( $query );

 $query = "SELECT sum(total) as total from pedido
	where fecha_orden>='".$fecha_inicio."' AND fecha_orden<='".$fecha_final." 23:59:59'";
		list( $pedidos_andrea ) = $database->get_row( $query );

 $query = "SELECT sum(cantidad) as total from pedido_movimiento
	where pedido_movimiento.tipomov_id=14 AND fecha>='".$fecha_inicio."' AND fecha<='".$fecha_final." 23:59:59'";
		list( $anticipos_andrea ) = $database->get_row( $query );


?>

						<table class="table table-condensed">
							  <thead>
								  <tr>
									  <th  colspan=2 style="text-align:center">Periodo <?php echo  fechamysqltomx($fecha_inicio,"letra")." - ".fechamysqltomx($fecha_final,"letra")?> </th>
								  </tr>
							  </thead>
							  <tbody>

                                  <tr><td>Ingresos Netos</td><td style="text-align:right"><?php echo dinero($total)?></td></tr>


                                  <tr><td>Ventas Credito</td><td style="text-align:right"><?php echo dinero($ventas_credito)?></td></tr>
                                  <tr><td>Enganche</td><td style="text-align:right"><?php echo dinero($enganche)?></td></tr>
                                  <tr><td>Ventas Contado</td><td style="text-align:right"><?php echo dinero($ventas_contado)?></td></tr>
                                  <tr><td>Abonos</td><td style="text-align:right"><?php echo dinero($abonos)?></td></tr>
                                  <tr><td>Devoluciones</td><td style="text-align:right"><?php if($devoluciones>0)echo "<font color=red><b> -"; echo dinero($devoluciones)?></td></tr>

                                  <tr bgcolor=gray><td style="color:white;border-top:2px solid"><b>Total</b></td><td style="text-align:right;color:white;border-top:2px solid"><b><?php echo dinero($total-$devoluciones)?></b></td></tr>
                                  <tr><td>Pedidos Andrea</td><td style="text-align:right"><?php echo dinero($pedidos_andrea)?></td></tr>
                                  <tr><td>Anticipos</td><td style="text-align:right"><?php echo dinero($anticipos_andrea)?></td></tr>
                                  <tr><td>Abonos Nomina</td><td style="text-align:right"><?php echo dinero($abonos_nomina)?></td></tr>


                              </tbody>
						 </table>











                    </div>











    </div>  <!---main condensed  ----->







	<div class="row-fluid condensed">





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
                                <tr><th bgcolor="#cccccc" colspan=5>Ingresos Netos</th></tr>

							  </thead>
							  <tbody>

                                    <?php

                                    	//$fecha_inicio=fechaustomysql($fecha_inicio);
                                    	//$fecha_final =fechamysqltous($fecha_final);
                                    mostrar_transacciones($fecha_inicio,$fecha_final,$user);?>
							  	<?php echo $user;?>



  				</tbody>
						 </table>

					</div>

			<div class="box span4 hidden-print">
                    <div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Nota de Venta</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div><!--/span-->

                    <div class="box-content">
						<table class="table table-condensed">
							  <thead>
                                <tr><th bgcolor="#cccccc" colspan=5>Preview</th></tr>

							  </thead>
							  <tbody>

                                    <?php

                                    	//$fecha_inicio=fechaustomysql($fecha_inicio);
                                    	//$fecha_final =fechaustomysql($fecha_final);
                                   // mostrar_transacciones($fecha_inicio,$fecha_final,$user);?>
							  	<?php if ($_GET['fid']) getticket($_GET['fid']);?>



  				</tbody>
						 </table>

					</div>
			</div><!--/row-->
		</div>
		</div>