
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
    echo "<center>";

    echo "<table width=400 style=\"border:2px dotted\">";
    echo "<tr><td bgcolor=black><center><h2 ><b><font color=white> CUPON </font></b></h2></center></td></tr>";

    switch ($cupontipo_id){
        case '1': echo "<tr><td><br><center><h1 ><b>$ ".dinero($cantidad)." MX </b></h1></center></td></tr>";
        break;
    }
         echo "<tr><td><center><b>Valido: ".fechamysqltomx($fecha_ini,"letra")." - ".fechamysqltomx($fecha_fin,"letra")."</B></center></td></tr>";

		if ($fecha_fin<date("Y-m-d")) echo "<tr><td><br><center><span class=\"label label-important\">EXPIRADO</span></B></center></td></tr>";
          //  else echo "<tr><td><center><b>Valido: ".fechamysqltomx($fecha_ini,"letra")." - ".fechamysqltomx($fecha_fin,"letra")."</B></center></td></tr>";
if (strtotime(date("Y-m-d"))<strtotime($fecha_ini)) echo "<tr bgcolor=yellow><td ><center>Error Fecha: Todavia no se puede usar</center></td></tr>";
		if (!$activo) echo "<tr bgcolor=yellow><td ><center>Status: Sin Activar</center></td></tr>";
		if ($usado) echo "<tr><td> <center>Usado el: <center></td></tr>";

	    echo "<tr><td><center>$fecha_ini <".date("Y-m-d")."</td></tr>";
	    echo "</table><br><br>";


echo "<a href='/index.php?data=pos' class='btn' data-dismiss='modal'>CANCELAR</a>&nbsp;&nbsp;&nbsp;";
if ($fecha_fin>=date("Y-m-d") && strtotime(date("Y-m-d"))<=strtotime($fecha_ini)) echo "<a href='/functions/crud_cupones.php?func=sel_cliente&cid=$cliente_id' class=\"btn btn-primary\" >APLICAR</a>";

echo "</center>";

}


else
	echo "no existe";
 ?>

