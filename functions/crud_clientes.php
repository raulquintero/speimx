<?php


$data=$_GET['data'];
$op=$_GET['op'];
$f=$_GET['f'];
$cid=$_GET['cid'];
//echo "func: ".$func=htmlspecialchars($_GET["func"]);



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


if ($_GET['func']=="c")
{
	

// echo "<br><br>";          // ********DEBUG**********
// foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}


//The fields and values to insert
	$cliente = array(

	'activo'=>$_GET['activo'],
	'curp'=>$_GET['curp'],
	'nombre'=>$_GET['nombre'],
	'apellidop'=>$_GET['apellidop'],
	'apellidom'=>$_GET['apellidom'],
	'fechanac'=>$_GET['fechanac'],
	'sexo_id'=>$_GET['sexo_id'],
	'telefono_personal'=>$_GET['telefono_personal'],
	'email'=>$_GET['email'],
	'domicilio_casa'=>$_GET['domicilio_casa'],
	'colonia_casa_id'=>$_GET['colonia_casa_id'],
	'telefono_casa'=>$_GET['telefono_casa'],
	'antiguedad_empleo'=>$_GET['antiguedad_empleo'],
	'observaciones'=>$_GET['observaciones'],

	'credito'=>3000,
	'total_ultimo'=>$_GET['total_ultimo'],
	'fecha_total_inicio'=>fechaustomysql($_GET['fecha_total_inicio']),
	'fecha_total_ultimo'=>fechaustomysql($_GET['fecha_total_ultimo']),
	'saldo'=>$_GET['saldo'],
	'abono'=>$_GET['abono'],
	'empresa_id'=>$_GET['empresa_id']
    	
		);
	if ($_GET['nombre'] && $_GET['curp'])
	{
		$add_query = $database->insert( 'cliente', $cliente );
		$last_id = $database->lastid();
		$location="Location: /index.php?data=$data&op=detalles&cid=$last_id&eed=2";
	}
		else
		$location="Location: /index.php?data=$data&op=cliente_form&func=agregar&eed=3";	

header($location);






}				
				
if ($_GET['func']=="u")
{

// echo "<br><br>";          // ********DEBUG**********
// foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



//echo fechatomysql($_GET['fecha_total_ultimo']);



$update = array(

	'activo'=>$_GET['activo'],
	'curp'=>$_GET['curp'],
	'nombre'=>$_GET['nombre'],
	'apellidop'=>$_GET['apellidop'],
	'apellidom'=>$_GET['apellidom'],
	'fechanac'=>$_GET['fechanac'],
	'sexo_id'=>$_GET['sexo_id'],
	'telefono_personal'=>$_GET['telefono_personal'],
	'email'=>$_GET['email'],
	'domicilio_casa'=>$_GET['domicilio_casa'],
	'colonia_casa_id'=>$_GET['colonia_casa_id'],
	'telefono_casa'=>$_GET['telefono_casa'],
	'antiguedad_empleo'=>$_GET['antiguedad_empleo'],
	'observaciones'=>$_GET['observaciones'],

	'credito'=>$_GET['credito'],
	'total_ultimo'=>$_GET['total_ultimo'],
	'fecha_total_inicio'=>fechaustomysql($_GET['fecha_total_inicio']),
	'fecha_total_ultimo'=>fechaustomysql($_GET['fecha_total_ultimo']),
	'saldo'=>$_GET['saldo'],
	'abono'=>$_GET['abono'],
	'empresa_id'=>$_GET['empresa_id'],
	'gruponomina_id'=>$_GET['gruponomina_id']

	);


//Add the WHERE clauses
$where_clause = array(
    'cliente_id' => $_GET['cid']
);

	$updated = $database->update( 'cliente', $update, $where_clause, 1 );

// //Output errors if they exist for the update query
//$database->display( $updated );


	header("Location: /index.php?data=$data&op=detalles&cid=$cid&eed=1");







}








?>