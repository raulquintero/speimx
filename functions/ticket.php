<?php
function getdevolucion($fid)
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
							<td style='text-align:center;border-bottom:1px dotted black' colspan=3>
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
					$query = "SELECT  facturadet.factura_id,facturadet.producto,facturadet.precio_credito,facturadet.iva_credito,producto.codigo,color,talla FROM facturadet,producto
					WHERE  facturadet.producto_id=producto.producto_id AND facturadet.tipomov_id<>2 AND facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
	
	
					foreach( $results as $item )
					{
		
						echo "<tr><td>&nbsp;</td><td>".$item['factura_id']." ".$item['codigo']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br><p class=\"muted\" >"
							.$item['color']." ".$item['talla']."</p></td> 
							<td style='text-align:right;vertical-align:text-top'>";
						if ($tipomov_id==3) echo dinero($item['precio_credito']); else echo dinero($item['precio_contado']);
					
						echo "</td></tr>";
										
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
					      	  <td style='text-align:right;boarder-top:2px solid;'>$". dinero($total_credito)."</td></tr>";
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;IVA(16%)</td><td style='text-align:right;border-bottom:2px solid;'>+&nbsp;".dinero($total_iva_credito)."</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Total</strong></td><td style='text-align:right;'><strong>".dinero($total_iva_credito+$total_credito)."</strong></td></tr>";	
					echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>Saldo Actual</td><td style='text-align:right'>+  $ ".dinero($saldo_actual)."</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right;'><strong>Saldo Total</strong></td><td style='text-align:right;border-top:2px solid;'><strong>$ ".dinero($saldo_total)."</strong></td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>Abono</td>";

					$query = "SELECT abono,limite FROM abono ORDER BY limite ASC";
					$results = $database->get_results( $query );
					foreach ($results as $row ) 
					{
							//echo $total_credito." ".$row['limite']." <br> ";
						if ($saldo_total<=$row['limite'])
						{
							$abono=$row['abono'];
							break;
						}
					}

					echo "<td style='text-align:right;border-top:2px solid;'>$". dinero($abono)."</td>";
					echo "</tr>";
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
		
						echo "<tr><td>&nbsp;</td><td>".$item['factura_id']." ".$item['codigo']."<br>
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
							<td style='text-align:right'>$". dinero($total_contado)."</td></tr>";
						echo "<tr><td></td><td style='text-align:right'>IVA(16%)</td>
							<td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
						echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
							<td style='text-align:right;text-align:right;border-top:2px solid;'><strong>".dinero($total_iva_contado+$total_contado)."</strong></td></tr>";	
									

									
									}
					
				echo "</table>";



}

?>