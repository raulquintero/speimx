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

			$pedido_nombre_id = $_GET['pnid'];

            if (!$pedido_nombre_id)
                {
				$names = array(
				'telefono' => $_GET['telefono'],
				'nombre' => $_GET['nombre'],
                'notas'=> $notas
				);

				$add_query = $database->insert( 'pedido_nombre', $names );
				$pedido_nombre_id = $database->lastid();

                }



									$item=$_SESSION['cart'];
									$n=0;
									$total=0;
									foreach ($item as $row => $value)
									{
										$total_contado+=$item[$n]['precio_contado']*1.16;
										$n++;
									}

								if ($total_contado)
									{

                                    $query = "SELECT saldo FROM pedido_nombre
                						WHERE  pedido_nombre_id=".$pedido_nombre_id;
				                   	list( $saldo  ) = $database->get_row( $query );

									//////////////////////////////////////////////////////////////factura
									$fecha_hoy=date("Y-m-d G:i:s");
                                    $fecha_entrega=$_GET['fecha_entrega']." 16:00:00";
											//The fields and values to insert
									$names = array(
    								'store_id' => 0,
    								'admin_id' => $_SESSION['user_id'],
                                    'pedido_nombre_id'=> $pedido_nombre_id,
    								'fecha_orden' => $fecha_hoy,
                                    'fecha_entrega' => $fecha_entrega ,
    								'status_id' => 4,
    								'total' => $total_contado,
    								'iva' => 0,
    								'anticipo' => $_GET['anticipo']

									);



  									$add_query = $database->insert( 'pedido', $names );
									$pedido_id = $database->lastid();

                                    $saldo_total=$saldo+$total_contado-$_GET['anticipo'];
                                     //agregar saldo actual
									//Fields and values to update
									$update = array(
    								'saldo' => $saldo_total
									);

									//Add the WHERE clauses
									$where_clause = array(
    								'pedido_nombre_id' => $pedido_nombre_id
									);
									$updated = $database->update( 'pedido_nombre', $update, $where_clause, 1 );



								$item=$_SESSION['cart'];

									$n=0;
									$total=0;
									foreach ($item as $row => $value)
									{

										$codigo=substr(num_ticket16($item['id']),0,13);

										$names= array(
										'pedido_id'      => $pedido_id,
										'producto_id'      => $item[$n]['id'],
										'tipomov_id'      => 14,
                						'cantidad'     => 1,
                						'precio_compra'   => $item[$n]['precio_compra'],
                                        'precio_contado'   => ($item[$n]['precio_contado']),
                                        'precio_credito'   => $item[$n]['precio_credito'],
                						'iva'   => 0,
                                        'sku'     => $item[$n]['sku'],
                                        'codigo'     => $item[$n]['codigo'],
                						'producto'    => addslashes($item[$n]['producto']),
                						'color'    => $item[$n]['color'],
                						'talla'    => $item[$n]['talla']
                						);


								//print_r($names);

									$add_query = $database->insert( 'pedido_det', $names );
									//$factura_id = $database->lastid();

										//$total_contado+=$item[$n]['precio_contado'];
										//$n++;

									}


									$names = array(
    								'fecha_actual' => $fecha_hoy,
    								'fecha' => $fecha_hoy,
    								'admin_id' => $_SESSION['user_id'],
    								'tipomov_id' => 14,
    								'cantidad' => $_GET['anticipo'],
                                    'saldo' => $total_contado-$_GET['anticipo'],
    								'pedido_id' => $pedido_id
									);

								   	$add_query = $database->insert( 'pedido_movimiento', $names );





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

header("Location: /imprimir_ticket_pedido.php?peid=$pedido_id");
						?>


				<!-- **********************************endd  ticket********************* -->

