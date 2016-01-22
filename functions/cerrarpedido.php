<?php
require '../config/config.php';
$database = new DB();

foreach( $_POST as $key => $value )
{
    $_POST[$key] = $database->filter( $value );
}

foreach( $_GET as $key => $value )
{
    $_GET[$key] = $database->filter( $value );
}


			$cid = $_GET['nombre'];
			$efectivo=$_GET['efectivo'];





									$item=$_SESSION['cart'];

									$n=0;
									$total=0;
									foreach ($item as $row => $value)
									{

										$total_contado+=$item[$n]['precio_contado'];
										$n++;

									}




								if ($total_contado)
									{



									//////////////////////////////////////////////////////////////factura
									$fecha_hoy=date("Y-m-d G:i:s");
											//The fields and values to insert
									$names = array(
    								'store_id' => 0,
    								'admin_id' => $_SESSION['user_id'],
                                    'pedido_cliente_id=> $pedido_client_id',
    								'fecha_orden' => $fecha_hoy,
                                    'fecha_entrega => ',
    								'status_id' => 4,
    								'total' => $total_contado,
    								'iva' => $total_iva_contado,
    								'tipomov_id' => 14,
    								'anticipo' => $saldo

									);



  									$add_query = $database->insert( 'factura', $names );
									$factura_id = $database->lastid();

									if ($promociones && $promo>0)
									{
										$names = array(
    									'promocion_id' => 1,
    									'factura_id' => $factura_id,
    									'descuento' => 'promo ',
    									'cantidad' => $promo,
    									'fecha' => $fecha_hoy,
    									'admin_id' => $_SESSION['user_id'],
    									);

 										$add_query = $database->insert( 'descuento', $names );
									}


									$cadena2=num_ticket16($factura_id);
									//Fields and values to update
									$update = array(
    								'ticket' => $cadena2
									);

									//Add the WHERE clauses
									$where_clause = array(
    								'factura_id' => $factura_id
									);
									$updated = $database->update( 'factura', $update, $where_clause, 1 );

								$item=$_SESSION['cart'];

									$n=0;
									$total=0;
									foreach ($item as $row => $value)
									{

										$codigo=substr(num_ticket16($item['id']),0,13);

										$names= array(
										'factura_id'      => $factura_id,
										'producto_id'      => $item[$n]['id'],
										'tipomov_id'      => 14,
                						'cantidad'     => 1,
                						'precio_compra'   => $item[$n]['precio_compra'],
                						'precio_credito'   => $item[$n]['precio_credito'],
                						'iva_credito'   => $item[$n]['precio_credito']*.16,
                						'precio_contado'   => ($item[$n]['precio_contado']),
                						'iva_contado'   => ($item[$n]['precio_contado']*.16),
                                        'precio_venta'   => $item[$n]['precio_venta'],
                						'iva'   => (16),
                                        'precio_promocion'   => $item[$n]['precio_promocion'],
                                        'descuento'   => $item[$n]['descuento'],
                						'codigo'     => $item[$n]['codigo'],
                						'sku'     => $item[$n]['sku'],
                						'producto'    => addslashes($item[$n]['producto']),
                						'color'    => $item[$n]['color'],
                						'talla'    => $item[$n]['talla']
                						);


								//print_r($names);

									$add_query = $database->insert( 'facturadet', $names );
									//$factura_id = $database->lastid();


										$total_credito+=$item[$n]['precio_credito'];
										$total_contado+=$item[$n]['precio_contado'];
										$total_precio_venta+=$item[$n]['precio_venta'];

										$n++;

									}


									$names = array(
    								'cliente_id' => 0,
    								'fecha_actual' => $fecha_hoy,
    								'fecha' => $fecha_hoy,
    								'admin_id' => $_SESSION['user_id'],
    								'tipomov_id' => 14,
    								'cantidad' => $total_precio_venta,
    								'factura_id' => $factura_id
									);

									$add_query = $database->insert( 'movimiento', $names );





									echo "<tr><td></td><td>&nbsp;</td></tr>
									<tr><td></td><td style='text-align:right'>Subtotal</td>
									<td class=\"span3\" style='text-align:right'>$". dinero($total_contado)."</td></tr>";
									echo "<tr><td></td><td style='text-align:right'>IVA(16%)</td>
									<td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
									echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
											<td style='text-align:right;text-align:right;border-top:2px solid;'><strong>".dinero($total_iva_contado+$total_contado)."</strong></td></tr>";



									}



   //echo "<br><br><br>cart: <br>";
     // print_r($_SESSION['cart']);
unset($_SESSION['cart']);
unset($_SESSION['cliente_id']);

header("Location: /imprimir_ticket.php?fid=$factura_id");
						?>


				<!-- **********************************endd  ticket********************* -->

				