<?php
$func=isset($_GET['func']) ? $_GET['func']: "";
$iva=($_GET['iva']/100)+1;
$descuento=$_GET['precio_contado']*$iva*($_GET['descuento']/100);
$sku=isset ($_GET['codigo_inventario']) ? htmlspecialchars ($_GET['codigo_inventario']) : "";
$cupon_sku=isset($_GET['cupon_sku']) ? $_GET['cupon_sku'] : "";
$i=$_GET['i'];
if (!$i) $i=0;

//require_once '/var/www/html/config/config.php';
session_start();

 //echo "<br><br>";          // ********DEBUG**********
 //foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



if ($func=="add_item")
{

    $precio_contado=isset($_GET['precio_contado']) ? $_GET['precio_contado']: "";
    $precio_compra=isset($_GET['precio_compra']) ? $_GET['precio_compra'] : "";
    $precio_credito=isset($_GET['precio_credito']) ? $_GET['precio_credito'] : "";
    if (!$precio_credito && $sku=="60056002")
    $precio_credito=$precio_contado*1.3;
    $precio_venta=($precio_contado*$iva)-$descuento;
    $temporada_id=isset($_GET['temporada_id']) ? $_GET['temporada_id'] : "";
    //$precio_venta=$precio_contado*$iva;

    if ($_GET['servicio'])
        {
            $precio_contado=$precio_contado/$iva;
            $precio_credito=$precio_credito/$iva;
            $precio_compra=$precio_contado;
            $precio_venta=$precio_venta/$iva;
        }
    $item = $_SESSION['cart'];
    $item[] = array(
                'id'      => $_GET['prid'],
                'cantidad'     => 1,
                'precio_compra'   => $precio_compra,
                'precio_credito'   => $precio_credito,
                'precio_contado'   => $precio_contado,
                'producto'    => $_GET['producto'],
                                'precio_venta'    => $precio_venta,
                'iva'    => $_GET['iva'],
                                'precio_promocion'    => $_GET['precio_promocion'],
                                'descuento'    => $_GET['descuento'],
                'codigo' => $_GET['codigo'],
                'sku' => $sku,
                'temporada_id' => $temporada_id,
                'color'    => $_GET['color'],
                'talla'    => $_GET['talla']
            );

    // iva sin implementar todavia , solo esta indicado aqui arriba

    ($_SESSION['cart']=$item);


}

//////////////////////////////////////////////////////////


if ($func=="del_item")
{

    $item = $_SESSION['cart'];
    unset($item[$i]);
    $item  = array_values($item);

    $_SESSION['cart']=$item;



}


if ($func=="sel_cliente")
{
     $cid=isset($_GET['cid']) ? $_GET['cid'] : "0";
     $tipocredito_id=isset($_GET['tipocredito_id']) ? $_GET['tipocredito_id'] : "0";
    //$cid=substr($cid,1,6);
     $_SESSION['cliente_id']=$cid;
     $_SESSION['cupon_sku']="0";
     $_SESSION['tipocredito_id']="a".$tipocredito_id;


}

if ($func=="del_cliente")
{
    $_SESSION['cliente_id']=FALSE;
         $_SESSION['cupon_sku']="0";


}

if ($func=="apply_cupon")
{

    $_SESSION['cupon_sku']=$cupon_sku;



}

if ($func=="unset_cupon")
{

    $_SESSION['cupon_sku']="0";



}






 //echo "<br><br>array: <br>";
   //  print_r($item);


 // echo "<br><br>array: <br>";
   //   print_r($_SESSION['cart']);







   header("Location: /index.php");


 //foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



 //echo "<br><br>";          // ********DEBUG**********
 //foreach ($_SESSION as $k => $v) { echo "<br>[$k] => $v \n";}





?>