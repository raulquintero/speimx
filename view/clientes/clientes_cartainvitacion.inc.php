
<?php

$cliente_id = $_SESSION['cliente_id'];?>

<html>
<head>
	<title></title>

<style type="text/css">



.destinatario{
	height:50px;
	text-transform: uppercase;
}
	

.header{
	height: 150px;

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
	text-align: right;
	width:700px;
}

</style>	
</head>
<body>
<?php 
if($cliente_id)
	{
		 $query = "SELECT apellidop, apellidom, nombre, empresa  FROM cliente,empresa
			WHERE  cliente.empresa_id=empresa.empresa_id AND cliente_id=".$cliente_id;
		list( $apellidop,$apellidom,$nombre,$empresa ) = $database->get_row( $query );
			$cliente= $apellidop." ".$apellidom." ".$nombre;

						
						
				} 
 ?>


<div class="header">
<img width=300 src="/img/tiendasalberto.png">
<div class="fecha">Mexicali a <?php echo date("d-m-Y")?></div>
</div>

	<div class="destinatario">Apreciable <strong><?php echo strtoupper($cliente)?></strong></div>
	<div class="documento">
		<p>En <strong>Tiendas Alberto</strong> estamos interesados en apoyar la economia de las familias mexicalenses, en convenio 
		con <strong><?php echo $empresa?></strong> reconociendo  a sus exelentes empleados, les ofrece este 
		 <strong style="backgorund:red;">CREDITO PRE APROBADO</strong> por la cantidad de:<br>    
		<center><h1><br><strong>$ 3 000.00 MXN</strong></h1></center>
		   <!-- para la adquision de productos en Tiendas Alberto. -->
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

<div class="firma">
	<!-- <div>Atentamente</div>  -->
	<!-- <div><h2>Tiendas Alberto</h2></div> -->
</div>



</body>
</html>