<?php


include '../config/config.php';
$database = new DB();

$data=$_GET['data'];

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
// foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}


//The fields and values to insert
	$cliente = array(

	'activo'=>$_GET['activo'],
	'rfc'=>$_GET['rfc'],
	'empresa'=>$_GET['empresa'],
	'contacto'=>$_GET['contacto'],
	'telefono'=>$_GET['telefono'],
	'email'=>$_GET['email'],
	'domicilio'=>$_GET['domicilio'],
	'colonia_id'=>$_GET['colonia_id'],
	'telefono_oficina'=>$_GET['telefono_oficina'],
	'observaciones'=>$_GET['observaciones'],
	'empresa_id'=>$_GET['empresa_id'],
	'gruponomina_id'=>$_GET['gruponomina_id']

    	
		);
$add_query = $database->insert( 'empresa', $cliente );
$last_id = $database->lastid();

header("Location: /index.php?data=$data&op=detalles&eid=$last_id&eed=2");






}				
				
if ($_GET['func']=="u")
{

// echo "<br><br>";          // ********DEBUG**********
 //foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



//echo fechatomysql($_GET['fecha_total_ultimo']);



$update = array(



	'activo'=>$_GET['activo'],
	'rfc'=>$_GET['rfc'],
	'empresa'=>$_GET['empresa'],
	'sucursal'=>$_GET['sucursal'],
	'contacto'=>$_GET['contacto'],
	'telefono'=>$_GET['telefono'],
	'email'=>$_GET['email'],
	'domicilio'=>$_GET['domicilio'],
	'colonia_id'=>$_GET['colonia_id'],
	'telefono_oficina'=>$_GET['telefono_oficina'],
	'observaciones'=>$_GET['observaciones'],
	'empresa_id'=>$_GET['eid'],
	'gruponomina_id'=>$_GET['gruponomina_id']

	
	);


//Add the WHERE clauses
$where_clause = array(
    'empresa_id' => $_GET['eid']
);

	$updated = $database->update( 'empresa', $update, $where_clause, 1 );

// //Output errors if they exist for the update query
//$database->display( $updated );

$data=$_GET['data'];
$op=$_GET['op'];
$f=$_GET['f'];
$eid=$_GET['eid'];

	header("Location: /index.php?data=$data&op=detalles&eid=$eid&eed=1");







}


?>