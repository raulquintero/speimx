<?php 
$fid=$_GET['fid'];
$fid=substr($fid,1,6);
$nid=$_SESSION['nid'];

 ?>
<div class=" span12">

					<div class="hidden-print">
					<form action="/index.php" method="get">
							<table  width=100%  >
				 			<tr bgcolor=#dddddd>
				  			<td style="padding:10px">

							<input type=hidden name=data value=clientes>
							<input type=hidden name=op value=factura>
							<input type=hidden name=type value=dev>
							<input type=hidden name=fid value='<?php echo $fid?>'>

				  			 <?php 
				  			 	if ($nid<=8) echo "&nbsp;&nbsp;item <input classe=\"input-xlarge focused\" id=\"textcode\" name=\"code\" >";   
				  			 	
				  			 ?>
				  			</td>
				  		</tr>
				  		</table>
				  		</form>
				  	</div>


		<div class="row-fluid condensed">	

				<div class=" span4">
					<div class="header">
						<!-- <h2><i class="halflings-icon align-justify "></i><span class="break "></span>Nota de Venta</h2> -->
						
					</div>
					<div class="">
		
					<?php
					getfactura($fid);
					?>
					<br><br><br>
					</div>
				</div>


				<div class="box span4">

							  		<?php if ($nid<=8)view_devoluciones($fid)?>
					
				</div><!--/span-->

				<div class="box span4 hidden-print">

							  		<?php if ($nid<=8) ticket_devolucion($fid)?>
					
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
