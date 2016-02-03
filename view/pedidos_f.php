<?php

require $realpath.'config/config.php';
$database = new DB();

foreach( $_POST as $key => $value )
{
    $_POST[$key] = $database->filter( $value );
}

foreach( $_GET as $key => $value )
{
    $_GET[$key] = $database->filter( $value );
}

 $database = new DB();



  echo "<table class=\"table table-striped table-bordered\">   <!-- bootstrap-datatable datatable -->
							  <thead>
								  <tr>
									  <th>Id-exe</th>
									  <th>Fecha de Orden</th>
									  <th>Fecha de Entrega</th>
                                      <th>Status</th>
									  <th>Total</th>
                                      <th>Anticipo</th>

								  </tr>
							  </thead>
							  <tbody>";
					$query = "SELECT * FROM pedido,status where pedido.status_id=status.status_id";
					$subs = $database->get_results( $query );

					foreach( $subs as $sub )
						{
						    $status_id=$sub['status_id'];
                            echo "<tr>";

							echo "<td>".$sub['pedido_id']."</td>
							<td><a href=\"#\" onclick=\"showData('r".$sub['pedido_id']."','view/pedidos/pedidos_f.php','?var1=1')\"
                            class=\"btn-setting\">".$sub['fecha_orden']."</a>&nbsp;&nbsp;</td>
							<td style='text-align:left'>".$sub['fecha_entrega']."</td>
							<td style='text-align:left'>".$sub['status'];
                            echo "</td>
							<td style='text-align:right'>".dinero($sub['total'])."</td>
                            <td style='text-align:right'>".dinero($sub['anticipo'])."</td>

							</tr>";

						}





			echo "				  </tbody>
						 </table>
                </div> <!-- fin de la seccion -->
					</div>
				";


?>