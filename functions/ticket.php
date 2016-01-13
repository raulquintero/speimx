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

				echo "<table width=100%>
						<tr>
							<td style='text-align:center;border-bottom:1px dotted black' colspan=4>
								<br>
								<a href=\"/index.php\"><img width=300 src=/img/tiendasalberto.png></a>

								<br>R.F.C QURC750708PM7
								<br>Av. Presa Lopez Zamora #1501 <br>Col. Venustiano Carranzass";

				echo "<br>Cliente: ". strtoupper($cliente);
				if ($tipomov_id==3)
					echo "<br>Tipo de Venta: <span class=\"label label-inverse\">Credito</span>";
				else
					echo "<br>"; //Tipo de Venta: <span class=\"label label-inverse\">Contado</span><br><br>";
				
				$no_ticket=sprintf('%06d', $factura_id);

				echo "<br>Folio: $no_ticket [$cliente_id]<br>";
				echo "Fecha y Hora: ".$fecha_factura;    //date("d-m-Y  H:m:s");
				echo "<br>";
				

				echo "</td></tr>";
			    echo "<tr><td width=30>&nbsp;</td><td>&nbsp;</td><td width=120>&nbsp;</td></tr>";

						//$item = $_SESSION['cart_temp'];
							 
				if ($tipomov_id==3)
							
				{
					$query = "SELECT  facturadet.producto_id,facturadet_id,facturadet.factura_id,facturadet.producto,facturadet.precio_credito,
					facturadet.iva_credito,
                    facturadet.precio_venta,facturadet.iva,facturadet.percio_promocion,facturadet.descuento,
                    producto.codigo,facturadet.tipomov_id, color,talla,sku
					FROM facturadet,producto, factura
					WHERE  facturadet.producto_id=producto.producto_id AND facturadet.factura_id=factura.factura_id AND facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
					

	
					foreach( $results as $item )
					{
 					   switch($item['tipomov_id']){
								case '2':$bgcolor="bgcolor='#FFB8D6' ";
										$textcolor="<font color=gray><s> ";
									break;
								
								default:$bgcolor="";
										$textcolor="";
									break;

								}
		
						echo "<tr $bgcolor ><td>".$item['facturadet_id']."</td><td>$textcolor".$item['sku']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br>"
							.$item['color']." ".$item['talla']."</td> 
							<td style='text-align:right;vertical-align:text-top'>";
						if ($tipomov_id==3) echo dinero($item['precio_credito']+($item['precio_credito']*.16)); else echo dinero($item['precio_contado']+($item['precio_contado']*.16));
					
						echo "</s>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
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



					echo "<tr style=\"border-top:1px dotted black\"><td >&nbsp;</td><td style='text-align:right'>SubTotal</td>
					      	  <td style='text-align:right;boarder-top:2px solid;'>$". dinero($total_credito+$total_iva_credito)."&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
					//echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;Inclue IVA(16%) por:</td><td style='text-align:right;border-bottom:2px solid;'>".dinero($total_iva_credito)."</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Total</strong></td><td style='text-align:right;'><strong>".dinero($total_iva_credito+$total_credito)."</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";	
					echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
					
				} 
				else
					if ($cliente_id==0)
					{

						$query = "SELECT  facturadet_id,facturadet.factura_id,facturadet.producto,facturadet.precio_contado,facturadet.iva_contado,precio_venta,facturadet.iva,facturadet.descuento,facturadet.precio_promocion,producto.codigo,color,talla,sku,tipomov_id
                        FROM facturadet,producto
					WHERE  facturadet.producto_id=producto.producto_id AND facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
	
	
					foreach( $results as $item )
					{
		
						switch($item['tipomov_id']){
								case '2':$bgcolor="bgcolor='#FFB8D6' ";
										$textcolor="<font color=gray><s> ";
									break;
								
								default:$bgcolor="";
										$textcolor="";
									break;

								}

						echo "<tr $bgcolor ><td>$textcolor ".$item['facturadet_id']."</td><td>$textcolor ".$item['sku']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br>"
							.$item['color']." ".$item['talla']."</td> 
							<td style='text-align:right;vertical-align:text-top'>$textcolor";
							echo "(-".$item['descuento']."%) <s>".dinero($item['precio_contado']*1.16)."</s>&nbsp;&nbsp;&nbsp;&nbsp<br>";
					        echo dinero($item['precio_venta']);
						echo "&nbsp;&nbsp;&nbsp;&nbsp;</td>";

						// if ($item['tipomov_id']==2 || $item['tipomov_id']==3 )
						// 	echo "<td></td>";
						// else
						// 	echo "	<td style='text-align:right;vertical-align:text-top'><a href=\"#\" class=\"btn btn-info blue btn-setting\">Devolucion</a></td> ";

						echo "</tr>";
										
						$total_credito+=$item['precio_credito'];
						$total_contado+=$item['precio_venta'];
										
						$n++;
					}
					


						$total_iva_contado=$total_contado*.16;
						echo "<tr>
								<td>&nbsp;</td></tr>
				  			<tr>
				  				<td></td><td style='text-align:right'>Subtotal</td>
							<td style='text-align:right'>$". dinero($total_contado)."&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
						// echo "<tr><td></td><td style='text-align:right'>Inclue IVA(16%) por:</td>
						// 	<td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
						echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
							<td style='text-align:right;text-align:right;border-top:2px solid;'><strong>".dinero($total_contado)."&nbsp;&nbsp;&nbsp;&nbsp;</strong></td></tr>";
									
								
							}


						// echo "<tr><td colspan=4 align=center><br><br><br>_________________________________________";

						
						// if ($cliente_id) echo "<br>Cliente: ". strtoupper($cliente);
						//echo "<br><br><br><br>"; //Tipo de Venta: <span class=\"label label-inverse\">Contado</span><br><br>";


						//echo "</td></tr>";	
					
				echo "</table>";

 // echo "<br><br>array: <br>";
 //     print_r($item_temp);

    						//$_SESSION['cart_temp']=$item_temp;

   //echo "<br><br>session: <br>";
      // print_r($_SESSION['cart_dev']);


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
					$_SESSION['dev_cliente_id']=$cliente_id;
					$_SESSION['fid_dev']=$factura_id;
					$_SESSION['fdid_tipomov_id']=$tipomov_id; 
					$query = "SELECT  facturadet.producto_id,facturadet_id,facturadet.factura_id,facturadet.producto,facturadet.precio_credito,
					facturadet.iva_credito,facturadet.precio_contado,facturadet.iva_contado,
                    facturadet.precio_venta,facturadet.iva,
                    facturadet.precio_promocion,facturadet.descuento,
                    producto.codigo,facturadet.tipomov_id, color,talla,sku
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
                			'code' => $item['sku'],
                			'producto'    => substr($item['producto'],0,26),
                			'precio_credito'   => $item['precio_credito'],
                			'precio_contado'   => $item['precio_contado'],
                             'id'      => $_item['producto_id'],
                			 'cantidad'     => 1,
                			'codigo' => $item['codigo'],
                			 'sku' => $item['sku'],
                			'iva_credito'   => $item['iva_credito'],
                			'iva_contado'   => $item['iva_contado'],
                            'precio_venta'   => $item['precio_venta'],
                            'iva'   => $item['iva'],
                            'precio_promocion'   => $item['precio_promcion'],
                            'descuento'   => $item['descuento'],

                			'color'    => $item['color'],
                			'talla'    => $item['talla'],
                			'tipomov_id'    => $item['tipomov_id']
            				);

                			// 'id'      => $_item['producto_id'],
                			// 'cantidad'     => 1,
                			//'codigo' => $item['codigo'],
                			// 'sku' => $item['sku'],
        
		
					}
				}	




    						$_SESSION['cart_temp']=$item_temp;
  //echo $_SESSION['fid_dev'];
      //print_r($item_temp);
    //echo "<br><br>session: <br>";
      // print_r($_SESSION['cart_temp']);

      // exit();

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
							<td style='text-align:center;border-bottom:0px dotted black' colspan=4>
								<H2>DEVOLUCION</H2>";
								
