

<?php
include 'empresas_detalles.scr.php';


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
											
											<b><?php echo strtoupper($empresa)?></b> &nbsp;&nbsp;											
											<br>Direccion: <?php echo $domicilio?>
											<br>Contacto: <?php echo $contacto?>
											<br>Telefono: <?php echo $telefono?>
											<br>Grupo Nomina: <?php echo $gruponomina?>
											
											<br><br>
											<a href="index.php?data=empresas&op=empresa_form&f=editar&eid=<?=$eid?>">
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


				<div class="row-fluid">
				
					<div class="span3 statbox black" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br> <?php echo $empleados?>70 de 100&nbsp;<!--i class="icon-arrow-up"></i--></div>
						<div class="title"><br>Empleados Registrados</div>
						<!--div class="footer">
						<a href="#"> Saldo</a>
						</div-->	
					</div>

					<div class="span3 statbox black" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br><?php echo dinero(10500)?> &nbsp;<!--i class="icon-arrow-up"></i--></div>
						<div class="title"><br>Total Abono Sem</div>
						<!--div class="footer">
							<a href="#"> Saldo</a>
						</div-->	
					</div>
					
					<div class="span3 statbox black" onTablet="span6" onDesktop="span3">
						<!--div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div-->
						<div class="number"><br><?php echo dinero(68300)?>&nbsp;<!--i class="icon-arrow-up"></i--></div>
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



			<div class="row-fluid condensed">	

				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Movimientos</h2>
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
									  <th>Folio</th>
									  <th>Fecha</th>
									  <th>Clientes</th>
									  <th>Abono</th>
									  <th>Saldo</th>
									  <th>Status</th>
									                                            
								  </tr>
							  </thead>   
							  <tbody>


							  	<?//php movimientos($cid,$saldo);?>

							<tr  bgcolor=dddddd ><td>0</td><td align=right><font color=gray>200</td><td>Jun-12-2015</td><td align=right>30</td><td align=right>4500.00</td><td align=right>45000.00</td><td align=right><font color=gray><i class="halflings-icon share"></i></tr>
							<tr>                 <td>1</td><td align=right><font color=gray>180</td><td>Jun-05-2015</td><td align=right>30 de 30</td><td align=right>4500.00</td><td align=right>42000.00</td><td align=right><font color=gray><i class="halflings-icon ok"></i></tr>
							<tr  bgcolor=dddddd ><td>2</td><td align=right><font color=gray>175</td><td>May-27-2015</td><td align=right>21 de 21</td><td align=right>3150.00</td><td align=right>28000.00</td><td align=right><font color=gray><i class="halflings-icon ok"></i></tr>
							<tr>                 <td>3</td><td align=right><font color=gray>169</td><td>May-20-2015</td><td align=right>23 de 24</td><td align=right>3450.00</td><td align=right>32000.00</td><td align=right><font color=gray><i class="halflings-icon ok"></i></td></tr>
									



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
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Plan de Pagos</h2>
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
									<tr ><td>1</td><td align=right><font   color=gray> <s>03-09-2013</td><td align=right><font   color=gray> <s>3265.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr  bgcolor=dddddd ><td><font >2</td><td align=right><font   color=gray> <s>10-09-2013</td><td align=right><font   color=gray> <s>3115.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr ><td>3</td><td align=right><font   color=gray> <s>17-09-2013</td><td align=right><font   color=gray> <s>2965.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr  bgcolor=dddddd ><td><font >4</td><td align=right><font   color=gray> <s>24-09-2013</td><td align=right><font   color=gray> <s>2815.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr ><td>5</td><td align=right><font   color=gray> <s>01-10-2013</td><td align=right><font   color=gray> <s>2665.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr  bgcolor=dddddd ><td><font >6</td><td align=right><font   color=gray> <s>08-10-2013</td><td align=right><font   color=gray> <s>2515.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr ><td>7</td><td align=right><font   color=gray> <s>15-10-2013</td><td align=right><font   color=gray> <s>2365.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr  bgcolor=dddddd ><td><font >8</td><td align=right><font   color=gray> <s>22-10-2013</td><td align=right><font   color=gray> <s>2215.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr ><td>9</td><td align=right><font   color=gray> <s>29-10-2013</td><td align=right><font   color=gray> <s>2065.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr  bgcolor=dddddd ><td><font >10</td><td align=right><font   color=gray> <s>05-11-2013</td><td align=right><font   color=gray> <s>1915.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr ><td>11</td><td align=right><font   color=gray> <s>12-11-2013</td><td align=right><font   color=gray> <s>1765.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr  bgcolor=dddddd ><td><font >12</td><td align=right><font   color=gray> <s>19-11-2013</td><td align=right><font   color=gray> <s>1615.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr ><td>13</td><td align=right><font   color=gray> <s>26-11-2013</td><td align=right><font   color=gray> <s>1465.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr  bgcolor=dddddd ><td><font >14</td><td align=right><font   color=gray> <s>03-12-2013</td><td align=right><font   color=gray> <s>1315.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr ><td>15</td><td align=right><font   color=gray> <s>10-12-2013</td><td align=right><font   color=gray> <s>1165.00</td><td align=right><font   color=gray> <s>  150.00 </td><td align=right><font   color=gray> 150.00&nbsp;</td></tr>
									<tr  bgcolor=dddddd ><td><font >16</td><td align=right><font   color=red >17-12-2013</td><td align=right><font   color=red >1015.00</td><td align=right><font   color=red >  150.00 </td><td align=right><font   color=red > 135.00&nbsp;</td></tr>
									<tr ><td>17</td><td align=right><font   color=red >24-12-2013</td><td align=right><font   color=red >865.00</td><td align=right><font   color=red >  150.00 </td><td align=right><font   color=red > 0.00&nbsp;</td></tr>
									<tr  bgcolor=dddddd ><td><font >18</td><td align=right><font   color=red >31-12-2013</td><td align=right><font   color=red >715.00</td><td align=right><font   color=red >  150.00 </td><td align=right><font   color=red > 0.00&nbsp;</td></tr>
									<tr ><td>19</td><td align=right><font   color=red >07-01-2014</td><td align=right><font   color=red >565.00</td><td align=right><font   color=red >  150.00 </td><td align=right><font   color=red > 0.00&nbsp;</td></tr>
									<tr  bgcolor=dddddd ><td><font >20</td><td align=right><font   color=red >14-01-2014</td><td align=right><font   color=red >415.00</td><td align=right><font   color=red >  150.00 </td><td align=right><font   color=red > 0.00&nbsp;</td></tr>
									<tr ><td>21</td><td align=right><font   color=red >21-01-2014</td><td align=right><font   color=red >265.00</td><td align=right><font   color=red >  150.00 </td><td align=right><font   color=red > 0.00&nbsp;</td></tr>
									<tr  bgcolor=dddddd ><td><font >22</td><td align=right><font   color=red >28-01-2014</td><td align=right><font   color=red >115.00</td><td align=right><font   color=red >  115.00</td><td align=right><font   color=red > 0.00&nbsp;</td></tr>
									<tr><td></td><td></td><td colspan=2 align=right><font >Total Abonos: </td><td align=right style='border-top:2px solid black'><font >$2535.00&nbsp;</td></tr>







								                                  
							  </tbody>
						 </table>     
					</div>
				</div><!--/span-->
			
			</div><!--/row-->