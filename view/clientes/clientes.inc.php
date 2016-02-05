<ul class="breadcrumb_sub hidden-print hidden-phone">

					<i class=" fa-icon-tasks"></i>
					&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php" >Menu&nbsp;</a>
					<i class="icon-angle-right"></i>&nbsp;&nbsp;&nbsp;



				<a class="btn btn-small blue" href="index.php?data=clientes&op=cliente_form&f=agregar" ><i class="icon-barcode "></i>&nbsp;AGREGAR CLIENTE</a>
				<a class="btn btn-small blue" href="index.php?data=nomina&op=cobronomina_form&f=agregar" ><i class="icon-barcode "></i>&nbsp;<b>+</b> AGREGAR GRUPO</a>
                <a class="btn btn-small blue"  href="index.php?data=empresas&op=empresa_form&f=agregar" ><i class="icon-barcode "></i>&nbsp;<b>+</b> AGREGAR EMPRESA</a>


</ul>



						
<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Clientes</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>Abono</th>
								  <th>Saldo</th>
								  <th>Pagos Restantes</th>
								  <th>Lugar de Trabajo</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>

<?php

$query = "SELECT cliente_id,nombre, apellidop, apellidom, saldo,abono,empresa.empresa, empresa.sucursal FROM cliente,empresa where cliente.empresa_id=empresa.empresa_id  ";
$results = $database->get_results( $query );
foreach( $results as $row )
{

$nombre_cliente=$row['apellidop'].' '.$row['apellidom'].' '.$row['nombre'];
?>
							<tr>
								<td><a href=index.php?data=clientes&op=detalles&cid=<?php echo $row['cliente_id']?>><?php echo strtoupper($nombre_cliente)?></a></td>
								<td class="center"><?php echo $row['abono']?></td>
								<td class="center"><?php echo $row['saldo']?></td>
								
								<?php
								if($row['abono'])
										$numpagos=ceil($row['saldo']/$row['abono']);
								 ?>
								<td class="center"><?php echo $numpagos ?></td>


								<td class="center"><?php echo $row['empresa'].' '.$row['sucursal']?></td>
								<td class="center">
									<a class="btn btn-success" href="index.php?data=clientes&op=detalles&cid=<?php echo $row['cliente_id']?>">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="index.php?data=clientes&op=cliente_form&f=editar&cid=<?php echo $row['cliente_id']?>">
										<i class="halflings-icon white edit"></i>  
									</a>
									<!-- <a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a> -->
								</td>
							</tr>

<?php 
	}
?>


						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			<!--/div></row-->