<?php 


if($_GET['cid'])
				{
					$query = "SELECT cliente_id,apellidop, apellidom, nombre, domicilio_casa, colonia,credito,empresa.empresa_id, empresa,empresa.domicilio  FROM cliente ,colonia,empresa
						WHERE  cliente.colonia_casa_id=colonia.colonia_id AND cliente.empresa_id=empresa.empresa_id AND cliente_id=".$_GET['cid'];
					list( $cliente_id,$apellidop,$apellidom,$nombre,$domicilio,$colonia, $credito, $empresa, $domicilio_empresa  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;

	 				
	 					$contrato=sprintf('%06d', $cliente_id);
	 				}
 ?>

<style>
.carta
{
	width: 660px;
	text-align: justify;
	font-size: 14pt;
}
</style>





<div class=carta>
	<center><img width=400 src="/img/tiendasalberto.png"></center>
<br><br>

<table width=100% border=1>
	<!-- <tr><td>FOLIO:</td><td></td></tr> -->
	<tr><td>No. de Credito:</td><td><?php echo strtoupper($contrato)?></td></tr>
	<tr><td>Nombre del Trabajador:</td><td><?php echo strtoupper($cliente)?></td></tr>
<?php
	echo "<tr><td>Domicilio del Trabajador:</td><td>".strtoupper($domicilio)."</td></tr>";
	if ($empresa_id)
	{
		echo "<tr><td>Nombre de la Empresa:</td><td>".strtoupper($empresa)."</td></tr>";
		echo "<tr><td>Domicilio de la Empresa:</td><td>".strtoupper($domicilio_empresa)."</td></tr>";
	}
?>
	<tr><td>Importe del Credito Autorizado:</td><td><?php echo " $ ".dinero($credito)?>M.N.</td></tr>
</table>
<br>
<?php

if($empresa_id)
echo "<p>
Manifiesto mi consentimiento para que el monto del crédito autorizado por Tiendas Alberto sea descontado vía nómina por mi patrón, en las fechas correspondientes.<br>
Si no se hacen los descuentos vía nómina para la amortización del crédito otorgado “el suscriptor” se compromete a pagar directamente en el domicilio de la Tiendas Alberto.
</p>";
else
echo "<p>Manifiesto estar deacuerdo en pagar el credito otorgado directamente en el domicilio de Tiendas ALberto.</p>";

?>

<span>PAGARÉ</span>
<br>
<p>
Por el presente pagaré reconozco y me obligo a pagar incondicionalmente en esta ciudad o en cualquier otro lugar que se me requiere de pago al Sr. Raul Alberto Quintero Cifuentes, 
en el domicilio de Tiendas Alberto cito, Presa López Zamora 1501, col. 18 de Marzo de esta ciudad, a su orden el día ________________, la cantidad de IMPORTE 
( <?php echo strtoupper(num2letra($credito)) ?>).
<br><br>
Este pagaré es mercantil y será regido por lo previsto en los artículos 170, 171, 172, 173 parte final, 174 y correlativos de la Ley General de Títulos y Operaciones de Crédito, 
por no ser pagaré domiciliado.
<br><br>
De no verificarse el pago de la cantidad que el presente pagaré expresa el día de su vencimiento, abonare  y pagaré un interés del 5% mensual , sobre saldos insolutos  por todo el 
tiempo que se encuentre vencido  por todo el tiempo  que se encuentre en mora, sin perjuicios al cobro y pago de todos los gastos que origine, incluyendo los gastos y costos en caso 
de juicio. 
<br><br>
Otorgado al día de su firma, en la ciudad de Mexicali, Baja California. 
</p>

<br><br><br>
<center>
___________________________________
<br>
Nomnbre y Firma del Trabajdor
</center>
</div>