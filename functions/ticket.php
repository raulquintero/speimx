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
								<br><strong>Tiendas Alberto</strong>
								<br>R.F.C QURC750708PM7
								<br>Av. Presa Lopez Zamora #1501 <br>Col. Venustiano Carranzass";
								
				echo "<br>Cliente: ". strtoupper($cliente);
				if ($tipomov_id==3)
					echo "<br>Tipo de Venta: <span class=\"label label-inverse\">Credito</span>";
				else
					echo "<br>"; //Tipo de Venta: <span class=\"label label-inverse\">Contado</span><br><br>";

				echo "<br>Folio: $factura_id [$cliente_id]<br>";
				echo "Fecha y Hora: ".$fecha_factura;    //date("d-m-Y  H:m:s");
				echo "<br>";
				

				echo "</td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";

						//$item = $_SESSION['cart_temp'];
							 
				if ($tipomov_id==3)
							
				{
					$query = "SELECT  facturadet.producto_id,facturadet_id,facturadet.factura_id,facturadet.producto,facturadet.precio_credito,
					facturadet.iva_credito,producto.codigo,facturadet.tipomov_id, color,talla,sku 
					FROM facturadet,producto, factura
					WHERE  facturadet.producto_id=producto.producto_id AND facturadet.factura_id=factura.factura_id AND facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
	
	
					foreach( $results as $item )
					{
 					   switch($item['tipomov_id']){
								case '2':$bgcolor="bgcolor='#FFB8D6' ";
										$textcolor="<font color=gray> ";
									break;
								
								default:$bgcolor="";
										$textcolor="";
									break;

								}
		
						echo "<tr><td>&nbsp;</td><td>".$item['facturadet_id']." ".$item['sku']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br><p class=\"muted\" >"
							.$item['color']." ".$item['talla']."</p></td> 
							<td style='text-align:right;vertical-align:text-top'>";
						if ($tipomov_id==3) echo dinero($item['precio_credito']+($item['precio_credito']*.16)); else echo dinero($item['precio_contado']+($item['precio_contado']*.16));
					
						echo "</td>";
						// if ($item['tipomov_id']==2 || $item['tipomov_id']==3 )
						// 	echo "<td style='text-align:right;vertical-align:text-top'><a href=\"#\" class=\"btn btn-info blue btn-setting\">Devolucion</a></td> ";
						// else
						// 	echo "<td></td>";
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
					//echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;Inclue IVA(16%) por:</td><td style='text-align:right;border-bottom:2px solid;'>".dinero($total_iva_credito)."</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Total</strong></td><td style='text-align:right;'><strong>".dinero($total_iva_credito+$total_credito)."</strong></td></tr>";	
					echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
					
				} 
				else
					if ($cliente_id==0)
					{

						$query = "SELECT  facturadet_id,facturadet.factura_id,facturadet.producto,facturadet.precio_contado,facturadet.iva_contado,producto.codigo,color,talla,sku,tipomov_id FROM facturadet,producto
					WHERE  facturadet.producto_id=producto.producto_id AND facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
	
	
					foreach( $results as $item )
					{
		
						switch($item['tipomov_id']){
								case '2':$bgcolor="bgcolor='' ";
										$textcolor="<font color=gray><s> ";
									break;
								
								default:$bgcolor="";
										$textcolor="";
									break;

								}

						echo "<tr $bgcolor ><td>$textcolor ".$item['tipomov_id']."</td><td>$textcolor ".$item['sku']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br><p class=\"muted\" >"
							.$item['color']." ".$item['talla']."</p></td> 
							<td style='text-align:right;vertical-align:text-top'>$textcolor";
							echo dinero($item['precio_contado']*1.16);
					
						echo "</td>";

						// if ($item['tipomov_id']==2 || $item['tipomov_id']==3 )
						// 	echo "<td></td>";
						// else
						// 	echo "	<td style='text-align:right;vertical-align:text-top'><a href=\"#\" class=\"btn btn-info blue btn-setting\">Devolucion</a></td> ";

						echo "</tr>";
										
						$total_credito+=$item['precio_credito'];
						$total_contado+=$item['precio_contado'];
										
						$n++;
					}
					


						$total_iva_contado=$total_contado*.16;
						echo "<tr>
								<td>&nbsp;</td></tr>
				  			<tr>
				  				<td></td><td style='text-align:right'>Subtotal</td>
							<td style='text-align:right'>$". dinero($total_contado+$total_iva_contado)."</td></tr>";
						// echo "<tr><td></td><td style='text-align:right'>Inclue IVA(16%) por:</td>
						// 	<td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
						echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
							<td style='text-align:right;text-align:right;border-top:2px solid;'><strong>".dinero($total_iva_contado+$total_contado)."</strong></td></tr>";	
									
								
							}


						// echo "<tr><td colspan=4 align=center><br><br><br>_________________________________________";

						
						// if ($cliente_id) echo "<br>Cliente: ". strtoupper($cliente);
						//echo "<br><br><br><br>"; //Tipo de Venta: <span class=\"label label-inverse\">Contado</span><br><br>";


						//echo "</td></tr>";	
					
				echo "</table>";

 // echo "<br><br>array: <br>";
 //     print_r($item_temp);

    						//$_SESSION['cart_temp']=$item_temp;

  // echo "<br><br>session: <br>";
  //     print_r($_SESSION['cart_dev']);


}

