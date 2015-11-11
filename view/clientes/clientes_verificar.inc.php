
<?php

$cliente_id = $_GET['cid'];
$cliente_id=substr($cliente_id,1,6);
$codigo_cliente=substr($_GET['cid'],1);

?>
<html>
<head>
	<title></title>

<style type="text/css">


.credencial {
	width:300px;
}
.destinatario{
	/*height:50px;*/
	text-transform: uppercase;
	font-size: 12pt;
	text-align:center;
}
	

.header{
	height: 50px;
	text-align: center;

}
.beneficios{
	text-indent: 20px;
}
.documento{
	padding-left:50px;
	width:650px;
	text-align:justify;
	text-indent: 20px;
}
.documento-strong{
	font-size: 20px;
}

.conocenos{
	width:800px;
	height: 100px;
	vertical-align: middle;
	text-align: center;
	font-weight: bold;

}
.firma{
	width:800px;
	height: 70px;
	text-align: center;
	padding: 0px;
	font-weight: bold;

}
.fecha{
	text-align: left;
	width:700px;
}

</style>	
</head>
<body>
<?php 
if($cliente_id)
	{
		$query = "SELECT cliente_id,apellidop, apellidom, nombre, empresa  FROM cliente,empresa
			WHERE  cliente.empresa_id=empresa.empresa_id AND codigo_cliente='".$codigo_cliente."'";
		list( $cliente_id,$apellidop,$apellidom,$nombre,$empresa ) = $database->get_row( $query );
			$apellidos= $apellidop." ".$apellidom;

						
						
		$cliente_id=sprintf('C%06d', $cliente_id);
	} 

if ($nombre)
{
 ?>
<div class="box-content span4 hidden-tablet">

<div class="header">

<img width=200 src="/img/tiendasalberto.png">
<!-- <div class="fecha">Mexicali a <?php echo date("d-m-Y")?></div> -->
</div>
<div><table width=100%>
	<tr><td>&nbsp;</td>
		<td ><center>
			<imge width=150 src="barcode.php?text=<?php echo $cliente_id?>" alt="barcode" /></center>
			<div class="destinatario"><br> <strong><?php echo strtoupper($apellidos)?><br>
			<?php echo strtoupper($nombre)?></strong></div>
		</td>
		
		<td><img width=100 src=/img/noimage.png align=right></td>
	</tr>
	<tr><td colspan=4><center><br>Si NO aparece la foto, verifique identidad con una identificacion oficial.<br><br>Es correcta la informacion?<br><br> 

<a href="/index.php?data=pos" class="btn" data-dismiss="modal">NO</a>
<a href="/functions/cart.php?func=sel_cliente&cid=<?php echo $cliente_id?>" class="btn btn-primary" data-dismiss="modal">SI</a>

		</center></td></tr>
	</table>
</div>

</div>
	
<?php 

}


else
	echo "no existe";
 ?>


</div>
</body>
</html>