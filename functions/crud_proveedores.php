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
$pid=$_GET['pid'];


if ($_GET['func']=="c")
{
	

// echo "<br><br>";          // ********DEBUG**********
// foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}


//The fields and values to insert
	$cliente = array(

	'activo'=>$_GET['activo'],
	'rfc'=>$_GET['rfc'],
	'proveedor'=>$_GET['proveedor'],
	'contacto'=>$_GET['contacto'],
	'telefono'=>$_GET['telefono'],
	'email'=>$_GET['email'],
	'domicilio'=>$_GET['domicilio'],
	'colonia_id'=>$_GET['colonia_id'],
	'telefono_oficina'=>$_GET['telefono_oficina'],
	'observaciones'=>$_GET['observaciones']
    	
		);
$add_query = $database->insert( 'proveedor', $cliente );
$last_id = $database->lastid();

header("Location: /index.php?data=$data&op=detalles&pid=$last_id&eed=2");


}				
				





if ($_GET['func']=="u")
{

// echo "<br><br>";          // ********DEBUG**********
// foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}


$update = array(

	'activo'=>$_GET['activo'],
	'rfc'=>$_GET['rfc'],
	'proveedor'=>$_GET['proveedor'],
	'contacto'=>$_GET['contacto'],
	'telefono'=>$_GET['telefono'],
	'email'=>$_GET['email'],
	'domicilio'=>$_GET['domicilio'],
	'colonia_id'=>$_GET['colonia_id'],
	'telefono_oficina'=>$_GET['telefono_oficina'],
	'observaciones'=>$_GET['observaciones']

	
	);


//Add the WHERE clauses
$where_clause = array(
    'proveedor_id' => $_GET['pid']
);

	$updated = $database->update( 'proveedor', $update, $where_clause, 1 );

// //Output errors if they exist for the update query
//$database->display( $updated );



	header("Location: /index.php?data=$data&op=detalles&pid=$pid&eed=1");







}


?>