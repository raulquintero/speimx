<?php 
require '../config/config.php';
$database = new DB();



			$cid = $_SESSION['cliente_id'];


			if($cid)
				{
					$query = "SELECT apellidop, apellidom, nombre, credito, saldo,total_ultimo,fecha_total_ultimo, abono  FROM cliente 
						WHERE  cliente_id=".$cid;
					list( $apellidop,$apellidom,$nombre,$credito, $saldo, $total_ultimo, $fecha_total_ultimo,$abono  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;

						
						
				} 
				



		?>


							<?php 
									$item=$_SESSION['cart'];
								
									$n=0;
									$total=0;
									foreach ($item as $row => $value) 
									{	
										
										$total_credito+=$item[$n]['precio_credito'];
										$total_contado+=$item[$n]['precio_contado'];
										
										$n++;

									}
								
							?>



						<?php	

							if ($total_credito AND $cid)
							{
								$total_iva_credito=$total_credito*.16;

								$disponible=$credito-$saldo-$total_credito-$total_iva_credito;

								$saldo_total=$saldo+$total_credito+$total_iva_credito;



									
								// echo "<tr>SubTotal</td>$". dinero($total_credito)."</td></tr>";
								// echo "IVA(16%)</td>".dinero($total_iva_credito)."</td></tr>";	
								// echo "Total".dinero($total_iva_credito+$total_credito)."</strong></td></tr>";	
								// echo "Saldo Actual</td>".dinero($saldo)."</td></tr>";	
								// echo "Saldo Total>$ ".dinero($saldo_total)."</td></tr>";	

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

										// echo "ABONO$". dinero($abono)."</td>";
									

									//////////////////////////////////////////////////////////////factura
									$fecha_hoy=date("Y-m-d H:m:s");
											//The fields and values to insert
									$names = array(
    								'cliente_id' => $cid,
    								'admin_id' => $_SESSION['user_id'],
    								'fecha' => $fecha_hoy,
    								'status_id' => 6,
    								'total' => $total_credito,
    								'iva' => $total_iva_credito,
    								'comision' => 5,
    								'tipomov_id' => 3,
    								'saldo_actual' => $saldo,
    								'saldo_total' => $saldo_total

			);
									$add_query = $database->insert( 'factura', $names );
									$factura_id = $database->lastid();

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

					//fields to update
					$update = array(
    				'saldo' => $saldo_total,
    				'abono' => $abono,
    				'fecha_total_inicio' => $fecha_hoy,
    				'total_ultimo' => $saldo_total
					);
					//print_r($update);
					//Add the WHERE clauses
					$where_clause = array(
    				'cliente_id' => $cid
					);
					$updated = $database->update( 'cliente', $update, $where_clause, 1 );


					$names = array(
    								'cliente_id' => $cid,
    								'fecha_actual' => $fecha_hoy,
    								'fecha' => $fecha_hoy,
    								'admin_id' => $_SESSION['user_id'],
    								'tipomov_id' => 3,
    								'cantidad' => ($total_credito+$total_iva_credito),
    								'factura_id' => $factura_id

			);
									$add_query = $database->insert( 'movimiento', $names );


////////////////////////////////////////////////////////////////creating details for facturadet////////////////////////////////


									$item=$_SESSION['cart'];
								
									$n=0;
									$total=0;
									foreach ($item as $row => $value) 
									{

										$codigo=substr(num_ticket16($item['id']),0,13);
								

										$names= array(
										'factura_id'      => $factura_id,
										'producto_id'      => $item[$n]['id'],
                						'cantidad'     => 1,
                						'precio_credito'   => $item[$n]['precio_credito'],
                						'iva_credito'   => ($item[$n]['precio_credito']*.16),
                						'precio_contado'   => ($item[$n]['precio_contado']),
                						'iva_contado'   => ($item[$n]['precio_contado']*.16),
                						'codigo'     => $item[n]['codigo'],
                						'producto'    => $item[$n]['producto'],
                						'color'    => $item[$n]['color'],
                						'talla'    => $item[$n]['talla']
                						);


								//print_r($names);

									$add_query = $database->insert( 'facturadet', $names );
									//$factura_id = $database->lastid();


										$total_credito+=$item[$n]['precio_credito'];
										$total_contado+=$item[$n]['precio_contado'];
										
										$n++;

									}


/////////////////////////////////////////////////////////////end details ////////////////////////////////////////////

							} 

							else
							
								if ($total_contado)
									{

									$total_iva_contado=$total_contado*.16;

									//////////////////////////////////////////////////////////////factura
									$fecha_hoy=date("Y-m-d H:m:s");
											//The fields and values to insert
									$names = array(
    								'cliente_id' => 0,
    								'admin_id' => $_SESSION['user_id'],
    								'fecha' => $fecha_hoy,
    								'status_id' => 6,
    								'total' => $total_contado,
    								'iva' => $total_iva_contado,
    								'comision' => 5,
    								'tipomov_id' => 14,
    								'saldo_actual' => $saldo,
    								'saldo_total' => $saldo_total
									);

									$add_query = $database->insert( 'factura', $names );
									$factura_id = $database->lastid();
									
									
									$names = array(
    								'cliente_id' => 0,
    								'fecha_actual' => $fecha_hoy,
    								'fecha' => $fecha_hoy,
    								'admin_id' => $_SESSION['user_id'],
    								'tipomov_id' => 14,
    								'cantidad' => ($total_contado+$total_iva_contado),
    								'factura_id' => $factura_id
									);

									$add_query = $database->insert( 'movimiento', $names );

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
                						'cantidad'     => 1,
                						'precio_credito'   => $item[$n]['precio_credito'],
                						'iva_credito'   => $item[$n]['precio_credito'],
                						'precio_contado'   => ($item[$n]['precio_contado']),
                						'iva_contado'   => ($item[$n]['precio_contado']*.16),
                						'codigo'     => $item[$n]['codigo'],
                						'producto'    => $item[$n]['producto'],
                						'color'    => $item[$n]['color'],
                						'talla'    => $item[$n]['talla']
                						);


								//print_r($names);

									$add_query = $database->insert( 'facturadet', $names );
									//$factura_id = $database->lastid();


										$total_credito+=$item[$n]['precio_credito'];
										$total_contado+=$item[$n]['precio_contado'];
										
										$n++;

									}







									echo "<tr><td></td><td>&nbsp;</td></tr>
									<tr><td></td><td style='text-align:right'>Subtotal</td>
									<td class=\"span3\" style='text-align:right'>$". dinero($total_contado)."</td></tr>";
									echo "<tr><td></td><td style='text-align:right'>IVA(16%)</td>
									<td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
									echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
											<td style='text-align:right;text-align:right;border-top:2px solid;'><strong>".dinero($total_iva_contado+$total_contado)."</strong></td></tr>";	
									

									
									}



 // echo "<br><br><br>array: <br>";
     // print_r($_SESSION['cart']);
unset($_SESSION['cart']);
unset($_SESSION['cliente_id']);

header("Location: /index.php?data=pos&op=cerrarventa&fid=$factura_id");
						?>
				
			

				<!-- **********************************endd  ticket********************* -->

				