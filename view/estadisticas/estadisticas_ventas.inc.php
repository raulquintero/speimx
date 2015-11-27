
<?php 

	//$query = "SELECT  count(factura_id) as ventas from factura,tipomov,admin where factura.tipomov_id=tipomov.tipomov_id AND factura.admin_id=admin.admin_id";
	$query = "SELECT  sum(cantidad) as abono from movimiento where tipomov_id=1";
		list( $abono ) = $database->get_row( $query );if (!$abono) $abono=0;
	$query = "SELECT  admin.admin_id from factura,tipomov,admin where factura.tipomov_id=tipomov.tipomov_id AND factura.admin_id=admin.admin_id GROUP BY admin.admin_id DESC";
		$vendedores = $database->num_rows( $query );



	$query = "SELECT  sum(total+iva) as ventas from factura,tipomov,admin where factura.tipomov_id=tipomov.tipomov_id AND factura.admin_id=admin.admin_id AND tipomov.tipomov_id=14 ";
		list( $total_contado_hoy ) = $database->get_row( $query );

	$query = "SELECT  sum(total) as ventas from devolucion ";
		list( $devolucion_contado_hoy ) = $database->get_row( $query );
	
	$query = "SELECT  sum(total+iva) as ventas from factura,tipomov,admin where factura.tipomov_id=tipomov.tipomov_id AND factura.admin_id=admin.admin_id AND tipomov.tipomov_id=3 ";
		list( $total_credito_hoy ) = $database->get_row( $query );
	$query = "SELECT  count(factura_id) as ventas from factura,tipomov,admin where factura.tipomov_id=tipomov.tipomov_id AND factura.admin_id=admin.admin_id ORDER BY factura_id DESC";
		list( $ventas ) = $database->get_row( $query );


 ?>
<div class="row-fluid">
				
					

					<div class="span2 statbox black" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br><a href="/index.php?data=estadisticas&op=reporte_semanal"><font color=white><?php echo dinero($total_contado_hoy)?></font></a> &nbsp;<!--i class="icon-arrow-up"></i--></div>
						<div class="title"><br>Ventas Contado</div>
						<!--div class="footer">
							<a href="#"> Saldo</a>
						</div-->	
					</div>
					
					<div class="span2 statbox black" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br><?php echo dinero($devolucion_contado_hoy)?>&nbsp;<!--i class="icon-arrow-up"></i--></div>
						<div class="title"><br>Devolucion Contado</div>
						<!--div class="footer">
							<a href="#"> Saldo</a>
						</div-->	
					</div>

					<div class="span2 statbox black" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br><?php echo dinero($total_credito_hoy)?>&nbsp;<!--i class="icon-arrow-up"></i--></div>
						<div class="title"><br>Ventas Credito</div>
						<!--div class="footer">
							<a href="#"> Saldo</a>
						</div-->	
					</div>

					<div class="span2 statbox black" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br> <?php echo dinero($abono)?>&nbsp;<!--i class="icon-arrow-up"></i--></div>
						<div class="title"><br>Abonos</div>
						<!--div class="footer">
						<a href="#"> Saldo</a>
						</div-->	
					</div>

					<div class="span2 statbox blue" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br><?php echo dinero($total_credito_hoy+$total_contado_hoy-$devolucion_contado_hoy)?>&nbsp;<!--i class="icon-arrow-up"></i--></div>
						<div class="title"><br>Total Hoy</div>
						<!--div class="footer">
							<a href="#"> Saldo</a>
						</div-->	
					</div>

					<div class="span2 statbox green" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br><?php echo dinero($total_credito_hoy+$total_contado_hoy-$devolucion_contado_hoy)?>&nbsp;<!--i class="icon-arrow-up"></i--></div>
						<div class="title"><br>Total Mes</div>
						<!--div class="footer">
							<a href="#"> Saldo</a>
						</div-->	
					</div>

				</div>



<div class="row-fluid condensed">	


	<div class="box-content span8">
				<table cellpadding=5 width=100%>
					<tr><td>	
					<?php mostrar_ventas();?>
					</td><td>&nbsp;</td></tr>
				</table>
					</div>

	<div class="box-content span4">
				<?php 

					$fid=$_GET['fid'];
		if ($_GET['fid'])
						{
							$no_ticket=sprintf('T%06d', $fid);

							echo "<table width=350><tr><td>";
							getfactura($fid);      // formato.php
				
							
							echo "<center>";

							if ($cliente_id)
							{
							echo "<br><Br><br><br>

							_______________________<br>";
							echo strtoupper($nombre_completo);
							}
							echo "<br><br><br>";

							echo " <img width=200 src=\"barcode.php?text=".$no_ticket."\" alt=\"barcode\" />";
							
							echo "<br><br>
						 	http://tiendasalberto.com<br>";
						 
						 	echo $ticket;
						 	echo "<br>
							</center>
							<br><Br>";
							echo "</td><td>&nbsp;</td></tr></table>";
						}

				 ?>
					</div>


			</div>




</div>
<?php




?>