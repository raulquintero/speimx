
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
		font-size: small;
	}
	table{
		font-size: medium;
	}

	</style>
</head>
<body onloaded="window.print()">

				<?php
			//$cid = $_SESSION['cliente_id'];

			$peid=$_GET['peid'];



			if($peid)
				{
                    $query="SELECT pedido.pedido_id,pedido.total,pedido.anticipo,pedido_nombre.nombre from pedido,pedido_nombre
                        where pedido.pedido_nombre_id=pedido_nombre.pedido_nombre_id AND pedido.pedido_id=".$peid;
                    list( $pedido_id,$total,$anticipo,$nombre) = $database->get_row( $query );

					// echo "<div class=\"alert alert-info\">
		 		// 	<a href=/functions/cart.php?func=del_cliente&cid=".$row['cliente_id']."><button type=\"button\" class=\"close\" >×</button></a>
					// <strong>Cliente: </strong><a href=\"/index.php?data=clientes&op=detalles&h=1&cid=$cliente_id\" >".$cliente."</a> <strong>Saldo: </strong>$ ". dinero($saldo)."
					// <br><strong>Credito: </strong>$ ".dinero($credito)."<strong> Credito Total Disponible: </strong>$ ".dinero($credito-$saldo)."</div> ";

				}


		?>


<div class="box-content span12" >

					<div class=" span4" styles='border:1px dotted'>


						<?php
						if ($pedido_id)
						{
							$no_ticket=sprintf('P%06d', $pedido_id);

							echo "<table width=350><tr><td>";
							getticket_pedido($pedido_id);      // formato.php


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

						<?php if ($tipomov_id==3)
						echo "Recuerde ser puntual en sus pagos, el no cumplir a tiempo con sus pagos
						puede afectar su credito";
						?>

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