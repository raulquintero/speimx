<?php
$func=htmlspecialchars($_GET['func']);
$i=$_GET['i'];
$code=$_GET['code'];
if (!$i) $i=0;


//echo "cart_dev";
//require_once '/var/www/html/config/config.php';
session_start();

$fid_dev=htmlspecialchars ($_SESSION['fid_dev']);
 //echo "<br><br>";          // ********DEBUG**********
 //foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}


if ($func=="add_dev_item")
{

    $item = $_SESSION['cart_temp'];
     $fdid=$_GET['facturadet_id'];

        $n=0;
        foreach ($item as $row => $value) 
        {

            if ($item[$n]['facturadet_id']==($fdid+0))
                {

                    $item[$n]['tipomov_id']="X";
              

                }
            $n++;
        }
     $_SESSION['cart_temp']=$item;

}




if ($func=="del_dev_item")
{

    $item = $_SESSION['cart_temp'];
    $fdid=$_GET['facturadet_id'];
    $fdid_tipomov_id=$_SESSION['fdid_tipomov_id'];


        $n=0;
        foreach ($item as $row => $value) 
        {
            if ($item[$n]['facturadet_id']==$fdid)
                {
                            $item[$n]['tipomov_id']=$fdid_tipomov_id;
                }
            $n+=1;
        }
     $_SESSION['cart_temp']=$item;


}






//////////////////////////////////////////////////////////


if ($func=="del_item")
{
    $item = $_SESSION['cart_dev'];
    unset($item[$i]);
    $item  = array_values($item);
    
    $_SESSION['cart_dev']=$item;



}


         $location="Location: /index.php?data=clientes&op=factura&fid=".$_GET['fid_dev'];

 header($location);


// foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



// echo "<br><br>";          // ********DEBUG**********
// foreach ($_SESSION as $k => $v) { echo "<br>[$k] => $v \n";}


?>