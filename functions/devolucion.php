<?php
require_once('../config/config.php');

$database = new DB();

 if (!$login->getUserActive())
 		header("location:/index.html");

//session_start();

// $k=$cuantos=0;
// $item=$_SESSION['cart_temp'];

//  foreach ($item as $row => $value) 
//   {
  	
// 	if ( $item[$k]['tipomov_id']=="X")
// 		$cuantos++;
// 	$k++;
// }



$cuantos=get_cuantosdev();

echo "<br>cuantos: $cuantos<br>";
if ($cuantos)
{
echo "<br>user: ".$admin_id=$_SESSION['user_id'];
echo "<br>fid: ".$fid=$_SESSION['fid_dev'];
echo "<br>nid: ".$nid=$_SESSION['nid'];
echo "<br>tipomov_id: ".$tipomov_id=$_SESSION['fdid_tipomov_id'];
echo "<br>cliente_id: ".$cliente_id=$_SESSION['dev_cliente_id'];
echo "<br>saldo _anterior: ".$saldo_anterior=$_SESSION['dev_saldo'];
echo "<br>saldo: ".$saldo_nuevo=0;

echo "<br>";


$query="SELECT fecha from factura where factura_id=$fid";
list( $fecha_factura ) = $database->get_row( $query );

$fecha_hoy=date("Y-m-d H:i:s");
											//The fields and values to insert
									$names = array(
    								'admin_id' => $admin_id,
    								'fecha_factura' => $fecha_factura,
    								'fecha' => $fecha_hoy,
    								'tipomov_id' => $tipomov_id,
    								'factura_id' => $fid,
    								'cliente_id' => $cliente_id,
    								'saldo_anterior' => $saldo_anterior,
    								'total' => 0,
    								'saldo' => 0

			);
									$add_query = $database->insert( 'devolucion', $names );
									$devolucion_id = $database->lastid();

//echo "<a href=/imprimir_devolucion.php?did=$devolucion_id&fid=$fid>Imprimir Ticket</a><br>";

$item=$_SESSION['cart_temp'];
	$k=0; 
	$total_credito=$total_contado=$total_iva_credito=$total_iva_contado=0;
  foreach ($item as $row => $value) 
  {
  	
	if ( $item[$k]['tipomov_id']=="X")
	{
	foreach ($item[$k] as $key => $v) 
		{ echo "$key => $v ";

		}
				//The fields and values to insert
									$names = array(
    								'devolucion_id' => $devolucion_id,
    								'facturadet_id' => $item[$k]['facturadet_id'],
    								'sku' => $item[$k]['code']
    								
			);
									$add_query = $database->insert( 'devoluciondet', $names );
		//Fields and values to update
					$update = array(
    				'tipomov_id' => 2
					);

					//Add the WHERE clauses
					$where_clause = array(
    				'facturadet_id' => $item[$k]['facturadet_id']
					);
					$updated = $database->update( 'facturadet', $update, $where_clause, 1 );

		$total_credito+=$item[$k]['precio_credito'];
		$total_contado+=$item[$k]['precio_venta'];
		$total_iva_credito+=$item[$k]['iva_credito'];
		$total_iva_contado+=$item[$k]['iva_contado'];
	}	
	$k++;

		echo "<br>\n";
  }
  		echo $total_credito;
  		echo $total_contado;
  		echo $total_iva_credito;
  		echo $total_iva_contado;
  		if ($tipomov_id==3)
  			$total=round($total_credito+$total_iva_credito);
  		if ($tipomov_id==14)
  			$total=dinero($total_contado);

echo "<br>tipomov_id: ".$tipomov_id;
echo "<br>total: ".$total;
$saldo=($saldo_anterior-$total);

				//Fields and values to update
					$update = array(
    				'total' => $total,
    				'saldo' => $saldo
					);

					//Add the WHERE clauses
					$where_clause = array(
    				'devolucion_id' => $devolucion_id
					);
					$updated = $database->update( 'devolucion', $update, $where_clause, 1 );

											//The fields and values to insert
									$names = array(
    								'cliente_id' => $cliente_id,
    								'fecha_actual' => $fecha_hoy,
    								'fecha' => $fecha_hoy,
    								'admin_id' => $admin_id,
    								'tipomov_id' => 2,
    								'factura_id' => $devolucion_id,
    								'cantidad' => $total

			);
									$add_query = $database->insert( 'movimiento', $names );









				$abono=get_abono($saldo);
				echo "<br>abono".$abono;

				// if ($saldo>0)
				// {
				// 	$notaventa=$saldo*-1;
				// 	$saldo=0;
				// 	$abono=0;
				// }
				//Fields and values to update
					$update = array(
    				'total_ultimo' => $saldo,
    				'fecha_total_inicio' => $fecha_hoy,
    				'abono' => $abono,
    				'saldo' => $saldo
					);

					//Add the WHERE clauses
					$where_clause = array(
    				'cliente_id' => $cliente_id
					);
					$updated = $database->update( 'cliente', $update, $where_clause, 1 );






				if ($saldo<0)
				{
					$vale=$saldo*-1;
					$saldo=$saldo+$vale;
					$abono=0;

					$fechamas_unsegundo=fechaplus_onesecond($fecha_hoy);

				//The fields and values to insert
					$names = array(
					'cliente_id' => $cliente_id,
					'fecha_actual' => $fechamas_unsegundo,
					'fecha' => $fechamas_unsegundo,
					'admin_id' => $admin_id,
					'tipomov_id' => 5,
					'factura_id' => $devolucion_id,
					'cantidad' => $vale
					);
					$add_query = $database->insert( 'movimiento', $names );

					

				//Fields and values to update
					$update = array(
    				'total_ultimo' => $saldo,
    				'fecha_total_inicio' => $fecha_hoy,
    				'abono' => $abono,
    				'saldo' => $saldo
					);

					//Add the WHERE clauses
					$where_clause = array(
    				'cliente_id' => $cliente_id
					);
					$updated = $database->update( 'cliente', $update, $where_clause, 1 );

					$codigo=$cliente_id + date("y");
					$codigo=$codigo.date("mdHis");

					//The fields and values to insert
					$names = array(
					'devolucion_id' => $devolucion_id,
					'fecha' => $fecha_hoy,
					'cantidad' => $vale,
					'codigo' => $codigo
					);
					$add_query = $database->insert( 'vale', $names );

				}






echo "<br><br>total:\n".$total;
echo "<br>Saldo:  ".$saldo;



// echo "<br><br>Sesion:<br>";          // ********DEBUG**********
// foreach ($_SESSION as $k => $v) { echo "<br>[$k] => $v \n";}


}
// else
// echo "nada k hacer!";
//echo "<br>Location: /imprimir_devolucion.php?did=$devolucion_id&fid=$fid";
 
 $_SESSION['cart_temp']=0;


header("Location: /imprimir_devolucion.php?did=$devolucion_id&fid=$fid");














 ?>