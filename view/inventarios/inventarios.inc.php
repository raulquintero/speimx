<a href="/functions/crud_inventarios.php?func=c" class="btn btn-small btn-primary hidden-print"><b>+</b> INICIAR INVENTARIO</a>

<div class="box">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon barcode"></i><span class="break"></span>Clientes</h2>
						<div class="box-icon">
							<a href="index.php?data=clientes&op=cliente_form&f=agregar" ><i class="halflings-icon plus"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>No.</th>
							  	  <th>Fecha Inicio</th>
								  <th>Fecha Fin</th>
								  <th>Items</th>
								  <th>Empleado</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>
						  <tbody>

<?php

$query = "SELECT inventarios_id, fecha_ini, fecha_fin,nombre,apellidop,status FROM inventarios,admin,status
	where inventarios.admin_id=admin.admin_id AND inventarios.status_id=status.status_id ORDER BY inventarios_id DESC ";
$results = $database->get_results( $query );

foreach( $results as $row )
{

$query = "SELECT count(inventarios_id) from inventariosdet where inventarios_id='".$row['inventarios_id']."'";
list($items)=$database->get_row($query);
$empleado=$row['apellidop'].' '.$row['nombre'];
?>
							<tr>
								<td><a href=index.php?data=clientes&op=detalles&cid=<?php echo $row['inventarios_id']?>><?php echo $row['inventarios_id']?></a></td>
								<td class="center"><a href="/index.php?data=inventarios&op=resumen&isid=<?php echo $row['inventarios_id']?>"><?php echo $row['fecha_ini']?></a></td>
								<td class="center"><?php echo $row['fecha_fin']?></td>

								<td class="center"><?php echo $items?></td>

								<td class="center"><?php echo $empleado?></td>
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