//				echo "Cliente: ". strtoupper($cliente);
				if ($tipomov_id==3)
					echo "Tipo de Venta: <span class=\"label label-inverse\">Credito</span>";
				else
					echo "<br>"; //Tipo de Venta: <span class=\"label label-inverse\">Contado</span><br><br>";

				//echo "Folio: $factura_id [$cliente_id]";
				

				echo "</td></tr>";
				//echo "<tr><td>&nbsp;</td></tr>";


$cliente_id = $_SESSION['dev_cliente_id'];
			//$saldo = $_SESSION['dev_saldo'];
								$cuantos=get_cuantosdev();



				echo "</table>";	


									$item=$_SESSION['cart_temp'];
									$items = count($item);
									$n=$items-1;
									$total=0;
									foreach ($item as $row => $value) 
									{
										if($item[$n]['tipomov_id']=="X")
										{
										$total_credito+=$item[$n]['precio_credito'];
										$total_contado+=$item[$n]['precio_venta'];
										}
										$n--;

									}
				echo "<table width=100% style='border:1px dotted black;background:#cccccc;'>";
					if ($cliente_id)
							{
								$total_iva_credito=$total_credito*.16;

								$disponible=$credito-$saldo-$total_credito-$total_iva_credito;

								$saldo_total=$saldo+$total_credito+$total_iva_credito;


								// echo "<tr><td colspan=4 style=\"border-bottom:1px dotted black\">&nbsp;</td></tr><tr><td></td><td style='text-align:right'>Total</td><td style='text-align:right;boarder-top:2px solid;'>$". dinero($total_credito+$total_iva_credito)."</td></tr>";
								// echo "<tr><td></td><td style='text-align:right'>&nbsp;Incluye IVA(16%) por</td><td style='text-align:right;border-bottom:2px solid;'>".dinero($total_iva_credito)."</td></tr>";	
								echo "<tr><td style='text-align:center;'>ITEMS</td><td style='text-align:right'>&nbsp;<font size=+1>Total</font></td>
								<td  style='text-align:right;background:white;color:black'><font size=+1><b>$ ".dinero($total_credito)."</strong></td></tr>";
								echo "<tr><td style='text-align:center'>$cuantos&nbsp;</td></tr>";
								echo "<tr><td></td><td style='text-align:right'>Saldo Actual</td><td style='text-align:right'> &nbsp;&nbsp; $ ";
									echo dinero($saldo);
								echo "</td></tr>";
								$cupon=dinero($total_iva_credito+$total_credito-$saldo);//-$total_iva_credito-$total_credito);
								$saldoafavor=($total_iva_credito+$total_credito);
								if ($cupon>0)
									echo "<tr><td></td><td style='text-align:right'>Nota de Venta</td><td style='text-align:right;background:yellow;color:black'><b>$". dinero($cupon)."</b></td></tr>";
								else
								{
									echo "<tr><td></td><td style='text-align:right'>Saldo a Favor</td><td style='text-align:right;'>$". dinero($saldoafavor)."</td></tr>";
									echo "<tr><td></td><td style='text-align:right'>Saldo Nuevo</td><td style='text-align:right;border-top:2px solid black'>$". dinero($saldo-$saldoafavor)."</td></tr>";

								}




							}
							else
							{
								if ($total_contado)
									{
								$total_iva_contado=$total_contado*.16;
									// echo "<tr><td>&nbsp;</td></tr><tr><td></td><td style='text-align:right'>Subtotal</td><td style='text-align:right'>$". dinero($total_contado+$total_iva_contado)."</td></tr>";
									// echo "<tr><td></td><td style='text-align:right'>Incluye IVA(16%) por</td><td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
									echo "<tr><td></td><td style='text-align:right'>&nbsp;<font size=+2>Total</font></td>
											<td width=220 style='text-align:right;text-align:right;background:white;color:black;border:2px solid;'>
											<font size=+3><b>$ ".dinero($total_contado)."</b></font></td></tr>";

									}

							}
								echo "</table>";






								echo "<table width=100%>";
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
								switch($item[$n]['tipomov_id'])
								{
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
								
								if($item[$n]['tipomov_id']=="X")
								{

									$query = "SELECT  facturadet_id,producto,precio_contado,iva_contado,precio_credito,iva_credito,codigo,color,talla,sku 
										FROM facturadet
										WHERE  facturadet_id=".$item[$n]['facturadet_id'];
										list( $faturadet_id,$producto,$precio_contado,$iva_contado,$precio_credito,
												$iva_credito,$codigo,$color,$talla,$sku  ) = $database->get_row( $query );
		
										echo "<tr $bgcolor><td>".$item[$n]['facturadet_id']."</td> <td>
											<a href=\"/index.php?data=pos&op=detalles&prid=".$item['id']."\">".$sku."<br>". substr($producto,0,23)."...</a> 
											<br>".strtolower($color)." ".strtoupper($talla)."</td> 
											<td style='text-align:right'>";
											if ($cliente_id) echo dinero($precio_credito+$iva_credito); else echo dinero($precio_contado+$iva_contado);
											echo "</td><td><a href=\"/functions/cart_dev.php?func=del_dev_item&facturadet_id=".$item[$n]['facturadet_id']."\" class=\"\">
											<i class=\"halflings-icon trash\"></i></a>".$item[$n]['tipomov_id']."</td></tr>";
									if($item[$n]['tipomov_id']=="X"){
										$total_credito+=$precio_credito+$iva_credito;
										$total_contado+=$precio_contado+$iva_contado;
										}
								}
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

				// if ($cliente_id>0)
				// {
				// 	//$total_iva_credito=$total_credito+$iva_credito;
				// 	//$disponible=$credito-$saldo-$total_credito-$total_iva_credito;

				// 	//$saldo_total=$saldo+$total_credito+$total_iva_credito;



				// 	echo "<tr style=\"border-top:1px dotted black\"><td>&nbsp;</td><td style='text-align:right'>SubTotal</td>
				// 	      	  <td style='text-align:right;boarder-top:2px solid;'>$". dinero($total_credito+$total_iva_credito)."</td></tr>";
				// 	//echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;Inclue IVA(16%) por:</td><td style='text-align:right;border-bottom:2px solid;'>".dinero($total_iva_credito)."</td></tr>";	
				// 	echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Total</strong></td><td style='text-align:right;'><strong>".dinero($total_iva_credito+$total_credito)."</strong></td></tr>";	
				// 	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
					
				// } 
				// else 
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
						switch($item_temp[$n]['tipomov_id'])
						{
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
					if($item_temp[$n]['tipomov_id']=="X")
					{

						$query = "SELECT  facturadet_id,producto,precio_contado,iva_contado,precio_credito,iva_credito,codigo,color,talla,sku,precio_venta,iva,precio_promocion,descuento
						FROM facturadet
						WHERE  facturadet_id=".$item_temp[$n]['facturadet_id'];
						list( $faturadet_id,$producto,$precio_contado,$iva_contado,$precio_credito,$iva_credito,$codigo,$color,$talla,$sku,$precio_venta,$iva,$precio_promocion,$descuento  ) = $database->get_row( $query );
		
						echo "<tr $bgcolor><td>".$item_temp[$n]['facturadet_id']."</td><td> $textcolor".$sku."<br>
							". substr($producto,0,26)."...</a>
							<br><p class=\"muted\" >"
							.$color." ".$talla."</p></td> 
							<td style='text-align:right;vertical-align:text-top'>";
                            if ($descuento)
                            {
                                echo "(-".$descuento."%) &nbsp;<s>".dinero($precio_contado*1.16)."</s><br>";
                                echo dinero($precio_venta);
					         }
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
										
					}

					$n++;
			}
					


						$total_iva_contado=$total_contado*.16;
						// echo "<tr>
						// 		<td>&nbsp;</td></tr>
				  // 			<tr>
				  // 				<td></td><td style='text-align:right'>Subtotal</td>
						// 	<td style='text-align:right'>$". dinero($total_contado+$total_iva_contado)."</td></tr>";
						// echo "<tr><td></td><td style='text-align:right'>Incluye IVA(16%) por:</td>
						// 	<td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
						// echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
						// 	<td style='text-align:right;text-align:right;border-top:2px solid;'>
						// 	<strong>".dinero($total_iva_contado+$total_contado)."</strong></td></tr>";	
									
								
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

   if ($abono)	$total_pagos=ceil($total/$abono);


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
									  <th>sku</th>
									  <th>Precio</th>
									  <th></th>                                          
								  </tr>
							  </thead>   
							  <tbody>";


	$query = "SELECT total,fecha,devoluciondet.facturadet_id,facturadet.sku,precio_credito,iva_credito,precio_contado,iva_contado FROM devolucion,devoluciondet,facturadet
				WHERE  devolucion.devolucion_id=devoluciondet.devolucion_id AND devoluciondet.facturadet_id=facturadet.facturadet_id AND devolucion.factura_id=".$fid;

	$results = $database->get_results( $query );
								
	$n=0;
	$total=0;
	
	foreach( $results as $item )
	{
	
			echo "<tr ><td>".$item['facturadet_id']."</td><td align=right> ".fechamysqltous(fechaplusweek($item['fecha']),1)."</td><td align=right>".$item['sku']."</td>
			<td class=\"right\">".dinero($item['precio_credito']+$item['iva_credito'])."</td><td align=right><font color=gray> ".dinero($ultimo)."&nbsp;</td></tr>";

	}

	echo " </tbody>
		</table> ";
	echo "</div>";

}


