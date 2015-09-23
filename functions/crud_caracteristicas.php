<?php


include '../config/config.php';
$database = new DB();

$data=$_GET['data'];
$op=$_GET['op'];
$f=$_GET['f'];
$prid=$_GET['prid'];

foreach( $_POST as $key => $value )
{
    $_POST[$key] = $database->filter( $value );
}

foreach( $_GET as $key => $value )
{
    $_GET[$key] = $database->filter( $value );
}


if ($_GET['func']=="c")
{
	

// echo "<br><br>";          // ********DEBUG**********
 //foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}


//The fields and values to insert
	$color = array(

	
	'color'=>strtoupper($_GET['color']),
	'producto_id'=>strtoupper($_GET['prid']),
	'codigo'=>strtoupper($_GET['codigo'])
	

    	
		);
$add_query = $database->insert( 'color', $color );
$last_id = $database->lastid();

//echo "Location: /index.php?data=$data&op=$op&prid=$prid";

 header("Location: /index.php?data=$data&op=$op&prid=$prid");






}				
				
if ($_GET['func']=="u")
{

// echo "<br><br>";          // ********DEBUG**********
 //foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



$update = array(



	'gruponomina'=>strtoupper($_GET['gruponomina']),
	'banco'=>strtoupper($_GET['banco']),
	'cuenta'=>$_GET['cuenta'],
	'observaciones'=>$_GET['observaciones']
	
	
	);


//Add the WHERE clauses
$where_clause = array('gruponomina_id' => $_GET['gid']);

	$updated = $database->update( 'gruponomina', $update, $where_clause, 1 );

// //Output errors if they exist for the update query
// $database->display( $updated );


	header("Location: /index.php?data=$data");







}


?>