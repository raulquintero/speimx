<?php
function getfactura($fid)
{
$database = new DB();

	if($fid)
	{
					$query = "SELECT cliente.cliente_id,apellidop, apellidom, nombre, credito, saldo,total_ultimo,fecha_total_ultimo, abono,factura_id,
							tipomov_id,fecha,saldo_actual,saldo_total,ticket  FROM cliente,factura 
						WHERE  factura.cliente_id=cliente.cliente_id AND factura.factura_id=".$fid;
					list( $cliente_id,$apellidop,$apellidom,$nombre,$credito, $saldo, $total_ultimo, $fecha_total_ultimo,$abono, $factura_id,
							 $tipomov_id,$fecha_factura,$saldo_actual,$saldo_total,$ticket  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;
	 }

				echo "<table   width=100%>
						<tr>
							<td style='text-align:center;border-bottom:1px dotted black' colspan=4>
								<br><strong>Tienda de Ropa Alberto's</strong>
								<br>R.F.C QURC750708PM7
								<br>Av. Presa Lopez Zamora #1501 <br>Col. Venustiano Carranza<br>
								<br>";
								
				echo "Cliente: ". strtoupper($cliente)."<br>";
				if ($tipomov_id==3)
					echo "Tipo de Venta: <span class=\"label label-inverse\">Credito</span><br>";
				else
					echo "<br>"; //Tipo de Venta: <span class=\"label label-inverse\">Contado</span><br><br>";

				echo "Folio: $factura_id [$cliente_id]<br>";
				echo "Fecha y Hora: ".$fecha_factura;    //date("d-m-Y  H:m:s");
				echo "<br>";
				

				echo "</td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";

							 
				if ($tipomov_id==3)
							
				{
					$query = "SELECT  facturadet.facturadet_id,facturadet.factura_id,facturadet.producto,facturadet.precio_credito,facturadet.iva_credito,producto.codigo,tipomov_id, color,talla 
					FROM facturadet,producto, factura
					WHERE  facturadet.producto_id=producto.producto_id AND facturadet.factura_id=factura.factura_id AND facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
	
	
					foreach( $results as $item )
					{
		
						echo "<tr><td>&nbsp;</td><td>".$item['facturadet_id']." ".$item['codigo']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br><p class=\"muted\" >"
							.$item['color']." ".$item['talla']."</p></td> 
							<td style='text-align:right;vertical-align:text-top'>";
						if ($tipomov_id==3) echo dinero($item['precio_credito']+($item['precio_credito']*.16)); else echo dinero($item['precio_contado']+($item['precio_contado']*.16));
					
						echo "</td>";
						if ($item['tipomov_id']==2 )
							echo "<td></td>";
						else
							echo "<td style='text-align:right;vertical-align:text-top'><a href=\"#\" class=\"btn btn-info blue btn-setting\">Devolucion</a></td> ";
						echo"</tr>";
										
						$total_credito+=$item['precio_credito'];
						$total_contado+=$item['precio_contado'];
										
						$n++;
					}
				}	


				if ($total_credito AND $cliente_id>0)
				{
					$total_iva_credito=$total_credito*.16;
					$disponible=$credito-$saldo-$total_credito-$total_iva_credito;

					//$saldo_total=$saldo+$total_credito+$total_iva_credito;



					echo "<tr style=\"border-top:1px dotted black\"><td>&nbsp;</td><td style='text-align:right'>SubTotal</td>
					      	  <td style='text-align:right;boarder-top:2px solid;'>$". dinero($total_credito+$total_iva_credito)."</td></tr>";
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;Inclue IVA(16%) por:</td><td style='text-align:right;border-bottom:2px solid;'>".dinero($total_iva_credito)."</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Total</strong></td><td style='text-align:right;'><strong>".dinero($total_iva_credito+$total_credito)."</strong></td></tr>";	
					echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
					
				} 
				else
					if ($cliente_id==0)
					{

						$query = "SELECT  facturadet.factura_id,facturadet.producto,facturadet.precio_contado,facturadet.iva_contado,producto.codigo,color,talla FROM facturadet,producto
					WHERE  facturadet.producto_id=producto.producto_id AND facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
	
	
					foreach( $results as $item )
					{
		
						echo "<tr><td>&nbsp;</td><td>".$item['facturadet_id']." ".$item['codigo']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br><p class=\"muted\" >"
							.$item['color']." ".$item['talla']."</p></td> 
							<td style='text-align:right;vertical-align:text-top'>";
							echo dinero($item['precio_contado']);
					
						echo "</td></tr>";
										
						$total_credito+=$item['precio_credito'];
						$total_contado+=$item['precio_contado'];
										
						$n++;
					}
					


						$total_iva_contado=$total_contado*.16;
						echo "<tr>
								<td></td><td>&nbsp;</td></tr>
				  			<tr>
				  				<td></td><td stsyle='text-align:right'>Subtotal</td>
							<td style='text-align:right'>$". dinero($total_contado+$total_iva_contado)."</td></tr>";
						echo "<tr><td></td><td style='text-align:right'>Inclue IVA(16%) por:</td>
							<td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
						echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
							<td style='text-align:right;text-align:right;border-top:2px solid;'><strong>".dinero($total_iva_contado+$total_contado)."</strong></td></tr>";	
									

									
									}
					
				echo "</table>";



}





function view_devoluciones($fid)
{
$database = new DB();

			$fecha=fechaplusweek($fecha);

	$total_pagos=ceil($total/$abono);


	echo "
					<div class=\"box-header\">
						<h2><i class=\"halflings-icon align-justify\"></i><span class=\"break\"></span>Devoluciones</h2>
						<div class=\"box-icon\">
							<a href=\"#\" class=\"btn-setting\"><i class=\"halflings-icon wrench\"></i></a>
							<a href=\"#\" class=\"btn-minimize\"><i class=\"halflings-icon chevron-up\"></i></a>
							<a href=\"#\" class=\"btn-close\"><i class=\"halflings-icon remove\"></i></a>
						</div>
					</div>
					<div>
						<table class=\"table table-condensed striped\">
							  <thead>
								  <tr>
									  <th>Ref</th>
									  <th>Producto</th>
									  <th>Saldo</th>
									  <th>Precio</th>
									  <th></th>                                          
								  </tr>
							  </thead>   
							  <tbody>";


			$query = "SELECT facturadet.producto,facturadet.precio_credito,facturadet.iva_credito,facturadet.precio_contado,facturadet.iva_contado,facturadet.codigo,color,talla,key1 FROM facturadet,producto,movimiento
				WHERE  facturadet.producto_id=producto.producto_id AND facturadet.factura_id=movimiento.factura_id AND movimiento.tipomov_id=2 AND movimiento.tipomov_id=2 AND facturadet.factura_id=".$fid;

			$results = $database->get_results( $query );
								
			$n=0;
			$total=0;
	
			foreach( $results as $item )
			{
	
			echo "<tr ><td>".$item['key1']."</td><td align=right> ".fechamysqltous(fechaplusweek($item['fecha']),1)."</td><td align=right>".$item['producto']."</td>
			<td class=\"right\">".dinero($item['precio_credito']+$item['iva_credito'])."</td><td align=right><font color=gray> ".dinero($ultimo)."&nbsp;</td></tr>";

			}

		echo " </tbody>
		</table> ";
echo "</div>";

}

?>