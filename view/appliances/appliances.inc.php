<?php

$q=isset($_GET['q']) ? $_GET['q'] : "";

switch($q){
	case "off": $salida = shell_exec('./wemo 192.168.1.4 OFF'); break;
	case "on": $salida = shell_exec('./wemo 192.168.1.4 ON'); break;
	case "status": $salida = shell_exec('./wemo 192.168.1.4 GETSTATE'); break;
}

if (!$q) header("Location: /index.php?data=appliances");


$salida = shell_exec('./wemo 192.168.1.4 GETSTATE'); 
$salida= str_replace("\n", "", $salida);

if ($salida=="OFF")
		echo "SWITCH 1 <a href='/index.php?data=appliances&q=on' onclick='' class=\"btn btn-success\">ON ($salida)</a>";
if ($salida=="ON" || $salida==1)
    	echo "SWITCH 1 <a href='/index.php?data=appliances&q=off' onclick='' class=\"btn btn-warning\">OFF ($salida)</a>";




//echo "$salida -- $status -- $cuantos";


?>