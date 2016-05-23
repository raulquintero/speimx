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

if ($_GET['activo']=="on") $_GET['activo']=1;
if ($_GET['inventariable']=="on") $_GET['inventariable']=1;
if ($_GET['up']=="on") $_GET['up']=1;
if ($_GET['activo']=="") $_GET['activo']=0;
if ($_GET['inventariable']=="") $_GET['inventariable']=0;
if ($_GET['up']=="") $_GET['up']=0;

$data=$_GET['data'];
$op=$_GET['op'];
$f=$_GET['f'];
$prid=$_GET['prid'];
$subcat=$_GET['subcat'];

//************************************************************
if ($f=="u")
{

 //echo "<br><br>";          // ********DEBUG**********
 //foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



		$precio_compra=$_GET['precio_compra']/1.16;
		$precio_contado=$_GET['precio_contado']/1.16;
		$precio_credito=$_GET['precio_credito']/1.16;

$update = array(

	'activo'=>$_GET['activo'],
    'up'=>$_GET['up'],
    'inventariable' => $_GET['inventariable'],
    'subcategoria_id'=>$_GET['subcategoria_id'],
    'temporada_id'=>$_GET['temporada_id'],
	'precio_compra'=>$precio_compra,
	'precio_contado'=>$precio_contado,
	'precio_credito'=>$precio_credito,
   	'descuento'=>$_GET['descuento'],
	'precio_promocion'=>$_GET['precio_promocion']


	);


//Add the WHERE clauses
$where_clause = array(
    'producto_id' => $prid
);

	$updated = $database->update( 'producto', $update, $where_clause, 1 );

// //Output errors if they exist for the update query
//$database->display( $updated );

    $location="/index.php?data=$data&subcat=$subcat&prid=$prid&eed=1";
    if ($op)
        $location.="&op=$op";


header("Location: $location");







}

?>