<?php 

function mostrar_transacciones($fecha_inicio,$fecha_fin)
{
$database = new DB();

			//$fecha=fechaplusweek($fecha);

	$total_pagos=ceil($total/$abono);


	echo "
					
					<div>
						<table class=\"table table-condensed striped\" width=100% >
							  <thead>
								  <tr>
									  <th style='text-align:right'>Id</th>
									  <th style='text-align:center'>Fecha</th>
									  <th style='text-align:center'>Movimiento</th>
									  <th style='text-align:center'>Total</th>
									  <th style='text-align:center'>Vendedor</th>
								  </tr>
							  </thead>   
							  <tbody>";


	$query = "SELECT  * from movimiento,tipomov,admin 
		where movimiento.tipomov_id=tipomov.tipomov_id AND movimiento.admin_id=admin.admin_id";

		if ($fecha_inicio)
			$query.=" AND fecha>='$fecha_inicio' AND fecha<='$fecha_fin 23:59:59' ";

		 $query.=" ORDER BY fecha DESC";

					$results = $database->get_results( $query );

	foreach( $results as $item )
					{
						$vendedor=$item['nombre']." ".$item['apellidop'];
						echo "<tr><td style='text-align:right' width=30 >".$item['movimiento_id']."</td>
						<td style='text-align:center'><a href=/index.php?data=estadisticas&op=ventas&fid=".$item['factura_id'].">".$item['fecha']."</a></td>
							<td style='text-align:center'>".$item['tipomov']."
							<br></td> 
							<td style='text-align:right'>$ ".dinero($item['cantidad']+$item['iva'])."</td>
							<td style='text-align:right'>".$vendedor;
					
						echo "&nbsp;&nbsp;</td></tr>";
										
						$n++;
					}
	

	echo " </tbody>
		</table> ";

		//echo "Pagos Atrazados: ".$pagos_atrazados;
echo "</div>";



}








 ?>