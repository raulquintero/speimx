
<?php

$sku = isset($_GET['sku']) ? $_GET['sku'] : "";

if($sku)
	{
		 $query = "SELECT *  FROM cupones
			WHERE  sku='".$sku."'";
		list( $cupones_id,$cupon_id,$sku,$fecha_ini,$fecha_fin,$cantidad,$cupontipo_id,$activo,$fecha_uso,$usado,$admin,$bulk ) = $database->get_row( $query );
			$apellidos= $apellidop." ".$apellidom;

	}

if ($cupon_id)
{
    echo "<h2 ><b>CUPON</b></h2>";

    echo "<table width=100% style=\"border:1px dotted\">";

    switch ($cupontipo_id){
        case '1': echo "<tr><td><center><h1 ><b>$ ".dinero($cantidad)." MX </b></h1></center></td></tr>";
        break;
    }


		echo "<tr><td><center><b>Expira: $fecha_fin</B></center></td></tr>";
		if (!$activo) echo "<tr bgcolor=yellow><td >Status:</td><td>Sin Activar</td></tr>";
		if ($usado) echo "<tr><td >Usado el:</td><td></td></tr>";

	    echo "<tr><td colspan=4><center><br></td></tr>";
	    echo "</table>";


echo "<a href='/index.php?data=pos' class='btn' data-dismiss='modal'>CANCELAR</a>";
echo "<a href='/functions/crud_cupones.php?func=sel_cliente&cid=$cliente_id' class=\"btn btn-primary\" >APLICAR</a>";


}


else
	echo "no existe";
 ?>

