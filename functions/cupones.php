<?php

function autocupon($cupon_sku){
$database = new DB(); 

echo "<table width=300 style='border:2px dotted black'>";
echo "<tr><td align=center>CUPON</td></tr>";
echo "<tr><td align=center>BUENO POR</td></tr>";
echo "<tr><td align=center><font size=+3><b>$ 100.00 MX<b></font></td></tr>";
echo "<tr><td align=center>Compra Minima: $ 500.00 MX</td></tr>";
echo "<tr><td align=center><font size=-1>Valido hasta: 12/Mar/2016</center></font></td></tr>";
echo "<tr><td align=center> <img width=250 src=\"barcode.php?text=".$cupon_sku."\" alt=\"barcode\" /></td></tr>";
echo "<tr><td align=center><font size=-1>Promocion no reembolsable en efectivo, ni combinable con otras promociones
    o cupones. <br>No aplica con productos en LIQUIDACION</font></td></tr>";

echo "</table>";
return 0;
}




?>