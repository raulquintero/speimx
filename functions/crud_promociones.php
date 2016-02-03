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


$data=isset($_POST['data']) ? $_POST['data'] : "";
$op=isset($_POST['op']) ? $_POST['op'] : "";
$i=isset($_POST['i']) ? $_POST['i'] : "";
$func=isset($_POST['func']) ? $_POST['func'] : "";
$temporada_id=isset($_POST['temporada_id']) ? $_POST['temporada_id'] : "" ;
$porcentaje=isset($_POST['porcentaje']) ? $_POST['porcentaje'] : "" ;


if ($func=="c")
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






if ($func=="u")
{

    // echo "<br><br>";          // ********DEBUG**********
     //foreach ($_POST as $k => $v) { echo "<br>[$k] => $v \n";}


    $update = array(
        'descuento'=>$porcentaje
    );

    //Add the WHERE clauses
    $where_clause = array(
        'temporada_id' => $temporada_id
    );

	$updated = $database->update( 'temporada', $update, $where_clause, 1 );

// //Output errors if they exist for the update query
//$database->display( $updated );


    // echo "Location: /index.php?data=$data&eed=1";
  	header("Location: /index.php?data=$data&eed=1");


}

if ($func=="a")
{

    // echo "<br><br>";          // ********DEBUG**********
     //foreach ($_POST as $k => $v) { echo "<br>[$k] => $v \n";}


    $query = "SELECT descuento  FROM temporada where temporada_id=$temporada_id ";
    list( $porcentaje ) = $database->get_row( $query );

    if ($i){
    $update = array('descuento'=>$porcentaje);
    //Add the WHERE clauses
    $where_clause = array('temporada_id' => $temporada_id,'descuento' => $porcentaje);
	$updated = $database->update( 'producto', $update, $where_clause, 1 );
    }
    else
    {
        $query="UPDATE producto SET `descuento` = '$porcentaje' WHERE temporada_id = '$temporada_id' AND descuento <> '$porcentaje'";
        $database->query($query);
       //$result = $database->get_results( $query );
    }
    // echo "Location: /index.php?data=$data&eed=1";
   	header("Location: /index.php?data=$data&eed=1");







}




?>