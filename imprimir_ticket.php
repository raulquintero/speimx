
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

<html>
<head>
	<title></title>
	<style type="text/css">
	body{
		font-family: arial, helvetica;
		font-size: x-small; 
	}
	table{
		font-size: small;
	}

	</style>
</head>
<body onload="window.print()">

				<?php 
			//$cid = $_SESSION['cliente_id'];

			$fid=$_GET['fid'];
		


			if($fid)
				{
					$query = "SELECT cliente.cliente_id,apellidop, apellidom, nombre, credito, saldo,total_ultimo,factura.fecha, abono,factura_id,
							tipomov_id,fecha,saldo_actual,saldo_total,ticket  FROM cliente,factura 
						WHERE  factura.cliente_id=cliente.cliente_id AND factura.factura_id='".$fid."'";
					list( $cliente_id,$apellidop,$apellidom,$nombre,$credito, $saldo, $total_ultimo, $fecha_factura,$abono, $factura_id,
							 $tipomov_id,$fecha_factura,$saldo_actual,$saldo_total,$ticket  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;
	 				$nombre_completo = $apellidop." ".$apellidom." ".$nombre;
						
					// echo "<div class=\"alert alert-info\">
		 		// 	<a href=/functions/cart.php?func=del_cliente&cid=".$row['cliente_id']."><button type=\"button\" class=\"close\" >×</button></a>
					// <strong>Cliente: </strong><a href=\"/index.php?data=clientes&op=detalles&h=1&cid=$cliente_id\" >".$cliente."</a> <strong>Saldo: </strong>$ ". dinero($saldo)." 
					// <br><strong>Credito: </strong>$ ".dinero($credito)."<strong> Credito Total Disponible: </strong>$ ".dinero($credito-$saldo)."</div> ";
						
				} 
				

		?>


<div class="box-content span12" >

					<div class=" span4" styles='border:1px dotted'>
						
				
						<?php 
						if ($factura_id)
						{
							$no_ticket=sprintf('T%06d', $factura_id);

							echo "<table width=350><tr><td>";
							getticket($factura_id);      // formato.php
				
							
							echo "<center>";

							if ($cliente_id)
							{
							echo "<br><Br><br><br>

							_______________________<br>";
							echo strtoupper($nombre_completo);
							}
							echo "<br><br><br>";

							echo " <img width=200 src=\"barcode.php?text=".$no_ticket."\" alt=\"barcode\" />";
							
							echo "<br><br>
						 	http://tiendasalberto.com<br>";
						 
						 	echo $ticket;
						 	echo "<br>
							</center>
							<br><Br>";
							echo "</td><td>&nbsp;</td></tr></table>";
						}
					



						else
							echo "<div class=\"alert alert-error \">
							AVISO: No se genero la nota de venta.</div> ";
						
						;?>


						<div class="clearfix">
						</div>
				</div>


				<!-- **********************************endd  ticket********************* -->
			<div class="row-fluid condensed">	

				<div class="box-content span6">
				<table cellpadding=5 width=350>
					<tr><td>	
					<?php if ($tipomov_id==3) plandepagos($saldo_total,$fecha_factura,$abono,$saldo);?>
					</td><td>&nbsp;</td></tr>
				</table>
					</div>
			</div>

			<div class="row-fluid condensed">	

				<div class="box-content span6">
				<table width=350>
					<tr><td>	
						
						Recuerde que:<br>
						Todas las ventas son VENTAS FINALES, <br>
						NO se regresa dinero, solo se cambia por mercancia dentro de los primeros 7 dias, 
						es requisito indispensable presentar este ticket, y la mercancia con sus etiquetas
						Recuerde ser puntual en sus pagos, el no cumplir a tiempo con sus pagos
						puede afectar su credito
						<br><br>
						<center>
						<br>Gracias por su preferencia.</center><br>
						<center>
						Tiendas Alberto
						<br>Av. Presa Lopez Zamora #1501 <br>Col. Venustiano Carranza<br>
								</center>
						<br><br>

					</td><td>&nbsp;</td></tr>
				</table>
					</div>
			</div>


</div>





</body>
</html>