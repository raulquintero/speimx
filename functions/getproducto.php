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
$productos=$_GET['q'];


$producto = explode(" ", $productos);
$n=count($producto);

			if($producto)
				{
					$query = "SELECT producto_id,producto,precio_compra,precio_contado,precio_credito FROM producto 
						WHERE producto like '%".$producto[0]."%'"; 

						for ($i=1; $i<$n ; $i++) 
						{ 
						$query.=" and producto like '%".$producto[$n-1]."%' ";
						}


						$query.=" Limit 30";
					$results = $database->get_results( $query );

					echo "<table width=400>";

					foreach ($results as $row )
					{

						echo "<tr><td>
						<a href='index.php?data=productos&op=producto_form&f=editar&prid=".$row['producto_id']."'>".
						strtoupper($row['producto'])."</a></td><td align=right>".dinero($row['precio_compra'])."</td>
						<td align=right>".dinero($row['precio_contado'])."</td>
						<td align=right>".dinero($row['precio_credito'])."</td></tr>";
					}
					echo "</table>";

				}	


?>
				