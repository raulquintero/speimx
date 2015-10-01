<?php


include '../config/config.php';
$database = new DB();

foreach( $_POST as $key => $value )
{
    $_POST[$key] = $database->filter( $value );
}

foreach( $_GET as $key => $value )
{
    $_GET[$key] = $database->filter( $value );
}

$data=$_GET['data'];
$op=$_GET['op'];
$f=$_GET['f'];
$prid=$_GET['prid'];


if ($_GET['func']=="c" && $_GET['color'])
{
	

// echo "<br><br>";          // ********DEBUG**********
 //foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}


//The fields and values to insert
	$color = array(

	
	'color'=>strtoupper($_GET['color']),
	'producto_id'=>strtoupper($_GET['prid'])
	);

$add_query = $database->insert( 'color', $color );
$last_id = $database->lastid();

	// generar codigo  para el color
	$sku=sprintf('%04d', $last_id);
	 $sku=$_GET['codigo'].$sku;

	$update = array(
	'codigo_color' => $sku
	);

	//Add the WHERE clauses
	$where_clause = array(
    'color_id' => $last_id
	);
	$updated = $database->update( 'color', $update, $where_clause, 1 );


//echo "Location: /index.php?data=$data&op=$op&prid=$prid";

 header("Location: /index.php?data=$data&op=$op&prid=$prid&coid=$last_id");

}
	// else
	//  header("Location: /index.php?data=$data&op=$op&prid=$prid");


				
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

	header("Location: /index.php?data=$data");

}

if ($_GET['func']=="ct"){



	echo $query="SELECT talladet_id,talladet,orden from talladet where talla_id='".$_GET['talla_id']."'";

	$results = $database->get_results( $query );
	foreach( $results as $row )
	{


	$query = array(
	'producto_id'=>$_GET['prid'],
	'cantidad'=>'1',
	'talladet_id'=>$row['talladet_id'],
	'color_id'=>$_GET['color_id']
	);
	//echo "<br>	";
	//print_r($query);
	$add_query = $database->insert( 'inventariodet', $query );
	$last_id = $database->lastid();
	// generar codigo  para el color
	//$last_id=1;
	 $sku=70000000+$last_id;

	$update = array(
	'codigo' => $sku
	);

	//Add the WHERE clauses
	$where_clause = array(
    'inventariodet_id' => $last_id
	);
	$updated = $database->update( 'inventariodet', $update, $where_clause, 1 );

	}

	header("Location: /index.php?data=productos&op=inventario&prid=$prid&coid=".$_GET['color_id']);
}

?>
