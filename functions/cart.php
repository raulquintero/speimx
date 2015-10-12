<?php
$func=$_GET['func'];
$sku=htmlspecialchars ($_GET['codigo_inventario']);
$i=$_GET['i'];
if (!$i) $i=0;

//require_once '/var/www/html/config/config.php';
session_start();

 //echo "<br><br>";          // ********DEBUG**********
 //foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



if ($func=="add_item")
{

    $item = $_SESSION['cart'];
    $item[] = array(
                'id'      => $_GET['prid'],
                'cantidad'     => 1,
                'precio_credito'   => $_GET['precio_credito'],
                'precio_contado'   => $_GET['precio_contado'],
                'producto'    => $_GET['producto'],
                'codigo' => $_GET['codigo'],
                'sku' => $sku,
                'color'    => $_GET['color'],
                'talla'    => $_GET['talla']
            );
        


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
    $cid=$_GET['cid'];
    $cid=substr($cid,1,6);
    $_SESSION['cliente_id']=$cid;



}

if ($func=="del_cliente")
{
    $_SESSION['cliente_id']=FALSE;



}







 //echo "<br><br>array: <br>";
    // print_r($item);


  //echo "<br><br>array: <br>";
   //   print_r($_SESSION['cart']);







     header("Location: /index.php");


// foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



// echo "<br><br>";          // ********DEBUG**********
// foreach ($_SESSION as $k => $v) { echo "<br>[$k] => $v \n";}


?>