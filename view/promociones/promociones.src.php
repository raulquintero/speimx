<?php
function catalogo($tid,$i)
{
$database = new DB();

	$query = "SELECT categoria_id,categoria  FROM categoria
		where 1 ";


	$results = $database->get_results( $query );



	foreach( $results as $row )
	{


    		echo "<tr ><td colspan=3>".$row['categoria']." </td></tr>";

    $query="SELECT descuento from temporada where temporada_Id=$tid";
    list( $descuento ) = $database->get_row( $query );
	$query = "SELECT subcategoria_id,subcategoria  FROM subcategoria where categoria_id=".$row['categoria_id'];
	$subs = $database->get_results( $query );

				foreach( $subs as $sub )
					{


					$query = "SELECT count(producto_id) as productos FROM producto
					where producto.temporada_id=$tid AND subcategoria_id=".$sub['subcategoria_id'];
                    if ($i)
                        $query.=" AND producto.descuento=$descuento";
                        else
                        $query.=" AND producto.descuento<>$descuento";
					list($productos)= $database->get_row($query);

                    if ($productos)
					echo "<tr><td></td><td align=right>
						<a href=/index.php?data=catalogo&subcat=".$sub['subcategoria_id']."&tid=$tid>".$sub['subcategoria']."</a>
                        &nbsp;&nbsp; </td>
						<td>$productos</td></tr>";
					}

	}


}

?>