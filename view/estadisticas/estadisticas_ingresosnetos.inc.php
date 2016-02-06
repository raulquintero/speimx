    <?php
	if(!$_GET['fi'])
		$fecha_inicio=date("m/01/Y"); else $fecha_inicio=$_GET['fi'];
	if(!$_GET['ff'])
		$fecha_final=date("m/d/Y");else $fecha_final=$_GET['ff'];
?>

<?php
 $query = "SELECT sum(cantidad) as total from movimiento
 where fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59' AND (movimiento.tipomov_id=1 OR movimiento.tipomov_id=13 or movimiento.tipomov_id=14)";
		list( $total ) = $database->get_row( $query );
$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=2 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $devoluciones ) = $database->get_row( $query );

$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=14 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $ventas_contado ) = $database->get_row( $query );
$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=3 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $ventas_credito ) = $database->get_row( $query );
$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=1 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $abonos ) = $database->get_row( $query );
$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=13 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $enganche ) = $database->get_row( $query );

 $query = "SELECT sum(total) as total from pedido
	where fecha_orden>='".fechaustomysql($fecha_inicio)."' AND fecha_orden<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $pedidos_andrea ) = $database->get_row( $query );

$query = "SELECT sum(cantidad) as total from pedido_movimiento
	where pedido_movimiento.tipomov_id=14 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $anticipos_andrea ) = $database->get_row( $query );

?>

	<div class="row-fluid condensed">
				<div class="box span3 hidden-print">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Corte de Caja</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div>
					<div class="box-content">

    			    <form class="form-vertical" action="?data=estadisticas&op=reportegral">
	    			    <fieldset>
								<input type="hidden" name="data" value="estadisticas" >
								<input type="hidden" name="op" value="ventas">


								<input type="hidden" name="f" value="<?php echo $_GET['f']?>">

                    <div class="control-group">
							  <label class="control-label" for="date01"><b>Fecha Inicio</b> (m/d/A)</label>
							  <div class="controls">
								<input type="text" class="input-small datepicker" id="fi" name="fi" value="<?php echo $fecha_inicio?>">
								<input type="text" class="input-small datepicker" id="hi" name="hi" value="8:00:00">
							  </div>
					</div>

                    <div class="control-group">
							  <label class="control-label" for="date02"><b>Fecha Fin</b> (m/d/A)</label>
							  <div class="controls">
								<input type="text" class="input-small datepicker" id="ff" name="ff" value="<?php echo $fecha_final?>">
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


				<div class="sparkLineStats span4 widget green" onTablet="span5" onDesktop="span4">

                    <ul class="unstyled">
                        <li><span class="sparkLineStats3"></span>
                            Ingresos Netos:
                            <span class="number">$ <?php echo dinero($total)?></span>
                        </li>
                        <li><span class="sparkLineStats4"></span>
                            Ventas Credito:
                            <span class="number">2,19</span>
                        </li>
                        <li><span class="sparkLineStats5"></span>
                            Deuda Ventas Credito:
                            <span class="number">00:02:58</span>
                        </li>
                        <li><span class="sparkLineStats6"></span>
                            Ventas Contado: <span class="number">59,83%</span>
                        </li>
                        <li><span class="sparkLineStats7"></span>
                            Pedidos:
                            <span class="number">70,79%</span>
                        </li>
                        <li><span class="sparkLineStats8"></span>
                            Deuda:
                            <span class="number">29,21%</span>
                        </li>


                    </ul>

					<div class="clearfix"></div>

                </div><!-- End .sparkStats -->



                <div class="span5 widget blue" onTablet="span7" onDesktop="span5">

					<div id="stats-chart2"  style="height:282px" ></div>

				</div>


    </div>  <!---main condensed  ----->



	<div class="row-fluid condensed">
                     <div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Ingresos Netos </h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
		<div class="box-content">

        <div class="box span4">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Ventas y Salidas</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div>
    			<table class="table table-condensed">
							  <thead>
								  <tr>
									  <th  colspan=2 style="text-align:center">Periodo <?php echo  $fecha_inicio." - ".$fecha_final?> </th>
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


                              </tbody>
						 </table>

                </div>




				<div class="widget blue span8" onTablet="span8" onDesktop="span8">

					<h2><span class="glyphicons globe"><i></i></span> Ingresos Netos</h2>

					<hr>

					<div class="content">

						<div class="verticalChart">

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>37%</span>
									</div>

								</div>

								<div class="title">US</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>16%</span>
									</div>

								</div>

								<div class="title">PL</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>12%</span>
									</div>

								</div>

								<div class="title">GB</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>9%</span>
									</div>

								</div>

								<div class="title">DE</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>7%</span>
									</div>

								</div>

								<div class="title">NL</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>6%</span>
									</div>

								</div>

								<div class="title">CA</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>5%</span>
									</div>

								</div>

								<div class="title">FI</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>4%</span>
									</div>

								</div>

								<div class="title">RU</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>3%</span>
									</div>

								</div>

								<div class="title">AU</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>1%</span>
									</div>

								</div>

								<div class="title">N/A</div>

							</div>

							<div class="clearfix"></div>

						</div>

					</div>

				</div><!--/span-->



            </div>


    </div> <!-- end seccion  -->

