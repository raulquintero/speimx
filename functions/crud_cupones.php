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

$bulk= isset($_GET['bulk']) ? $_GET['bulk'] : "";
$func= isset($_GET['func']) ? $_GET['func'] : "";
$cuid= isset($_GET['cuid']) ? $_GET['cuid'] : "";
$cupon= isset($_GET['cupon']) ? $_GET['cupon'] : "";
$fecha_ini= isset($_GET['fecha_ini']) ? fechaustomysql($_GET['fecha_ini']) : "";
$fecha_fin= isset($_GET['fecha_fin']) ? fechaustomysql($_GET['fecha_fin']) : "";
$cantidad=isset($_GET['cantidad']) ? $_GET['cantidad'] : "";
$cuantos=isset($_GET['cuantos']) ? $_GET['cuantos'] : "";
$cupontipo_id= isset($_GET['cupontipo_id']) ? $_GET['cupontipo_id'] : "";
$compra_minima=isset($_GET['compra_minima']) ? $_GET['compra_minima'] : "";
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
		$add_query = $database->insert( 'cupon', $cliente );
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

$updated = $database->update( 'cupon', $update, $where_clause, 1 );

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
$deleted = $database->delete( 'cupones', $delete );

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
$updated = $database->update( 'cupones', $update, $where_clause );

$location="Location: /index.php?data=cupones&op=generados&activo=0";
}

if ($func=="csv")
{

$query="select * from cupones where activo=0 ";

if ($bulk)
    $query.=" AND bulk=$bulk";


 	$results = $database->get_results( $query );

	        echo "<table>";

					foreach ($results as $row )
					{

	 				echo "<tr><td>";

						switch ($row['cupontipo_id']){
                            case 1: echo "$ ".dinero($row['cantidad'])." MX";break;
                            case 2: echo $row['cantidad']." %";break;
                            }

						echo ",".strtoupper($row['sku']).",".fechamysqltomx($row['fecha_ini'],"letra").",".fechamysqltomx($row['fecha_fin'],"letra");
                        echo ",$ ".dinero($row['compra_minima'])." MX<td><tr>";
					}
           	echo "</table>";



}

if ($location)  header($location);





function generar_cupones( $cuid,$cuantos,$admin_id,$fecha_ini,$fecha_fin)
{
$array=isset($array) ? $array : "";
$database = new DB();
echo $query = "SELECT cupon_id,cantidad,cupontipo_id,compra_minima FROM cupon WHERE cupon_id='$cuid' limit 1";
list( $cupon_id, $cantidad,$cupontipo_id,$compra_minima) = $database->get_row( $query );
$query = "SELECT sku FROM cupones  ORDER BY sku DESC limit 1";
list( $sku ) = $database->get_row( $query );
$query = "SELECT bulk FROM cupones  ORDER BY sku DESC limit 1";
list( $bulk ) = $database->get_row( $query );
$bulk=$bulk+1;

if ($sku==0) $sku="10102000320000";
$i=isset($i) ? $i : 30000;
$k=isset($k) ? : 0;

$residuo=$cuantos%5;
$cuantos=floor($cuantos/5);

while ($m<$cuantos){
    do {
        $sku=$sku+$i;
        $values.="('$cupon_id','$sku','$fecha_ini','$fecha_fin','$cantidad','$cupontipo_id','$compra_minima','0','$admin_id','$bulk'),";
        $k++;
    } while ($k < 5);
    $k=0;
    $m++;
    //echo $values."<br>";
    $longitud=strlen($values);
    $values[$longitud-1]=' ';
    $query="insert into cupones (cupon_id,sku,fecha_ini,fecha_fin,cantidad,cupontipo_id,compra_minima,activo,admin_id,bulk) values $values";
     $database->query($query);
    $values="";
 };


if ($residuo){
    do {
        $sku=$sku+$i;
        $values.="('$cupon_id','$sku','$fecha_ini','$fecha_fin','$cantidad','$cupontipo_id','$compra_minima','0','$admin_id','$bulk'),";
        $k++;
    } while ($k < $residuo);
      //echo $values;
     $longitud=strlen($values);
    $values[$longitud-1]=' ';
    $query="insert into cupones (cupon_id,sku,fecha_ini,fecha_fin,cantidad,cupontipo_id,compra_minima,activo,admin_id,bulk) values $values";
    $database->query($query);
};

 return 0;

}












?>