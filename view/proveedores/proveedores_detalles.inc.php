

<?php
include 'proveedores_detalles.scr.php';


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
						<h2><i class="halflings-icon th"></i><span class="break"></span></h2>
					</div>
					<div class="box-content">
						<ul class="nav tab-menu nav-tabs" id="myTab">
							<li class="active"><a href="#info">Datos Personales</a></li>
							<li><a href="#custom">Credito</a></li>
							<li><a href="#messages">Notas</a></li>
						</ul>
						 
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane active" id="info">
								<p>
											<img class=grayscale src=logos/logo.jpg width=150 align=right></img>									
											
											<b><?php echo strtoupper($proveedor)?></b> &nbsp;&nbsp;											
											<br> <?php echo strtoupper($rfc)?>
											<br>Direccion: <?php echo $domicilio?>
											<br>Contacto: <?php echo $contacto?>
											<br>Telefono: <?php echo $telefono?>
											<br>Productos: <?php echo $productos?>
											
											<br><br>
											<a href="index.php?data=proveedores&op=proveedor_form&f=editar&pid=<?=$pid?>">
													<button class="btn btn-primary"><i class="halflings-icon white edit"></i></button></a>
											<button class="btn btn-primary"><i class="halflings-icon white camera"></i></button><br>
											
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
									<p>Limite de Credito: <?php echo $credito?></p>
									<p>Inicio Plazo: <?=$fecha_total_inicio?></p>
									<p>Fin Plazo: <b><?=$fecha_total_ultimo?></b></p>
									<p>Total Financiado:	<?=$total_ultimo?></b>	</p>
								
							</div>
							<div class="tab-pane" id="messages">
								<p>
									<?php echo "Notas:". $obsevarciones?>									
								</p>
								
							</div>
						</div>
					</div>
				</div><!--/span-->


<?php if (!$_GET['subcat']) {?>

				<div class="row-fluid">
				
					<div class="span3 statbox black" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br> <?php echo $empleados?>7 de 10&nbsp;<!--i class="icon-arrow-up"></i--></div>
						<div class="title"><br>Pagos Restantes</div>
						<!--div class="footer">
						<a href="#"> Saldo</a>
						</div-->	
					</div>

					<div class="span3 statbox black" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br><?php echo dinero(1500)?> &nbsp;<!--i class="icon-arrow-up"></i--></div>
						<div class="title"><br>Abono Sem</div>
						<!--div class="footer">
							<a href="#"> Saldo</a>
						</div-->	
					</div>
					
					<div class="span3 statbox black" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br><?php echo dinero(32000)?>&nbsp;<!--i class="icon-arrow-up"></i--></div>
						<div class="title"><br>Total Deuda</div>
						<!--div class="footer">
							<a href="#"> Saldo</a>
						</div-->	
					</div>

					<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br><?php echo dinero(28000)?>&nbsp;<!--i class="icon-arrow-up"></i--></div>
						<div class="title"><br>Saldo</div>
						<!--div class="footer">
							<a href="#"> Saldo</a>
						</div-->	
					</div>

				</div>

<?php 
		} 
?>


			<div class="row-fluid condensed">	

				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Categorias</h2>
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
									  <th>Categoria</th>
									  <th>Subcategoria</th>
									  <th>Productos</th>
									  <th>Precio Min</th>
									  <th>Precio Max</th>
									                                            
								  </tr>
							  </thead>   
							  <tbody>


							  	<?php catalogo($pid,$saldo);?>

							      

  				</tbody>
						 </table>  
						     
					</div>
				</div><!--/span-->
			

				<div class="box span6">
					
				
				  		 <?php

							  		 if ($_GET['subcat'])
							  		 productos($prid,$_GET['subcat']); 
							  			else
							  			movimientos($prid);
									 ?>

				</div><!--/span-->
			
			</div><!--/row-->