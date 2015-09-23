<div class="box span12">
		<div class="row-fluid condensed">	

				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Nota de Venta</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
		
<?php

	getfactura($_GET['fid']);

?>

					</div>
				</div>


				<div class="box span6">

							  		<?php view_devoluciones($_GET['fid'])?>
					
				</div><!--/span-->




		</div>
</div>



	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Cerrar Venta</h3>
		</div>
		<div class="modal-body">

		<?php	
			if ($_SESSION['cliente_id'])
			{
				echo "<p> Tipo de Venta: <span class=\"label label-inverse\">Credito</span><br><br>
					Cliente: <strong>$cliente</strong></p><br>
					<table width=100%><tr>
					<td style='text-align:right'>SubTotal:</td><td width=100 style='text-align:right'> $". dinero($total_credito)."</td></tr>";
								echo "<tr><td style='text-align:right'>&nbsp;IVA(16%)</td><td style='text-align:right;border-bottom:2px solid;'>+&nbsp;".dinero($total_iva_credito)."</td></tr>";	
								echo "<tr><td style='text-align:right'>&nbsp;<strong>Total</strong></td><td style='text-align:right;'><strong>".dinero($total_iva_credito+$total_credito)."</strong></td></tr>";	
								echo "<tr><td>&nbsp;</td></tr>";
								echo "<tr><td style='text-align:right'>Saldo Actual</td><td style='text-align:right'>+ &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;$ ".dinero($saldo)."</td></tr>";	
					echo "<tr><td style='text-align:right'>Saldo Nuevo:</td><td style='text-align:right;border-top:2px solid black;'> $ ". dinero($saldo_total)."</td></tr>";
								//echo "<tr><td style='text-align:right'>Saldo Actual</td><td style='text-align:right'>+ &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;$ ".dinero($saldo)."</td></tr>";	
								//echo "<tr><td style='text-align:right;'>Saldo Total</td><td style='text-align:right;border-top:2px solid;'>$ ".dinero($saldo_total)."</td></tr>";	
					echo "<tr><td style='text-align:right'>Abono:</td><td style='text-align:right'> $ ". dinero($abono)."</td></tr>
					</table>";
			}
			else
			{

				echo "<p> Tipo de Venta: <span class=\"label label-inverse\">Contado</span></p><br>
					<table  width=100%>";

					$total_iva_contado=$total_contado*.16;
									echo "<tr><td>&nbsp;</td></tr>
									<tr><td>&nbsp;</td><td style='text-align:right'>Subtotal</td>
									<td style='text-align:right'>$". dinero($total_contado)."</td></tr>";
									echo "<tr><td>&nbsp;</td><td style='text-align:right'>IVA(16%)</td>
									<td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
									echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
											<td style='text-align:right;text-align:right;border-top:2px solid;'><strong>".dinero($total_iva_contado+$total_contado)."</strong></td></tr>";	
									
									echo"</table>";

			}

		?>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<a href="/functions/cerrarventa.php" class="btn btn-primary">Continuar</a>
		</div>
	</div>
