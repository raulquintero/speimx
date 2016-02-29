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

$isid= isset($_GET['isid']) ? $_GET['isid'] : "";
$code= isset($_GET['code']) ? $_GET['code'] : "";
$cuid= isset($_GET['cuid']) ? $_GET['cuid'] : "";
$func= isset($_GET['func']) ? $_GET['func'] : "";
$fecha_ini= isset($_GET['fecha_ini']) ? fechaustomysql($_GET['fecha_ini']) : "";
$fecha_fin= isset($_GET['fecha_fin']) ? fechaustomysql($_GET['fecha_fin']) : "";
$cantidad=isset($_GET['cantidad']) ? $_GET['cantidad'] : "";
$cuantos=isset($_GET['cuantos']) ? $_GET['cuantos'] : "";
$cupontipo_id= isset($_GET['cupontipo_id']) ? $_GET['cupontipo_id'] : "";
$compra_minima=isset($_GET['compra_minima']) ? $_GET['compra_minima'] : "";
$location= isset($_GET['location']) ? $_GET['location'] : "";





if ($func=="c")
{

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
//Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$query = array(
    'fecha_ini'=>date("Y-m-d G:i:s"),
    'fecha_fin'=>$cupontipo_id,
    'admin_id'=>$_SESSION['user_id'],
    'status_id'=>'4'
    );

    $add_query = $database->insert( 'inventarios', $query );
        $inventarios_id = $database->lastid();
    
$query = "SELECT producto_id,cantidad,talladet_id,color_id,codigo from inventariodet";
echo "registros: ".$cuantos= $database->num_rows($query);

echo "<br>ciclos: ".$ciclos=floor($cuantos/20);
echo "<br>residuo: ".$residuo=floor($cuantos%20);
echo "<br>";

$results = $database->get_results( $query );

            
$n=0;
$m;
$query="insert into inventariosdet (inventarios_id,producto_id,sistema,inventario,talladet_id,color_id,codigo) values ";
                    foreach ($results as $row )
                    {

                        $query .= " ('".$inventarios_id."','".$row['producto_id']."','".$row['cantidad']."','0','".$row['talladet_id']."','".$row['color_id']."','".$row['codigo']."')";
                
                        if ($n<$ciclos) $query.=","; else $query.=";";
                         if ($n>=$ciclos) {
                          $n=0;
                            mysqli_query($con,$query);
                            $query;
                             $query="insert into inventariosdet (inventarios_id,producto_id,sistema,inventario,talladet_id,color_id,codigo) values ";

                          }
                        $n++;
                        $m++;
                    }

$query[strlen($query)-1]=';';
//echo "$query<br>Total: ".$m;
                             
//if ($residuo) 
  mysqli_query($con,$query); // or die(mysql_error());

        
mysqli_close($con);
$location="Location: /index.php?data=inventarios";

}



if ($func=="i")
{
 $query="SELECT inventario from inventariosdet where inventarios_id='$isid' AND codigo=$code";
  list($inventario)=$database->get_row($query);
  $update = array(
    'inventario'=>$inventario+1  
  );
//Add the WHERE clauses
$where_clause = array(
    'codigo' => $code,
    'inventarios_id'=> $isid
);

$updated = $database->update( 'inventariosdet', $update, $where_clause, 1 );

  $location="Location: /index.php?data=inventarios&op=detalle&isid=$isid&code=$code";
}


echo "func: ".$func;

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

						echo ",*".strtoupper($row['sku'])."*,".fechamysqltomx($row['fecha_ini'],"letra").",".fechamysqltomx($row['fecha_fin'],"letra");
                        echo ",$ ".dinero($row['compra_minima'])." MX<td><tr>";
					}
           	echo "</table>";



}

if ($location)  header($location);











?>