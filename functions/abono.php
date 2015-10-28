<?php 
require '../config/config.php';
$database = new DB();

//			$cid = $_SESSION['cliente_id'];

$cid=$_GET['cid'];
$cantidad=$_GET['cantidad'];
echo $fecha_hoy=date("Y-m-d H:i:s");

if ($_GET['f']=="ab")
{

	echo "abonar a cliente";

	if ($cid)
	{
		$query = "SELECT saldo  FROM cliente 
					WHERE  cliente_id=".$cid;
		list( $saldo  ) = $database->get_row( $query );
	 				
	 				//	$cliente= $apellidop." ".$apellidom." ".$nombre;
		if ($saldo>=$cantidad && $cantidad>0)
		{
			$names = array(
    		'cliente_id' => $cid,
    		'fecha_actual' => $fecha_hoy,
    		'fecha' => $fecha_hoy,
    		'admin_id' => $_SESSION['user_id'],
    		'tipomov_id' => 1, /// abono 
    		'cantidad' => ($cantidad),
    		'saldo_abono' => ($saldo-$cantidad)
			);
			$add_query = $database->insert( 'movimiento', $names );
			$movimiento_id = $database->lastid();

			$update = array(
    		'saldo' => ($saldo-$cantidad)
					);

			//Add the WHERE clauses
			$where_clause = array(
    			'cliente_id' => $cid
				);
			$updated = $database->update( 'cliente', $update, $where_clause, 1 );
		}else
		$mje=m04;

	}




}


  //echo "<br><br><br>cart: <br>";
    //  print_r($_SESSION['cart']);
$_SESSION['cliente_id']=0;
header("Location: /imprimir_abono.php?mid=$movimiento_id");
?>				

				<!-- **********************************endd  ticket********************* -->

				