<?php
$relative_path=isset($relative_path) ? $relative_path : "";
$relative_path="/../..";
$realpath=getcwd();

require_once $realpath.'/../../config/config.php';
$database = new DB();

foreach( $_POST as $key => $value )
{
    $_POST[$key] = $database->filter( $value );
}

foreach( $_GET as $key => $value )
{
    $_GET[$key] = $database->filter( $value );
}
$case=isset($_GET['case']) ? $_GET['case'] : "";
 $database = new DB();


if ($case=="pedidos")
{
    echo "<table class=\"table table-striped table-bordered\">   <!-- bootstrap-datatable datatable -->
          <thead>
		  <tr><th>Nombre</th><th>Fecha de Orden</th><th>Fecha de Entrega</th><th>Status</th><th>Total</th><th>Anticipo</th></tr>
		  </thead>
		  <tbody>";
    $query = "SELECT * FROM pedido,status,pedido_nombre
                        where pedido.pedido_nombre_id=pedido_nombre.pedido_nombre_id AND pedido.status_id=status.status_id";
	$subs = $database->get_results( $query );

	foreach( $subs as $sub )
	{
	    $status_id=$sub['status_id'];
        echo "<tr>";
		echo "<td><b>".$sub['nombre']."</b></td>
            <td><a href=\"#\" onclick=\"showData('pedidos','view/pedidos/pedidos.php','case=pedidos')\">
                                           " .$sub['fecha_orden']."</a>&nbsp;&nbsp;</td>
            <td style   ='text-align:left'>" .$sub['fecha_entrega']."</td>
            <td style   ='text-align:left'>" .$sub['status']."</td>
            <td style   ='text-align:right'>".dinero($sub['total'])."</td>
            <td style   ='text-align:right'>".dinero($sub['anticipo'])."</td>
            </tr>";
	}
	echo "</tbody>
		  </table>";
}

?>