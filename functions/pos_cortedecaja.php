<?php

function mostrar_transacciones($fecha_inicio,$fecha_fin,$user)
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
									  <th style='text-align:center'>Cliente</th>
								  </tr>
							  </thead>
							  <tbody>";

$fecha_inicio_bd=fechaustomysql($fecha_inicio);
$fecha_fin_bd=fechaustomysql($fecha_fin);
	$query = "SELECT  * from movimiento,tipomov,admin,cliente
		where movimiento.tipomov_id=tipomov.tipomov_id AND movimiento.admin_id=admin.admin_id  AND (movimiento.tipomov_id=1 OR movimiento.tipomov_id=13 or movimiento.tipomov_id=14)
         AND movimiento.cliente_id=cliente.cliente_id AND cliente.empresa_id=0";

		if ($fecha_inicio)
			$query.=" AND fecha>='$fecha_inicio_bd' AND fecha<='$fecha_fin_bd 23:59:59' ";

		if ($user)
			$query.=" AND movimiento.admin_id=$user ";

		  $query.=" ORDER BY fecha DESC";

					$results = $database->get_results( $query );

	foreach( $results as $item )
					{
						$vendedor=$item['nombre']." ".$item['apellidop'];
						echo "<tr><td style='text-align:right' width=30 >".$item['movimiento_id']."</td>
						<td style='text-align:center'><span class='hidden-desktop'>".$item['fecha']."</span><a class='hidden-print' href=/index.php?data=estadisticas&op=ventas&fi=$fecha_inicio&hi=$hi&ff=".$fecha_fin."&hf=$hf&fid=".$item['factura_id'].">".$item['fecha']."</a></td>
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