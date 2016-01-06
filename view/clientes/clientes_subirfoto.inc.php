<?php

$cid=$_GET['cid'];
?>


			<div class="row-fluid condensed">	

			

				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Subir Fotos</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>


					<div class="box-content">
						<table class="table table-condensed">

							  <tbody>
							  	<tr><td align=center>

							  		<img src=/fotos/<?php echo $cid?>_f.jpg width=200>
							  	</td>
							  	<td>

							  		<form action="view/clientes/subirf.php" method="post" enctype="multipart/form-data">
										<p><input type="file" name="uploadedfile" /></p>
										<p><input type="submit" value="Subir Foto" /></p>
                                        <input type="hidden" name="type" value="<?php echo $cid?>"/>
                                        <input type="hidden" name="f" value="a"/>
									</form>
                                    </td></tr>
 							 </tbody>
						 </table>
						     
					</div>
				</div><!--/span-->


				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Subir Identificaciones</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>

					<div class="box-content">
						<table class="table table-condensed">
							  <!-- <thead>
								  <tr>
									  <th>ID</th>
									  <th>Fecha</th>
									  <th>Saldo</th>
									  <th>Abono</th>
									  <th></th>                                          
								  </tr>
							  </thead>    -->
							  <tbody>
								
								<tr>
								<td align=center><img src=/ides/<?php echo $cid?>_i1.jpeg width=200></td>
							  	<td>
							  		<form action="/view/clientes/subirf.php" method="post" enctype="multipart/form-data">
										<p><input type="file" name="archivo" /></p>
										<p><input type="submit" value="Actualizar" /></p>
										<input type="hidden" name="tipo" value="cif">
									</form>
								</td>
								</tr>
							  	<tr>
								<td align=center><img src=/ides/<?php echo $cid?>_i2.jpeg width=200></td>
							  	<td>
							  		<form action="" jimen method="post" enctype="multipart/form-data">
										<p><input type="file" name="ife" /></p>
										<p><input type="submit" value="Actualizar" /></p>
									</form></td>
								</tr>
							  	<tr>
								<td align=center><img src="/ides/<?php echo $cid?>_g1.jpeg" width=200></td>
							  	<td>
							  		<form action="" method="post" enctype="multipart/form-data">
										<p><input type="file" name="ife" /></p>
										<p><input type="submit" value="Actualizar" /></p>
									</form></td>
								</tr>
							  	<tr>
								<td align=center><img src=/ides/<?php echo $cid?>_g2.jpeg width=200></td>
							  	<td>
							  		<form action="" method="post" enctype="multipart/form-data">
										<p><input type="file" name="ife" /></p>
										<p><input type="submit" value="Actualizar" /></p>
									</form></td>
								</tr>


							  </tbody>
						 </table>     
					</div>
				</div>
			</div>