<?php
require_once  '../config/config.php';
$database = new DB();


 if (!$login->getUserActive())
 		header("location:/index.html");

foreach( $_POST as $key => $value )
{
    $_POST[$key] = $database->filter( $value );
}

foreach( $_GET as $key => $value )
{
    $_GET[$key] = $database->filter( $value );
}


$data= isset($_GET['data']) ? $_GET['data'] : "";
$op= isset($_GET['op']) ? $_GET['op'] : "";

$location= isset($_GET['location']) ? $_GET['location'] : "";





if ($func=="c")
{

$cliente = array(
    'cantidad'=>$cantidad,
	'cupontipo_id'=>$cupontipo_id,
    'compra_minima'=>$compra_minima
	);

    if ($cantidad)
	{
		//$add_query = $database->insert( 'cupon', $cliente );
		$last_id = $database->lastid();
		$location="Location: /index.php?data=cupones&cuid=$last_id&eed=1";
	}
		else
		$location="Location: /index.php?data=cupones&eed=2";


}

if ($func=="u")
{

$update = array(
    'cantidad'=>$cantidad,
	'cupontipo_id'=>$cupontipo_id,
    'compra_minima'=>$compra_minima
	);


//Add the WHERE clauses
$where_clause = array(
    'cupon_id' => $cuid
);

//$updated = $database->update( 'cupon', $update, $where_clause, 1 );

	   	$location="Location: /index.php?data=cupones&cuid=$cuid&eed=1";


}

if ($func=="g")
{

$cupones=generar_cupones($cuid,$cuantos,$_SESSION['user_id'],$fecha_ini,$fecha_fin);
 //echo  $fecha_ini;

//$query="insert into cupones (cupon_id,fecha_ini,fecha_fin,cantidad,cupontipo_id,activo,admin_id)
    //values $cupon_generado ";
$location="Location: /index.php?data=cupones&op=generados&activo=0";
}

if ($func=="d")
{
$delete = array(
    'activo' => 0
);
//$deleted = $database->delete( 'cupones', $delete );

$location="Location: /index.php?data=cupones&op=generados&activo=0";
}

if ($func=="e")
{
$update = array(
    'activo' => 1
);
$where_clause= array(
    'activo' => 0
);
//$updated = $database->update( 'cupones', $update, $where_clause );

$location="Location: /index.php?data=cupones&op=generados&activo=0";
}



if ($location)  header($location);















?>