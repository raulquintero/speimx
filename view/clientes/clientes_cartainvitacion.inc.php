
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
		 $query = "SELECT apellidop, apellidom, nombre  FROM cliente 
			WHERE  cliente_id=".$cliente_id;
		list( $apellidop,$apellidom,$nombre ) = $database->get_row( $query );
			$cliente= $apellidop." ".$apellidom." ".$nombre;

						
						
				} 
 ?>


<div class="fecha">Mexicali a <?php echo date("d-m-Y")?></div>
<div class="header">
<img width=300 src="/img/tiendasalberto.png">
</div>

	<div class="destinatario">Apreciable <strong><?php echo strtoupper($cliente)?></strong></div>
	<div class="documento">
		<p>En <strong>Tiendas Alberto</strong> estamos interesados en apoyar la economia de las familias mexicalenses, esta ocasion en convenio 
		con <strong>Fruteria NENA'S</strong> reconociendo  a sus mas valiosos empleados, les extendiende esta carta invitacion para que 
		disponga inmediatamente de un <strong>CREDITO PRE APROBADO</strong> por la cantidad de:<br>    
		<center><h1><strong>$ 3 000.00 MXN</strong></h1></center>
		   <!-- para la adquision de productos en Tiendas Alberto. -->
		   <br><Br></p>

<div class="beneficios">
	<h3>Conoce nuestros beneficios:</h3>
	<ul>
		<li>Pagos Fijos</li>
		<li>Descuento Via Nomina</li>
		<li>Requisitos Minimos</li>
		<li>Plazo de 3 a 12 meses para liquidar tu adeudo</li>
		<li>Puedes incrementar tu credito hasta $7,000 MXN</li>
		<li>Sin penalizacion por pago anticipado</li>
	</ul>
</div>
	<p><br><Br><Br>Unicamente presente esta carta invitacion junto con una copia de su identificacion oficial a un representante o personalmente 
	en nuestra sucursal ubicada en Presa Lopez Zamora #1501, Col. 18 de Marzo, Mxl, B.C..</p>

</div>

<div class="conocenos"><br><br><br><br>VEN Y CONOCENOS!</div>

<div class="firma">
	<!-- <div>Atentamente</div>  -->
	<!-- <div><h2>Tiendas Alberto</h2></div> -->
</div>



</body>
</html>