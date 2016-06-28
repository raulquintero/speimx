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

//print_r($_POST);
if ($_POST['func']=="csize")
{
	echo $_POST['prid'];
	echo $_POST['color_id'];
	echo "<br>";

	echo $query = "SELECT inventariodet_id from inventariodet where producto_id='".$_POST['prid']."' AND color_id='".$_POST['color_id']."'";
	$results=$database->get_results($query);
	print_r($results);
	echo "<br><br>";
	foreach ($results as $result) {
		
	
	$update = array(

	'cantidad' => $_POST[$result['inventariodet_id']]
	);

	//Add the WHERE clauses
	$where_clause = array(
    'inventariodet_id' => $result['inventariodet_id']
	);

	$updated = $database->update( 'inventariodet', $update, $where_clause, 1 );

	}
	header("Location: /index.php?data=productos&op=inventario&coid=".$_POST['color_id']."&prid=".$_POST['prid']);

					//  /index.php?data=productos&op=inventario&prid=468

}


if ($_GET['func']=="cenabled")
{
// $_GET['enabled'];
$coid = $_GET['coid'];
$prid = $_GET['prid'];
$update = array(

	'enabled' => $_GET['enabled']
	);

//Add the WHERE clauses
$where_clause = array(
    'color_id' => $_GET['coid']
);

	$updated = $database->update( 'color', $update, $where_clause, 1 );


header("Location: /index.php?data=$data&op=inventario&prid=$prid&coid=$coid");
}


if ($_GET['func']=="c")
{
	
$eed=1;
// echo "<br><br>";          // ********DEBUG**********
// foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}
		


		$precio_compra=$_GET['precio_compra']/1.16;
		$precio_contado=$_GET['precio_contado']/1.16;
		$precio_credito=$_GET['precio_credito']/1.16;

//The fields and values to insert
	$registro = array(

	'activo'=>$_GET['activo'],
	'producto'=>$_GET['producto'],
	'codigo'=>$_GET['producto'],
	'subcategoria_id'=>$_GET['subcategoria_id'],
	'precio_compra'=>$precio_compra,
	'precio_contado'=>$precio_contado,
	'precio_credito'=>$precio_credito,
	'precio_promocion'=>$_GET['precio_promocion'],
	'descuento'=>$_GET['descuento'],
	'proveedor_id'=>$_GET['proveedor_id'],
	'stock' => 1,
	'marca_id'=>$_GET['marca_id'],
	'talla_id'=>$_GET['talla_id'],
	'unidad_id'=>$_GET['unidad_id'],
	'inventariable'=>$_GET['inventariable'],
	'up'=>$_GET['up'],
	'estilo'=>$_GET['estilo'],
	'temporada_id'=>$_GET['temporada_id']

		);


if ($_GET['producto'])
{
	$add_query = $database->insert( 'producto', $registro );
	$last_id = $database->lastid();
	$location="Location: /index.php?data=$data&op=detalles&prid=$last_id&eed=2";

	//$sku=sku13($last_id);

	$sku=sprintf('%04d', $last_id);
	$sku=$_GET['subcategoria_id'].$sku;


$update = array(

	'codigo' => $sku
	);

//Add the WHERE clauses
$where_clause = array(
    'producto_id' => $last_id
);

	$updated = $database->update( 'producto', $update, $where_clause, 1 );



}
else
		$location="Location: /index.php?data=$data&op=producto_form&f=agregar&eed=3";

header($location);



}

//************************************************************
if ($_GET['func']=="u")
{

 //echo "<br><br>";          // ********DEBUG**********
 //foreach ($_GET as $k => $v) { echo "<br>[$k] => $v \n";}



		$precio_compra=$_GET['precio_compra']/1.16;
		$precio_contado=$_GET['precio_contado']/1.16;
		$precio_credito=$_GET['precio_credito']/1.16;

$update = array(

	'activo'=>$_GET['activo'],
	'producto'=>$_GET['producto'],
	'subcategoria_id'=>$_GET['subcategoria_id'],
	'precio_compra'=>$precio_compra,
	'precio_contado'=>$precio_contado,
	'precio_credito'=>$precio_credito,
	'precio_promocion'=>$_GET['precio_promocion'],
	'descuento'=>$_GET['descuento'],
	'proveedor_id'=>$_GET['proveedor_id'],
	'marca_id'=>$_GET['marca_id'],
	'talla_id'=>$_GET['talla_id'],
	'unidad_id'=>$_GET['unidad_id'],
	'inventariable'=>$_GET['inventariable'],
	'up'=>$_GET['up'],
	'estilo'=>$_GET['estilo'],
	'temporada_id'=>$_GET['temporada_id']


	);

//Add the WHERE clauses
$where_clause = array(
    'producto_id' => $prid
);

	$updated = $database->update( 'producto', $update, $where_clause, 1 );

// //Output errors if they exist for the update query
//$database->display( $updated );

   header("Location: /index.php?data=$data&op=detalles&prid=$prid&eed=1");







}

?>