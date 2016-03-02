<!-- <object type="text/html" data="/view/appliances/appliances_switch.php" width="800" border=1 height="400"> </object> -->

<iframe width="800" height="200" scrolling="no" frameborder="0" src="/view/appliances/appliances_switch.php" target="_top"> </iframe>
<br>

<?php

$q=isset($_GET['q']) ? $_GET['q'] : "";

switch($q){
	case "off": $salida = shell_exec('./wemo 192.168.1.4 OFF'); break;
	case "on": $salida = shell_exec('./wemo 192.168.1.4 ON'); break;
	case "status": $salida = shell_exec('./wemo 192.168.1.4 GETSTATE'); break;
}

//if (!$q) header("Location: /index.php?data=appliances");

$salida=3;
$salida = shell_exec('./wemo 192.168.1.4 GETSTATE'); 
$salida= str_replace("\n", "", $salida);

if ($salida=="OFF")
		echo "SWITCH 1 is OFF <a href='/index.php?data=appliances&q=on' onclick='' class=\"btn btn-success\">ON</a>";
if ($salida=="ON" || $salida==1)
    	echo "SWITCH 1 is ON <a href='/index.php?data=appliances&q=off' onclick='' class=\"btn btn-warning\">OFF</a>";




//echo "$salida -- $status -- $cuantos";


?>