function get_fiddev($code)
{


$item = $_SESSION['cart_temp'];
    //$fdid=$_GET['facturadet_id'];

echo "<br>".$code;
        $n=0;
        foreach ($item as $row => $value) 
        {

                       echo "<br>code: ".$item[$n]['code'];	

            if ($item[$n]['code']==intval($code))
                {

                            echo "<br>tipomov_id: ".$item[$n]['tipomov_id'];

                        if ($item[$n]['tipomov_id']=='14')
                        {
                            $fdet=$item[$n]['facturadet_id'];
                        }
                        if ($item[$n]['tipomov_id']=='3')
                        {
                            $fdet=$item[$n]['facturadet_id'];
                        }
                        

                        if ($item[$n]['tipomov_id']=='0')
                        {
                            $fdet=$item[$n]['facturadet_id'];
                            //echo "<br>[0] ".$fdet." " .$item[$n]['tipomov_id'];
                        }
                        

                }
            $n+=1;
        }
echo "<br><br>fdet: ".$fdet;
echo "<br>items: ".$n."<br>";
     print_r($item);
//exit();
return $fdet;
}




function get_cuantosdev()
{

$k=$cuantos=0;
$item=$_SESSION['cart_temp'];

 foreach ($item as $row => $value) 
  	{
  	
	if ( $item[$k]['tipomov_id']=="X")
		$cuantos++;
	$k++;
	}
return $cuantos;

}



