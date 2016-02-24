<?php


$data=$_GET['data'];
$op=$_GET['op'];
$f=$_GET['f'];
$cid=$_GET['cid'];
$func=$_GET['func'];
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


if ($func=="c")
{


// echo "<br><br>";          // ********DEBUG**********
// foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}

$codigo_cliente="54";
$codigo_cliente.=1000+date("y");
$codigo_cliente.=date("mdHis");


//The fields and values to insert
	$cliente = array(

	'codigo_cliente'=>$codigo_cliente,
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
    'observaciones'=>$_GET['tipocredito_id'],
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
		echo $last_id = $database->lastid();
		$location="Location: /index.php?data=$data&op=detalles&cid=$last_id&eed=2";
	}
		else
		$location="Location: /index.php?data=$data&op=cliente_form&func=agregar&eed=3";




}



if ($func==="u")
{

// echo "<br><br>";          // ********DEBUG**********
// foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



//echo fechatomysql($_GET['fecha_total_ultimo']);



$update = array(

	'activo'=>$_GET['activo'],
	'curp'=>$_GET['curp'],
	'nombre'=>strtoupper($_GET['nombre']),
	'apellidop'=>strtoupper($_GET['apellidop']),
	'apellidom'=>strtoupper($_GET['apellidom']),
	'fechanac'=>$_GET['fechanac'],
	'sexo_id'=>$_GET['sexo_id'],
	'telefono_personal'=>$_GET['telefono_personal'],
	'email'=>$_GET['email'],
	'domicilio_casa'=>strtoupper($_GET['domicilio_casa']),
	'colonia_casa_id'=>$_GET['colonia_id'],
	'telefono_casa'=>$_GET['telefono_casa'],
	'antiguedad_empleo'=>$_GET['antiguedad_empleo'],
	'observaciones'=>$_GET['observaciones'],
     'tipocredito_id'=>$_GET['tipocredito_id'],
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

	if ($_GET['cid']>0) 
		$updated = $database->update( 'cliente', $update, $where_clause, 1 );

// //Output errors if they exist for the update query
//$database->display( $updated );

	if ($_GET['cid']>0) 
	 $location="Location: /index.php?data=$data&op=detalles&cid=$cid&eed=1";
	else
	 $location="Location: /index.php?data=clientes&op=cliente_form&func=agregar&eed=3";
}





if ($location)
header($location);


?>