<?php
$func=htmlspecialchars($_GET['func']);
$i=$_GET['i'];
if (!$i) $i=0;


//echo "cart_dev";
//require_once '/var/www/html/config/config.php';
session_start();

$fid_dev=htmlspecialchars ($_SESSION['fid_dev']);
 //echo "<br><br>";          // ********DEBUG**********
 //foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



if ($func=="add_item")
{

    $item = $_SESSION['cart_dev'];
    $item[] = array(
                'facturadet_id'      => $_GET['facturadet_id'],
                'id'      => $_GET['prid'],
                'cantidad'     => 1,
                'precio_credito'   => $_GET['precio_credito'],
                'precio_contado'   => $_GET['precio_contado'],
                'producto'    => $_GET['producto'],
                'codigo' => $_GET['codigo'],
                'sku' => $_GET['sku'],
                'color'    => $_GET['color'],
                'talla'    => $_GET['talla']
            );
        


    ($_SESSION['cart_dev']=$item);


}

//////////////////////////////////////////////////////////


if ($func=="del_item")
{
    $item = $_SESSION['cart_dev'];
    unset($item[$i]);
    $item  = array_values($item);
    
    $_SESSION['cart_dev']=$item;



}





 // echo "<br><br>array: <br>";
 //     print_r($item);


 //  echo "<br><br>session: <br>";
 //     print_r($_SESSION['cart_dev']);




//        echo "Location: /index.php?data=clientes&op=factura&fid=$fid_dev";

     header("Location: /index.php?data=clientes&op=factura&fid=$fid_dev");


// foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



// echo "<br><br>";          // ********DEBUG**********
// foreach ($_SESSION as $k => $v) { echo "<br>[$k] => $v \n";}


?>