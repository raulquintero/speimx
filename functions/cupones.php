<?php

function autocupon($factura_id){
$database = new DB();
$query = "SELECT cantidad,sku,cupontipo_id,fecha_fin,compra_minima from cupones where factura_id='$factura_id'";
list($cantidad,$cupon_sku,$cupontipo_id,$fecha_fin,$compra_minima)=$database->get_row($query);

if($cantidad)
{
    echo "<table width=310 style='border:2px dotted black'>";
    echo "<tr><td align=center>CUPON</td></tr>";
    echo "<tr><td align=center>BUENO POR</td></tr>";
    echo "<tr><td align=center><font size=+3><b>$ ".dinero($cantidad)." MX<b></font></td></tr>";
    echo "<tr><td align=center>Compra Minima: $ ".dinero($compra_minima)." MX</td></tr>";
    echo "<tr><td align=center><font size=-1>Valido hasta: ".fechamysqltomx($fecha_fin,"letra")."</center></font></td></tr>";
    echo "<tr><td align=center> <img width=310 src=\"barcode.php?text=".$cupon_sku."\" alt=\"barcode\" /></td></tr>";
    echo "<tr><td align=center><font size=-1>Promocion no reembolsable en efectivo, ni combinable con otras promociones
    o cupones. <br>No aplica con productos en LIQUIDACION</font></td></tr>";

    echo "</table>";
    return $cupon_sku;
    }

else return "";

}




?>