
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
	
</head>
<body conload="window.print()">

				<?php 
			//$cid = $_SESSION['cliente_id'];

			echo "hola".$mid=$_GET['mid'];
		


			if($mid)
				{
					
					$query = "SELECTa cliente.cliente_id,apellidop, apellidom, nombre, credito, saldo,total_ultimo,fecha_total_ultimo, abono,
							tipomov_id,fecha,saldo,movimiento_id,cantidad  FROM cliente,movimiento 
						WHERE  movimiento.cliente_id=cliente.cliente_id AND movimiento.movimiento_id=".$mid;
					list( $cliente_id,$apellidop,$apellidom,$nombre,$credito, $saldo, $total_ultimo, $fecha_total_ultimo,$abono, 
							 $tipomov_id,$fecha,$saldo,$cantidad  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;
						
				
				} 
				

		?>


<div class="box-content span12" >

					<div class=" span4" styles='border:1px dotted'>
						
				
						<?php 
						if ($movimiento_id)
						{
							echo "<table width=380><tr><td>";
							getabono($mid);
										
							echo "<br><Br><br><br>

							<center>
							_______________________<br>";
							echo strtoupper($nombre_completo);
							echo "</center>
							<center><br><br>
						 	http://tiendasalberto.com<br>";
						 
						 	echo $ticket;
						 	echo "<br>
							</center>
							<br><Br><br><br>";
							echo "</td></tr></table>";
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
				<table width=380>
					<tr><td>	
					<?php if ($tipomov_id==3) plandepagos($saldo_total,$fecha_factura,$abono,$saldo);?>
					</td></tr>
				</table>
					</div>
			</div>

			<div class="row-fluid condensed">	

				<div class="box-content span6">
				<table width=380>
					<tr><td>	
						<br><br><br>
						Gracias por su preferencia.<br><br>
						Recuerde ser puntual en sus pagos, el no cumplir a tiempo con sus pagos
						puede afectar su credito
						<br><br><br><br>
					</td></tr>
				</table>
					</div>
			</div>


</div>





</body>
</html>