function getfactura_temp($fid)
{
$database = new DB();
$_SESSION['cart_temp']=$item;
$fid=substr($fid, 1,7);

	if($fid)
	{
					$query = "SELECT cliente.cliente_id,apellidop, apellidom, nombre, credito, saldo,total_ultimo,fecha_total_ultimo, abono,factura_id,
							tipomov_id,fecha,saldo_actual,saldo_total,ticket  FROM cliente,factura 
						WHERE  factura.cliente_id=cliente.cliente_id AND factura.factura_id=".$fid;
					list( $cliente_id,$apellidop,$apellidom,$nombre,$credito, $saldo, $total_ultimo, $fecha_total_ultimo,$abono, $factura_id,
							 $tipomov_id,$fecha_factura,$saldo_actual,$saldo_total,$ticket  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;
	 }

				//$item = $_SESSION['cart_temp'];
							 
				if ($factura_id)

							
				{
					$_SESSION['fid_dev']=$factura_id; 
					$_SESSION['fdid_tipomov_id']=$tipomov_id; 
					$query = "SELECT  facturadet.producto_id,facturadet_id,facturadet.factura_id,facturadet.producto,facturadet.precio_credito,
					facturadet.iva_credito,facturadet.precio_contado,
					facturadet.iva_contado,producto.codigo,facturadet.tipomov_id, color,talla,sku 
					FROM facturadet,producto, factura
					WHERE  facturadet.producto_id=producto.producto_id AND 
						facturadet.factura_id=factura.factura_id AND 
						facturadet.tipomov_id<>2 AND
						facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					
	
	
					foreach( $results as $item )
					{
 					   	$item_temp[] = array(
                			'facturadet_id'      => $item['facturadet_id'],
                			'tipomov_id'    => $item['tipomov_id']
            				);

                			// 'id'      => $_item['producto_id'],
                			// 'cantidad'     => 1,
                			// 'precio_credito'   => $item['precio_credito'],
                			// 'precio_contado'   => $item['precio_contado'],
                			// 'iva_credito'   => $item['iva_credito'],
                			// 'iva_contado'   => $item['iva_contado'],
                			// 'producto'    => substr($item['producto'],0,26),
                			// 'codigo' => $item['codigo'],
                			// 'sku' => $item['sku'],
                			// 'color'    => $item['color'],
                			// 'talla'    => $item['talla'],
        
		
					}
				}	




    						$_SESSION['cart_temp']=$item_temp;
 //echo $_SESSION['fid_dev'];
   //   print_r($item_temp);
   // echo "<br><br>session: <br>";
   //     print_r($_SESSION['cart_temp']);

      //exit();

}

function ticket_devolucion($fid)
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
								<br><strong>Tiendas Alberto</strong>
								<br>R.F.C QURC750708PM7
								<br>Av. Presa Lopez Zamora #1501 <br>Col. Venustiano Carranza
								<H2>DEVOLUCION</H2>";
								
				echo "Cliente: ". strtoupper($cliente);
				if ($tipomov_id==3)
					echo "<br>Tipo de Venta: <span class=\"label label-inverse\">Credito</span>";
				else
					echo "<br>"; //Tipo de Venta: <span class=\"label label-inverse\">Contado</span><br><br>";

				echo "Folio: $factura_id [$cliente_id]<br>";
				echo "Fecha y Horas : ".$fecha_factura;    //date("d-m-Y  H:m:s");
				echo "<br>";
				

				echo "</td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";

							 
				if ($tipomov_id==3)
							
				{
					
								if (!$_SESSION['cart_temp'])
									echo "<tr><td style='text-align:center'colspan=4><br>
										<img src=/img/empty_cart.jpeg><br><strong>Carrito Vacio</strong><br><br><br></td></tr>";
								else
								{
									$item=$_SESSION['cart_temp'];
								
									$n=0;
									$total=0;
							foreach ($item as $row => $value) 
								{
							switch($item[$n]['tipomov_id']){
								case '2':$bgcolor="bgcolor='#FFB8D6' ";
										$textcolor="<font color=gray> ";
									break;
								case 'X':$bgcolor="bgcolor='#FFE1A1' ";
										$textcolor="<font color=gray> ";
									break;
								default:$bgcolor="";
										$textcolor="";
									break;

								}
										echo "<tr $bgcolor><td>".$item[$n]['facturadet_id']."</td> <td>
											<a href=\"/index.php?data=pos&op=detalles&prid=".$item[$n]['id']."\">".$item[$n]['sku']."<br>". substr($item[$n]['producto'],0,23)."...</a> 
											<br>".strtolower($item[$n]['color'])." ".strtoupper($item[$n]['talla'])."</td> 
											<td style='text-align:right'>";
											if ($cliente_id) echo dinero($item[$n]['precio_credito']+($item[$n]['precio_credito']*.16)); else echo dinero($item[$n]['precio_contado']+($item[$n]['precio_contado']*.16));
											echo "</td><td><a href=\"/functions/cart_dev.php?func=del_item&i=$n\" class=\"\">
											<i class=\"halflings-icon trash\"></i></a>".$item[$n]['tipomov_id']."</td></tr>";
										
										$total_credito+=$item[$n]['precio_credito'];
										$total_contado+=$item[$n]['precio_contado'];
										
										$n++;

									}


									
								}
							
				}	

							//		$item_temp=$_SESSION['cart_temp'];
								
									$n=0;
									$total=0;
									// foreach ($item_temp as $row => $value) 
									// {
									// 	echo "<tr><td>".$item_temp[$n]['facturadet_id']."</td> <td>
									// 		<a href=\"/index.php?data=pos&op=detalles&prid=".$item_temp[$n]['id']."\">
									// 		".$item_temp[$n]['sku']."<br>". substr($item_temp[$n]['producto'],0,23)."...</a> 
									// 		<br>".strtolower($item_temp[$n]['color'])." ".strtoupper($item_temp[$n]['talla'])."</td> 
									// 		<td style='text-align:right'>";
									// 		if ($cliente_id) echo dinero($item_temp[$n]['precio_credito']+($item_temp[$n]['precio_credito']*.16)); 
									// 		else echo dinero($item_temp[$n]['precio_contado']+($item_temp[$n]['precio_contado']*.16));
									// 		echo "</td><td>".$item_temp[$n]['tipomov_id']."</td></tr>";
										
									// 	$total_credito+=$item_temp[$n]['precio_credito'];
									// 	$total_contado+=$item_temp[$n]['precio_contado'];
										
									// 	$n++;

									// }

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

						$query = "SELECT  facturadet_id,facturadet.factura_id,facturadet.producto,facturadet.precio_contado,facturadet.iva_contado,producto.codigo,color,talla,sku FROM facturadet,producto
					WHERE  facturadet.producto_id=producto.producto_id AND facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
					
					$item_temp=$_SESSION['cart_temp'];
	
					foreach ($item_temp as $row => $value)
					{
						switch($item_temp[$n]['tipomov_id']){
								case '2':$bgcolor="bgcolor='#FFB8D6' ";
										$textcolor="<font color=gray> ";
									break;
								case 'X':$bgcolor="bgcolor='#FFE1A1' ";
										$textcolor="<font color=gray> ";
									break;
								default:$bgcolor="";
										$textcolor="";
									break;

								}

						$query = "SELECT  facturadet_id,producto,precio_contado,iva_contado,precio_credito,iva_credito,codigo,color,talla,sku 
						FROM facturadet
						WHERE  facturadet_id=".$item_temp[$n]['facturadet_id'];
						list( $faturadet_id,$producto,$precio_contado,$iva_contado,$precio_credito,$iva_credito,$codigo,$color,$talla,$sku  ) = $database->get_row( $query );
		
						echo "<tr $bgcolor><td>".$item_temp[$n]['facturadet_id']."</td><td> $textcolor".$sku."<br>
							". substr($producto,0,26)."...</a>
							<br><p class=\"muted\" >"
							.$color." ".$talla."</p></td> 
							<td style='text-align:right;vertical-align:text-top'>";
							echo dinero($precio_contado*1.16);
					
						echo "</td><td><a href=\"/functions/cart_dev.php?func=del_dev_item&facturadet_id=".$item_temp[$n]['facturadet_id']."\" class=\"\">
											<i class=\"halflings-icon trash\"></i></a>".$item_temp[$n]['tipomov_id']."</td>";
						// if ($item['tipomov_id']==2 || $item['tipomov_id']==3 )
						// 	echo "<td></td>";
						// else
						// 	echo "	<td style='text-align:right;vertical-align:text-top'><a href=\"#\" class=\"btn btn-info blue btn-setting\">Devolucion</a></td> ";

						echo "</tr>";
										
						if ($item_temp[$n]['tipomov_id']=="X"){
							$total_credito+=$precio_credito;
							$total_contado+=$precio_contado;
							
						}				
										
						$n++;
					}
					


						$total_iva_contado=$total_contado*.16;
						echo "<tr>
								<td>&nbsp;</td></tr>
				  			<tr>
				  				<td></td><td style='text-align:right'>Subtotal</td>
							<td style='text-align:right'>$". dinero($total_contado+$total_iva_contado)."</td></tr>";
						// echo "<tr><td></td><td style='text-align:right'>Inclue IVA(16%) por:</td>
						// 	<td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
						echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
							<td style='text-align:right;text-align:right;border-top:2px solid;'><strong>".dinero($total_iva_contado+$total_contado)."</strong></td></tr>";	
									
								
							}

				echo "</table>";
					echo "<div class=\"form-actions\">";
						echo "<a href=\"#\" class=\"btn btn-info blue btn-setting\">Hacer Devolucion</a>";
						echo "</div>";


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