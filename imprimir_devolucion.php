<?php 
require_once('config/config.php');

$database = new DB();

 if (!$login->getUserActive())
 		header("location:/index.html");

session_start();
$_SESSION['display']="pos";
// $k=$cuantos=0;
// $item=$_SESSION['cart_temp'];

//  foreach ($item as $row => $value) 
//   {
  	
// 	if ( $item[$k]['tipomov_id']=="X")
// 		$cuantos++;
// 	$k++;
// }

// $cuantos=get_cuantosdev();


//echo "<br>cuantos: $cuantos<br>";
// if ($cuantos)
{
// echo "<br>user: ".$admin_id=$_SESSION['user_id'];
$fid=$_GET['fid'];
// echo "<br>nid: ".$nid=$_SESSION['nid'];
// echo "<br>tipomov_id: ".$tipomov_id=$_SESSION['fdid_tipomov_id'];
// echo "<br>cliente_id: ".$cliente_id=$_SESSION['dev_cliente_id'];
// echo "<br>saldo _anterior: ".$saldo_anterior=$_SESSION['dev_saldo'];
// echo "<br>saldo: ".$saldo_nuevo=0;

// echo "<br>";

echo"<html>
	<head>
	<title>Imprimir</title>
	<style type=\"text/css\">
	body{
		font-family: arial, helvetica;
		font-size: x-small; 
	}

	</style>
	</head>
	<body>";
echo "<table width=350>";
echo "<tr><td style='text-align:center;'>";
 getfactura($fid);
$no_ticket=sprintf('T%06d', $fid);

 echo "<br><br><img width=\"200\" src=\"barcode.php?text=$no_ticket\" alt=\"barcode\">";
echo "</td></tr>";
echo "</table>";

echo "<table width=350>";
echo "<tr><td>";
 $notaventa=get_devolucion($_GET['did']);
echo "</td></tr>";
echo "</table>";

if ($notaventa)
	echo "<br><br>Nota de venta por: ".dinero($notaventa);

echo "<table width=350 border=2>";
echo "<tr><td>";
 get_notaventa($_GET['nvid']);
echo "</td></tr>";
echo "</table>";



	
  		echo $total_credito;
  		echo $total_contado;
  		echo $total_iva_credito;
  		echo $total_iva_contado;

$total=round($total_credito+$total_iva_credito);
$saldo=($saldo_anterior-$total);

			




// echo "<br><br>Sesion:<br>";          // ********DEBUG**********
// foreach ($_SESSION as $k => $v) { echo "<br>[$k] => $v \n";}


}
// else
// echo "nada k hacer!";


echo "</body>

</html>";

















 ?>