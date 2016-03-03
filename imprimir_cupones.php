

<?php
require_once('config/config.php');

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

?>

<style type="text/css">

div{
	margin:0px;
	padding:0px;
}

div.back{

	width:343;
	height:207;
	margin:16px 11px;
	border: 0px dashed #555;
	
}


div.image{
	width:341;
	height:216;
	margin:10px 11px;
	border: 3px dashed #555;
	background-size: 350px 140px;
    background-repeat: no-repeat;
background-image: url("/img/logo.jpg");
background-position: 0px 18px; 	
display: inline-block;
z-index: -2;
}

div.box{
	width:330px;
	height:126px;
	margin:0px 10px;
	background-color:#fff;
	border:0px solid black;
	opacity:0.75;
	filter:alpha(opacity=60);
z-index: :-1;
}

div.text{
	width:330px;
	height:125px; /*180*/
	opacity:1.0;
	filter:alpha(opacity=100.0);
	text-align:center;
	font-weight:bold;
	color:black;
	font-size:14px;
	font-family: verdana,arial;
}

div.text span{
	text-align:center;
	color:black;
	font-size: 44px;
	background-color:white;

	
}

div.text h2{
	text-align:center;
	color:white;
	font-size: 14px;
	background-color:#ff2826;

	
}



div.header{
	display: block;
	margin:px;
	padding: 6px;	
	color:white;
	font-weight: bold;
	text-align:center;
	background-color: #336699;
}
div.footer{
	display:block;padding:3px;border:1px solid #33669;color:black;text-align:center;
	font-family: arial,verdana;
}
</style>




<div>
<?php 

$bulk=isset ($_GET['bulk']) ? $_GET['bulk'] : "0";
	$query = "SELECT sku,fecha_ini,fecha_fin,cantidad,cupontipo.cupontipo_id,cupontipo,compra_minima,bulk
    FROM cupones,cupontipo
    where cupones.cupontipo_id=cupontipo.cupontipo_id AND cupones.bulk=$bulk ";
	$results = $database->get_results( $query );

foreach( $results as $row )
{
?>

<div class="image">
		<div class="header">
			AHORRA
		</div>
	<div class="box">
		<div class="text"><br>
		<span>$ <?php echo dinero($row['cantidad'])?> MX</span>
			<br>
			COMPRA MINIMA: $ <?php echo dinero($row['compra_minima'])?> MX
			<br>
			<?php 
			if ($row['fecha_ini']<=date("Y-m-d"))
				echo "<h2>Vence: ".fechamysqltomx($row['fecha_fin'],"letra")."</h2>";
			else
				echo "<h2>Vigencia ".fechamysqltomx($row['fecha_ini'],"letra")." al ".fechamysqltomx($row['fecha_fin'],"letra")."</h2>";
			?>
		</div>
			<div class="footer">
			<?php echo "<img width=320 src=\"barcode_cupon.php?text=".$row['sku']."\" alt=\"barcode\" />";?>
			
			Terminos y condiciones al reverso.
		
		</div>
	</div>
	</div>

<?php } ?>

</div>
