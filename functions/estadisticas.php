<?php 

function mostrar_ventas()
{
$database = new DB();

			//$fecha=fechaplusweek($fecha);

	$total_pagos=ceil($total/$abono);


	echo "
					<div class=\"box-header\">
						<h2></span>Ventas</h2>
						<div class=\"box-icon\">
							<a href=\"#\" class=\"btn-setting\"><i class=\"halflings-icon wrench\"></i></a>
							<a href=\"#\" class=\"btn-minimize\"><i class=\"halflings-icon chevron-up\"></i></a>
							<a href=\"#\" class=\"btn-close\"><i class=\"halflings-icon remove\"></i></a>
						</div>
					</div>
					<div>
						<table class=\"table table-condensed striped\" width=100% >
							  <thead>
								  <tr>
									  <th style='text-align:right'>Id</th>
									  <th style='text-align:right'>Fecha</th>
									  <th style='text-align:right'>Cliente</th>
									  <th style='text-align:center'>Tipo Venta</th>
									  <th style='text-align:center'>Total</th>
									  <th style='text-align:center'>Vendedor</th>
								  </tr>
							  </thead>   
							  <tbody>";


	$query = "SELECT  * from factura,tipomov,admin where factura.tipomov_id=tipomov.tipomov_id AND factura.admin_id=admin.admin_id";

					$results = $database->get_results( $query );

	foreach( $results as $item )
					{
						$vendedor=$item['nombre']." ".$item['apellidop'];
						echo "<tr><td style='text-align:right'>".$item['factura_id']."</td><td style='text-align:right'>".$item['fecha']."</td><td style='text-align:right'>".$item['cliente_id']."</td>
							<td>".$item['tipomov']."
							<br></td> 
							<td style='text-align:right'>$ ".dinero($item['total'])."<td style='text-align:right'>".$vendedor;
					
						echo "&nbsp;&nbsp;</td></tr>";
										
						$n++;
					}
	

	echo " </tbody>
		</table> ";
		//echo "Pagos Atrazados: ".$pagos_atrazados;
echo "</div>";



}








 ?>