<?php

function show_pedidos()
{
$database = new DB();

    echo "<div class=\"box span8 hidden-print\">";
    echo "  <div class=\"box-header\">
				<h2><i class=\"halflings-icon align-justify\"></i><span class=\"break\"></span>Pedidos</h2>
				<div class=\"box-icon\">
					<a href=\"#\" class=\"btn-setting\"><i class=\"halflings-icon wrench\"></i></a>
					<a href=\"#\" class=\"btn-minimize\"><i class=\"halflings-icon chevron-up\"></i></a>
					<a href=\"#\" class=\"btn-close\"><i class=\"halflings-icon remove\"></i></a>
			    </div>
			</div>
			<div class=\"box-content\">";

        echo "<div id='pedidos'>";

                   echo "<table class=\"table table-striped table-bordered\">   <!-- bootstrap-datatable datatable -->
							  <thead>
								  <tr>
                                      <th>Nombre</th>
									  <th>Fecha de Orden</th>
									  <th>Fecha de Entrega</th>
                                      <th>Status</th>
									  <th>Total</th>
                                      <th>Anticipo</th>

								  </tr>
							  </thead>
							  <tbody>";
					$query = "SELECT * FROM pedido,status,pedido_nombre
                        where pedido.pedido_nombre_id=pedido_nombre.pedido_nombre_id AND pedido.status_id=status.status_id";
					$subs = $database->get_results( $query );

					foreach( $subs as $sub )
						{
						    $status_id=$sub['status_id'];
                            echo "<tr>";

                            echo "<td>".$sub['nombre']."</td>
							<td><a href=\"#\" onclick=\"showData('pedidos','pedidos_f.php','case=pedidos')\"
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
        </div>
				";
}


?>