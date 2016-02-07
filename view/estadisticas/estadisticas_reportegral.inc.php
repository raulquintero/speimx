
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



                <div class="span3 statbox blue" onTablet="span6" onDesktop="span3">
					<div class="boxchart">4000,3000,2000,3000,5000,2000</div>
					<div class="number"><?php echo round($total)?><i class="icon-arrow-up"></i></div>
					<div class="title">ingresos netos</div>
					<div class="footer">
						<a href="/index.php?data=estadisticas&op=ingresosnetos"> read full report</a>
					</div>
				</div>
				<div class="span3 statbox blue" onTablet="span6" onDesktop="span3">
					<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
					<div class="number">0<i class="icon-arrow-down"></i></div>
					<div class="title">proveedores</div>
					<div class="footer">
						<a href="#"> read full report</a>
					</div>
				</div>
				<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
					<div class="number">0<i class="icon-arrow-up"></i></div>
					<div class="title">otras deudas</div>
					<div class="footer">
						<a href="#"> read full report</a>
					</div>
				</div>


				<div class="span3 statbox orange noMargin" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
					<div class="number">982<i class="icon-arrow-up"></i></div>
					<div class="title">gasto operativo</div>
					<div class="footer">
						<a href="#"> read full report</a>
					</div>
				</div>

                 <br><br>
    <div class="box-header ">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Empresas Nomina</h2>

                        <div class="clearfix"></div>

     </div>
      <br>

			<div class="row-fluid hideInIE8 circleStats">

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox orange">
						<div class="header">Fruteria Nena's'</div>
						<span class="percent">percent</span>
						<div class="circleStat">
                    		<input type="text" value="40" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">16000</span>
								<span class="unit">MX</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">23000</span>
								<span class="unit">MX</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox blueDark">
						<div class="header">Mac's'</div>
						<span class="percent">percent</span>
						<div class="circleStat">
                    		<input type="text" value="78" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">5000</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">5000</span>
								<span class="unit">GB</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox blue">
						<div class="header">Moda para ti</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="100" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2 noMargin" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox blueDark">
						<div class="header">Oscar</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="83" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GHz</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">3.2</span>
								<span class="unit">GHz</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox red">
						<div class="header">Memory</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="10" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox blue">
						<div class="header">Memory</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="100" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
						</div>
                	</div>
				</div>

			</div>




					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Proveedores</h2>

                        <div class="clearfix"></div>
                    </div>
                    <br>


			<div class="row-fluid hideInIE8 circleStats">

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox greenDark">
						<div class="header">Nautica</div>
						<span class="percent">percent</span>
						<div class="circleStat">
                    		<input type="text" value="63" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">16000</span>
								<span class="unit">MX</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">23000</span>
								<span class="unit">MX</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox greenDark">
						<div class="header">Franky Max JC</div>
						<span class="percent">percent</span>
						<div class="circleStat">
                    		<input type="text" value="78" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">5000</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">5000</span>
								<span class="unit">GB</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox green">
						<div class="header">Moda para ti</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="100" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2 noMargin" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox greenDark">
						<div class="header">Oscar</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="83" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GHz</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">3.2</span>
								<span class="unit">GHz</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox green">
						<div class="header">Memory</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="100" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox green">
						<div class="header">Memory</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="100" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
						</div>
                	</div>
				</div>

			</div>


<div class="clearfix"></div>


