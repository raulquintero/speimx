<?php
require $realpath.'../config/config.php';
$database = new DB();

foreach( $_POST as $key => $value )
{
    $_POST[$key] = $database->filter( $value );
}

foreach( $_GET as $key => $value )
{
    $_GET[$key] = $database->filter( $value );
}
$telefono=$_GET['q'];


			if($telefono )
				{
					$query = "SELECT pedido_nombre_id,telefono,nombre FROM pedido_nombre
						WHERE telefono like '%".$telefono."%'";

						 $query.=" Limit 10";
					$results = $database->get_results( $query );

					echo "<table width=300 >";

					foreach ($results as $row )
					{
						echo "<tr><td>
						<a href='index.php?data=pos&op=pedido&f=editar&pnid=".$row['pedido_nombre_id']."'>".
						strtoupper($row['telefono'])."</a></td>";
                        echo "<td>
						<a href='index.php?data=pos&op=pedido&f=editar&pnid=".$row['pedido_nombre_id']."'>".
						strtoupper($row['nombre'])."</a></td></tr>";
					}
					echo "</table>";

				}


?>
