<?php
$eed = isset($_GET['eed']) ? $_GET['eed'] : '';
$eed = isset($eed) ? $eed : '';
$color_id = isset($color_id) ? $color_id : '';
$cliente_id = isset($cliente_id) ? $cliente_id : '';
$_GET['subcat'] = isset($_GET['subcat']) ? $_GET['subcat'] : '';
$_GET['filtro'] = isset($_GET['filtro']) ? $_GET['filtro'] : '';
$_GET['coid'] = isset($_GET['coid']) ? $_GET['coid'] : '';
$_GET['color_id'] = isset($_GET['color_id']) ? $_GET['color_id'] : '';
$_GET['cat'] = isset($_GET['cat']) ? $_GET['cat'] : '';

$_GET['f']=isset($_GET['f']) ? $_GET['f'] : "";
$pid=isset($pid) ? $pid : "";
$rfc=isset($rfc) ? $rfc : "";
$_GET['h']=isset($_GET['h']) ? $_GET['h'] : "";
$_GET['eed']=isset($_GET['eed']) ? $_GET['eed'] : "";
$numpagos=isset($numpagos) ? $numpagos : "";

$tid=isset($_GET['tid']) ? $_GET['tid'] : "-1";
$eed=isset($_GET['eed']) ? $_GET['eed'] : '';
$prid=isset($_GET['prid']) ? $_GET['prid'] : '';
$_GET['prid']=isset($_GET['prid']) ? $_GET['prid'] : '';
$_GET['cart']=isset($_GET['cart']) ? $_GET['cart'] : '';
$_SESSION['cart']=isset($_SESSION['cart']) ? $_SESSION['cart'] : '';
$_GET['descuento']=isset($_GET['descuento']) ? $_GET['descuento'] : '';
$_GET['i']=isset($_GET['i']) ? $_GET['i'] : '';
$_GET['code']=isset($_GET['code']) ? $_GET['code'] : '';
?>