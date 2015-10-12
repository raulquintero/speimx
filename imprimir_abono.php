
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
	body {
		font-family: verdana,arial;
	}
	</style>
</head>
<body onload="window.print()">

				<?php 
			//$cid = $_SESSION['cliente_id'];

			$mid=$_GET['mid'];
		


			if($mid)
				{
					
					$query = "SELECT cliente.cliente_id,apellidop, apellidom, nombre, credito, saldo,total_ultimo,fecha_total_ultimo, abono,
							tipomov_id,fecha,saldo,movimiento_id,cantidad  FROM cliente,movimiento 
						WHERE  movimiento.cliente_id=cliente.cliente_id AND movimiento.movimiento_id=".$mid;
					list( $cliente_id,$apellidop,$apellidom,$nombre,$credito, $saldo, $total_ultimo, $fecha_total_ultimo,$abono, 
							 $tipomov_id,$fecha,$saldo,$movimiento_id,$cantidad  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;
						
				
				} 
				

		?>


<div class="box-content span12" >

					<div class=" span4" styles='border:1px dotted'>
						
				
						<?php 
						if ($movimiento_id)
						{
							$no_ticket=sprintf('A%06d', $movimiento_id);

							echo "<table width=380><tr><td>";
							getabono($movimiento_id);   //formato.php
										
							echo "<br>";
							echo "</td><td>&nbsp</td></tr>";
							echo "<tr><td><br><br><Br><center><img width=200 src=\"barcode.php?text=".$no_ticket."\" alt=\"barcode\" /></center></td></tr>";
							echo "</table>";

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

				

			<div class="row-fluid condensed">	

				<div class="box-content span6">
				<table width=380>
					<tr><td style="text-align:center">	
						<br><br><br>
						Gracias por su preferencia.<br><br>
						Recuerde ser puntual en sus pagos, el no cumplir a tiempo con sus pagos
						puede afectar su credito
						<br><br><br><br>
					</td><td>&nbsp;</td></tr>
				</table>
					</div>
			</div>


</div>





</body>
</html>