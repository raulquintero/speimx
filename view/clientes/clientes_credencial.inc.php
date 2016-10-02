
<?php

$cliente_id = $_GET['cid'];?>

<html>
<head>
	<title></title>

<style type="text/css">


.credencial {
	width:280px;
}
.destinatario{
	/*height:50px;*/
	text-transform: uppercase;
	font-size: 8pt;
	text-align: center;
}
	

.header{
	height: 50px;
	text-align: left;

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
		 $query = "SELECT cliente_id,codigo_cliente,apellidop, apellidom, nombre, empresa  FROM cliente,empresa
			WHERE  cliente.empresa_id=empresa.empresa_id AND cliente_id=".$cliente_id;
		list( $cliente_id,$codigo_cliente,$apellidop,$apellidom,$nombre,$empresa ) = $database->get_row( $query );
			$apellidos= $apellidop." ".$apellidom;

						
						
	   //	$codigo_cliente="C".$codigo_cliente;
	} 


 ?>
<div class="credencial">

<div><table width=100%>
	<tr>
		<td >
<img width=200 src="/img/tiendasalberto.png">
			<div class="destinatario">Nombre:<br> <strong><?php echo strtoupper($apellidos)?><br>
			<?php echo strtoupper($nombre)?></strong></div>
		</td>
		
		<td><img width=100 src=/img/noimage.png align=right></td>
	</tr>
		<td>&nbsp;</td>
	</table>
</div>
<div class="header">
			<img width=250 src="barcode.php?text=<?php echo $codigo_cliente?>" alt="<?php echo $codigo_cliente ?>" />

<!-- <div class="fecha">Mexicali a <?php echo date("d-m-Y")?></div> -->
</div>
	
<!-- 	<div class="documento">
		<p>En <strong>Tiendas Alberto</strong> estamos interesados en apoyar la economia de las familias mexicalenses, en convenio 
		con <strong><?php echo $empresa?></strong> reconociendo  a sus exelentes empleados, les ofrece este 
		 <strong style="backgorund:red;">CREDITO PRE APROBADO</strong> por la cantidad de:<br>    
		<center><h1><br><strong>$ 3 000.00 MXN</strong></h1></center>
		   </p>

	<p><Br><Br>Unicamente presente esta carta  y una identificacion oficial a un representante o personalmente 
	en nuestra sucursal ubicada en Av. Presa Lopez Zamora #1501, Col. 18 de Marzo, Mxl, B.C..</p>

	<br><br>
<div class="beneficios">
	<h3>Conoce nuestros beneficios:</h3>
	<ul>
		<li>Descuento Via Nomina</li>
		<li>Requisitos Minimos</li>
		<li>Plazo de 3 a 12 meses para liquidar tu adeudo</li>
		<li>Puedes incrementar tu credito hasta $7,000 MXN</li>
		<li>Sin penalizacion por pago anticipado</li>
	</ul>
</div>

</div>

<div class="conocenos"><br><br><br><br>VEN Y UTILIZA TU CREDITO INMEDIATAMENTE</div>

 -->



</div>
</body>
</html>