<div class="box span12">

					<div>
					<form action="/index.php" method="get">
							<table  width=100%  >
				 			<tr bgcolor=#dddddd>
				  			<td style="padding:10px">

							<input type=hidden name=data value=pos>
							<input type=hidden name=op value=detalles>
							<input type=hidden name=type value=dev>
				  			 &nbsp;&nbsp;item <input classe="input-xlarge focused" id="textcode" name="code" >
				  			</td>
				  		</tr>
				  		</table>
				  		</form>
				  	</div>


		<div class="row-fluid condensed">	

				<div class="box span4">
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


				<div class="box span4">

							  		<?php view_devoluciones($_GET['fid'])?>
					
				</div><!--/span-->

				<div class="box span4">

							  		<?php ticket_devolucion($_GET['fid'])?>
					
				</div><!--/span-->



		</div>
</div>



	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Devolucion de Producto</h3>
		</div>
		<div class="modal-body ">

		
		<center>Esta seguro de esta Devolucion?</center>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<a href="/functions/cerrarventa.php" class="btn btn-primary">Continuar</a>
		</div>
	</div>