function get_devolucion($did)
{
$database = new DB();

	if($did)
	{
					$query = "SELECT cliente.cliente_id,apellidop, apellidom, nombre, credito, cliente.saldo,total_ultimo,fecha_total_ultimo, abono,factura_id,
							tipomov_id,fecha,total,saldo_anterior FROM cliente,devolucion 
						WHERE  devolucion.cliente_id=cliente.cliente_id AND devolucion.devolucion_id=".$did;
					list( $cliente_id,$apellidop,$apellidom,$nombre,$credito, $saldo, $total_ultimo, $fecha_total_ultimo,$abono, $factura_id,
							 $tipomov_id,$fecha_factura,$total,$saldo_anterior  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;
	 }

				echo "<table   width=100%>
						<tr>
							<td style='text-align:center;border-bottom:1px dotted black' colspan=4>
								<br><strong>DEVOLUCION</strong>";
								
				 echo "<br>Transaccion: <span class=\"label label-inverse\">$did</span>";
				

				echo "<br>Fecha y Hora: ".$fecha_factura;    //date("d-m-Y  H:m:s");
				echo "<br>";
				
				
				echo "</td></tr>";
				echo "<tr><td width=30>&nbsp;</td><td>&nbsp;</td><td width=90>&nbsp;</td></tr>";

						//$item = $_SESSION['cart_temp'];
							 
				if ($tipomov_id==3)
							
				{
					$query= "SELECT saldo_anterior from devolucion where devolucion_id=$did";
					list( $saldo_nuevo ) = $database->get_row( $query );
					$query = "SELECT  facturadet.producto_id,facturadet.facturadet_id,facturadet.factura_id,facturadet.producto,facturadet.precio_credito,
					facturadet.iva_credito,
                    facturadet.precio_venta,facturadet.iva,facturadet.precio_promocion,facturadet.descuento,
                    facturadet.tipomov_id, color,talla,facturadet.sku
					FROM facturadet,devoluciondet, devolucion
					WHERE  devoluciondet.facturadet_id=facturadet.facturadet_id AND devoluciondet.devolucion_id=devolucion.devolucion_id AND devolucion.devolucion_id=".$did;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
					

	
					foreach( $results as $item )
					{
 					   switch($item['tipomov_id']){
								case '2':$bgcolor="bgcolor='#FFB8D6' ";
										$textcolor="<font color=gray><s> ";
									break;
								
								default:$bgcolor="";
										$textcolor="";
									break;

								}
		
						echo "<tr $bgcolor ><td>".$item['facturadet_id']."</td><td>$textcolor".$item['sku']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br>"
							.$item['color']." ".$item['talla']."</td> 
							<td style='text-align:right;vertical-align:text-top'>";
						if ($tipomov_id==3) echo dinero($item['precio_credito']+($item['precio_credito']*.16)); 
							else
                            {
                                 echo "(-".$item['descuento']."%) &nbsp;<s>".dinero($item['precio_contado']+($item['precio_contado']*.16))."</s>&nbsp;&nbsp;&nbsp;&nbsp;<br>";
                                 echo dinero($item['precio_venta']);
					        }

						echo "&nbsp;&nbsp;&nbsp;&nbsp;</td>";
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



					//echo "<tr style=\"border-top:1px dotted black\"><td >&nbsp;</td><td style='text-align:right'>SubTotal</td>
					  //    	  <td style='text-align:right;boarder-top:2px solid;'>$". dinero($total_credito+$total_iva_credito)."&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
					//echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;Inclue IVA(16%) por:</td><td style='text-align:right;border-bottom:2px solid;'>".dinero($total_iva_credito)."</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Total</strong></td><td style='text-align:right;'><strong>".dinero($total_iva_credito+$total_credito)."</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Saldo Ant</strong></td><td style='text-align:right;'><strong>".dinero($saldo_nuevo)."</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Saldo Nuevo</strong></td><td style='text-align:right;border-top:2px solid black'><strong>".dinero($saldo_nuevo-$total_credito-$total_iva_credito)."</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Abono</strong></td><td style='text-align:right;'><strong>".dinero($abono)."</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";	
					echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
					$vale=($saldo_nuevo-$total_credito-$total_iva_credito)*-1;
					
				} 
				else
					if ($cliente_id==0)
					{

						$query = "SELECT  facturadet.facturadet_id,facturadet.factura_id,facturadet.producto,facturadet.precio_contado,facturadet.iva_contado,
                        facturadet.precio_venta,facturadet.iva,facturadet.precio_promocion,facturadet.descuento,color,talla,facturadet.sku,tipomov_id FROM facturadet,devoluciondet
					WHERE  facturadet.facturadet_id=devoluciondet.facturadet_id AND devoluciondet.devolucion_id=".$did;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
	
	
					foreach( $results as $item )
					{
		
						switch($item['tipomov_id']){
								case '2':$bgcolor="bgcolor='#FFB8D6' ";
										$textcolor="<font color=gray><s> ";
									break;
								
								default:$bgcolor="";
										$textcolor="";
									break;

								}

						echo "<tr $bgcolor ><td>$textcolor ".$item['facturadet_id']."</td><td>$textcolor ".$item['sku']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br>"
							.$item['color']." ".$item['talla']."</td> 
							<td style='text-align:right;vertical-align:text-top'>$textcolor";

                                 echo "(-".$item['descuento']."%) &nbsp;<s>".dinero($item['precio_contado']+($item['precio_contado']*.16))."</s>&nbsp;&nbsp;&nbsp;&nbsp;<br>";
                                 echo dinero($item['precio_venta']);

						echo "</s>&nbsp;&nbsp;&nbsp;&nbsp;</td>";

						// if ($item['tipomov_id']==2 || $item['tipomov_id']==3 )
						// 	echo "<td></td>";
						// else
						// 	echo "	<td style='text-align:right;vertical-align:text-top'><a href=\"#\" class=\"btn btn-info blue btn-setting\">Devolucion</a></td> ";

						echo "</tr>";
										
						$total_credito+=$item['precio_credito'];
						$total_contado+=$item['precio_venta'];
										
						$n++;
					}
					


						$total_iva_contado=$total_contado*.16;
						echo "<tr>
								<td>&nbsp;</td></tr>
				  			<tr>";
				  	// 	echo "<td></td><td style='text-align:right'>Subtotal</td>
							// <td style='text-align:right'>$". dinero($total_contado+$total_iva_contado)."&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
						// echo "<tr><td></td><td style='text-align:right'>Inclue IVA(16%) por:</td>
						// 	<td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
						echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
							<td style='text-align:right;text-align:right;'><strong>".dinero($total_contado)."&nbsp;&nbsp;&nbsp;&nbsp;</strong></td></tr>";
						echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Nota de Venta:</strong></td>
							<td style='text-align:right;text-align:right;border-top:2px solid;'><strong>".dinero($total_contado)."&nbsp;&nbsp;&nbsp;&nbsp;</strong></td></tr>";
							$vale=$total_contado;		
								
							}


						// echo "<tr><td colspan=4 align=center><br><br><br>_________________________________________";

						
						// if ($cliente_id) echo "<br>Cliente: ". strtoupper($cliente);
						//echo "<br><br><br><br>"; //Tipo de Venta: <span class=\"label label-inverse\">Contado</span><br><br>";


						//echo "</td></tr>";	
					
				echo "</table>";
				
					return $vale;
			

 // echo "<br><br>array: <br>";
 //     print_r($item_temp);

    						//$_SESSION['cart_temp']=$item_temp;

  // echo "<br><br>session: <br>";
  //     print_r($_SESSION['cart_dev']);


}


function get_vale($did)
{
$database = new DB();
	
$fecha_hoy=date("Y-m-d H:i:s");
		$query= "SELECT fecha,cantidad,codigo from vale where devolucion_id=$did";
				list( $fecha_hoy,$cantidad,$codigo ) = $database->get_row( $query );

	
	echo "<table width=100% >";
	echo "<tr><td style='text-align:center'>ESTE ES UN VALE POR:</td></tr>";
	echo "<tr><td style='text-align:center'><font size=-2>Fecha: $fecha_hoy</font></td></tr>";
	//echo "<tr><td style='text-align:center'><font size=-2>Valida por 30 dias</font></td></tr>";

 echo "<tr><td style='text-align:center'><br><img width=\"300\" src=\"barcode.php?text=V$codigo\" alt=\"barcode\"></td></tr>";
 echo "<tr><td style='text-align:center'><font size=+2>$ ".dinero($cantidad)." MXN</font></td></tr>";
 echo "</table>";
}




function get_abono($saldo_total)
{
$database = new DB();


 	$query = "SELECT abono,limite FROM abono where activado=1 ORDER BY limite ASC";

	$results = $database->get_results( $query );
	foreach ($results as $row ) 
	{
		//echo $saldo_total." ".$row['limite']." <br> ";
		if ($saldo_total<=$row['limite'])
		{
			$abono=$row['abono'];
			break;
		}
	}

	return $abono;
}








?>