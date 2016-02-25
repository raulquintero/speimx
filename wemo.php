<?php

$salida = shell_exec('./wemo 192.168.1.4 GETSTATUS'); 

if ($salida=="OFF")
		echo "<button onclick='' class=\"btn btn-success\">ON</button>";
	else
    	echo "<button onclick='' class=\"btn btn-warning\">OFF</button>";


$q=isset($_GET['q']) ? $_GET['q'] : "";
$q=2;
switch($q){
	case 0: $salida = shell_exec('/home/alkin/projects/speimx/wemo 192.168.1.4 OFF'); break;
	case 1: $salida = shell_exec('/home/alkin/projects/speimx/wemo 192.168.1.4 ON'); break;
	case 2: $salida = shell_exec('/home/alkin/projects/speimx/wemo 192.168.1.4 GETSTATE'); break;
}


//echo "<pre>$salida</pre>";


?>