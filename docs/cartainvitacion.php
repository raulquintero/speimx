
<?php

$cliente=$_GET['cliente'];
?>

<html>
<head>
	<title></title>

<style type="text/css">

body{
	font-family: "courier";
	font-size;12px;
	width:800px;
}

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
	width:800px;
	text-align:justify;
	text-indent: 20px;
}
.documento-strong{
	font-size: 20px;
}

.conocenos{
	height: 100px;
	vertical-align: middle;
	text-align: center;
	font-weight: bold;

}
.firma{
	height: 70px;
	text-align: center;
	padding: 0px;
	font-weight: bold;

}
.fecha{
	text-align: right;
}

</style>	
</head>
<body>
	<?php echo getcwd() ?>
<div class="fecha">Mexicali a <?php echo date("d-m-Y")?></div>
<div class="header">
<img width=300 src="/img/tiendasalberto.png">
</div>

	<div class="destinatario">Apreciable <strong><?php echo strtoupper($cliente)?></strong></div>
	<div class="documento">
		<p>En <strong>Tiendas Alberto</strong> estamos interesados en apoyar la economia de las familias mexicalenses, y para esta ocasion en conjunto 
		con <strong>Fruteria NENA'S</strong> reconocemos a los mejores empleados, extendiendole esta carta invitacion con la finalidad de que 
		disponga inmediatamente de un <strong>CREDITO PRE APROBADO</strong> por la cantidad de:    
		<strong>$ 3 000.00 MXN</strong>    para la adquision de productos en Tiendas Alberto.</p>

<div class="beneficios">
	<h3>Conoce nuestros beneficios:</h3>
	<ul>
		<li>Pagos Fijos</li>
		<li>Descuento Via Nomina</li>
		<li>Plazo de 3 a 12 meses para liquidar tu adeudo</li>
		<li>Puedes incrementar tu credito hasta $7,000 MXN</li>
		<li>Sin penalizacion por pago anticipado</li>
	</ul>
</div>
	<p>Unicamente presente esta carta invitacion junto con una copia de su identificacion oficial a un representante o personalmente 
	en nuestra sucursal ubicada en Presa Lopez Zamora #1501, Col. 18 de Marzo, Mxl, B.C..</p>

</div>

<div class="conocenos"><br><br>VEN Y CONOCENOS!</div>

<div class="firma">
	<div>Atentamente</div> 
	<div>Tiendas Alberto</div>
</div>



</body>
</html>