<?php 
require_once('../config/config.php');

$database = new DB();

 if (!$login->getUserActive())
 		header("location:/index.html");


// <br>devolucion
// <br>devoluciondet
// <br>factura
// <br>facturadet
// <br>movimiento


// <br>Cliente - resetear saldo y total_ultimo a 0


//Truncate a single table, no output display
// $truncate = $database->truncate( array('your_table') );

//Truncate multiple tables, display number of tables truncated
$cuantos = $database->truncate( array('devolucion', 'devoluciondet','factura','facturadet','movimiento') );


//Fields and values to update
					$update = array(
    				'total_ultimo' => '0',
    				'saldo' => '0'
					);

					//Add the WHERE clauses
					$where_clause = array(
    				'store_id' => '0'
					);
					$updated = $database->update( 'cliente', $update, $where_clause, 1 );

	// $query = "UPDATE cliente set saldo=0,total_ultimo=0";
	// $results = $database->get_results( $query );



$location="Location: /index.php?data=mantenimiento&op=db&err=1&ts=$cuantos";
header($location);