

<?php
include 'productos_detalles.scr.php';


?>

<?php 
if ($_GET['eed']==2)
	 			echo	"<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Registro Agregado!</strong> El Registro $cid esta listo para usarse.
						</div>";
?>						


<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon th"></i><span class="break">Detalles de Producto</span></h2>
					</div>
					<div class="box-content">
						<ul class="nav tab-menu nav-tabs" id="myTab">
							<li class="active"><a href="#info">Descripcion</a></li>
							<li><a href="#custom">Precios</a></li>
							<li><a href="#messages">Caracteristicas</a></li>
						</ul>
						 
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane active" id="info">
								<p>
											<img class=grayscale src=fotos/images.jpeg width=150 align=right></img>									
											
											<b><?php echo $producto?> </b> &nbsp;&nbsp;											
											<br>Marca: <?php echo $marca?>
											<br>Proveedor: <?php echo $proveedor?>
											<br>Subcategoria: <?php echo $subcategoria?>											
											<br>Codigo: <?php echo $codigo?>											
											
											<br><br>
											<a href="index.php?data=productos&op=producto_form&f=editar&prid=<?=$prid?>">
													<button class="btn btn-primary"><i class="halflings-icon white edit"></i></button></a>
											<a href="index.php?data=clientes&op=subirfoto&cid=<?php echo $cliente_id?>">
											<button class="btn btn-primary"><i class="halflings-icon white th-list"></i></button></a><br>
											
											<!-- <a href="index.php?data=clientes&op=cliente_form&f=editar&cid=<?=$cliente_id?>"><button 
													class="btn btn-mini btn-primary">Editar Cliente</button></a> 
											<br>
											<a href="index.php?data=clientes&op=cliente_form&f=editar&cid=<?=$cliente_id?>"><button 
													class="btn btn-mini btn-primary">Cambiar Imagen</button></a> 
											 -->	
										
								</p>

							</div>
							<div class="tab-pane" id="custom">
								<img class=grayscale src=fotos/images.jpeg width=150 align=right></img>
									<p><b><?php echo $nombre.' '.$apellidop.' '.$apellidom?></b> &nbsp;&nbsp;</p>
									<table><tr><td valign=top align=right>				
											<?php printf('<p>Precio Compra: <strong>%0.2f</strong><p>', $precio_compra);
											 	  printf('<p>Precio Promocion: <strong>%0.2f</strong><p>', $precio_promocion);
											?>
								</td>
								<td>&nbsp;&nbsp;</td>
								<td>
											<?php printf('<p>Precio Contado: <strong>%0.2f</strong><p>', $precio_contado);
											 	  printf('<p>Precio Credito: <strong>%0.2f</strong><p>', $precio_credito);
											?>
									</td>
</tr>
								</table>
							</div>
							<div class="tab-pane" id="messages">
								<p>
									<?php echo "<b>Marca: ". ucfirst($marca)."</b><br>"?>
									<?php echo "<b>Talla: ". ucfirst($talla)."</b><br>"?>									
									<?php echo "<b>Unidad: ". ucfirst($unidad)."</b><br>"?>									
									<?php echo "<b>Estilo: ". ucfirst($estilo)."</b><br>"?>									

								</p>
								
							</div>
						</div>
					</div>
				</div><!--/span-->

<!-- 
				<div class="row-fluid">
				
					<div class="span3 statbox black" onTablet="span6" onDesktop="span3">
						<div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
						<div class="number"><br> <?php echo dinero($total_ultimo)?>&nbsp;<i class="icon-arrow-up"></i></div>
						<div class="footer">
						<a href="#"> de <?php echo dinero($credito)?> (<?php echo fechamysqltous($fecha_total_inicio,1)?>)</a>
						</div>	
					</div>

					<div class="span3 statbox black" onTablet="span6" onDesktop="span3">
						<div class="number"><br><?php echo dinero($abono)?>&nbsp;<i class="icon-arrow-up"></i></div>
						<div class="footer">
							<a href="#"> Abono</a>
						</div>	
					</div>
					

					<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
						<div class="number"><br><?php echo dinero($saldo)?>&nbsp;<i class="icon-arrow-up"></i></div>
						<div class="footer">
							<a href="#"> Saldo</a>
						</div>	
					</div>


					<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
						<div class="number"><br><?php echo dinero($saldo)?>&nbsp;<i class="icon-arrow-up"></i></div>
						<div class="footer">
							<a href="#"> Saldo</a>
						</div>	
					</div>

				
				</div>

 -->

			<div class="row-fluid condensed">	

				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Historial Ventas</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">


                    Total Vendidos : <?php echo $productos_vendidos?>


						<table class="table table-condensed">
							  <thead>
								  <tr>
									  <th>ID</th>
									  <th>Fecha</th>
									  <th>Cargo</th>
									  <th>Abono</th>
									  <th>Saldo</th>
									  <th>Mov</th>
									  <th>Agente</th>                                          
								  </tr>
							  </thead>   
							  <tbody>

							  	<?php //movimientos($cid,$saldo);?>

							
 							 </tbody>
						 </table>  
						 <div class="pagination pagination-centered">
						  <ul>
							<li><a href="#">Prev</a></li>
							<li class="active">
							  <a href="#">1</a>
							</li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">Next</a></li>
						  </ul>
						</div>     
					</div>
				</div><!--/span-->
			

				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Historial Compras</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-condensed">
							  <thead>
								  <tr>
									  <th>ID</th>
									  <th>Fecha</th>
									  <th>Saldo</th>
									  <th>Abono</th>
									  <th></th>                                          
								  </tr>
							  </thead>   
							  <tbody>
								
							  		plandepagos($total_ultimo,$fecha_total_ultimo)
									<tr  bgcolor=dddddd ><td>0</td><td align=right><font   color=gray> <s>27-08-2013</td><td align=right><font  color=gray> <s>3415.00</td><td align=right><font  color=gray> <s>  150.00 </td><td align=right><font color=gray> 150.00&nbsp;</td></tr>
									






								                                  
							  </tbody>
						 </table>     
					</div>
				</div><!--/span-->
			
			</div><!--/row-->