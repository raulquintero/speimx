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
							getticket($factura_id);
				
							echo "<br><Br>

							<center>
							_______________________<br>";
							echo strtoupper($nombre_completo);
							echo "</center>
							<center><br><br>
						 	http://tiendasalberto.com<br>";
						 
						 	echo $ticket;
						 	echo "<br>
							</center>
							<br><Br>";
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

				<div class="box-content span4">
			<?php if ($tipomov_id==3) plandepagos($saldo_total,$fecha_factura,$abono,$saldo);?>
					</div>
			</div>
</div>