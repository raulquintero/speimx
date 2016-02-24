

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

div.back{
	width:343;
	height:207;
	margin:16px 11px;
	border: 0px dashed #555;
	
}


div.image{
	width:343;
	height:215;
	margin:10px 11px;
	border: 3px dashed #555;
	background-size: 350px 140px;
    background-repeat: no-repeat;
background-image: url("http://speimx.dev/logo.jpg");
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
	font-family: verdana,arial;
}

div.text span{
	text-align:center;
	color:black;
	font-size: 48px;
	background-color:white;

	
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





<table cellpadding=0 cellspacing=3>
<?php 

$bulk=isset ($_GET['bulk']) ? $_GET['bulk'] : "0";



	$query = "SELECT sku,fecha_ini,fecha_fin,cantidad,cupontipo.cupontipo_id,cupontipo,compra_minima,bulk
    FROM cupones,cupontipo
    where cupones.cupontipo_id=cupontipo.cupontipo_id AND cupones.bulk=$bulk ";
$results = $database->get_results( $query );

foreach( $results as $row )
	foreach ($row as $k => $v)

{
    
    
?>
	
<tr>
	<td style="border-bottom:1px dotted gray;">
<div class="image">
		<div class="header">
			DESCUENTO
		</div>
	<div class="box">
		<div class="text"><br>
		<span>$ <?php echo dinero($row['cantidad'])?> MX</span>
			<br>
			COMPRA MINIMA: $ <?php echo dinero($row['compra_minima'])?> MX
			<br>
			<font color=red>Vence: <?php fechamysqltomx($row['fecha_fin'],"letra")?></font>
		</div>
			<div class="footer">
			<?php echo "<img width=320 src=\"barcode_cupon.php?text=".$row['sku']."\" alt=\"barcode\" />";?>
			
			Terminos y condiciones al reverso.
		
		</div>
	</div>
	</div>
</td>
<td style="border-bottom:1px dotted gray;">
<div class="image">
		<div class="header">
			DESCUENTO
		</div>
	<div class="box">
		<div class="text"><br>
		<span>$100.00 MX</span>
			<br>
			COMPRA MINIMA: $ 500.00 MX
			<br>
			<font color=red>Vence: 02-Feb-2016</font>
		</div>
			<div class="footer">
			<?php echo "<img width=320 src=\"barcode_cupon.php?text=12345678901234\" alt=\"barcode\" />";?>
			
			Terminos y condiciones al reverso.
		
		</div>
	</div>
	</div>
</td>
</tr>

<?php } ?>


</table>




</div>
<?php

foreach ($results as  $c) { 
	//foreach ($c as $k=>$v )
	{
	echo "<br>[$ko] => $vo \n";
	echo "<br>--".$v;
	}
echo "<br>";
}

?>