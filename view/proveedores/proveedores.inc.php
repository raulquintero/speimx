

<div class="box-content buttons">
						<a href="index.php?data=proveedores&op=proveedor_form&f=agregar"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR PROVEEDOR</button></a>
						<a href="index.php?data=cobronomina&op=cobronomina_form&f=agregar"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR PRODUCTO</button></a>
						
</div>
						
<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Proveedores</h2>
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
								  <th>proveedor</th>
								  <th>Contacto</th>
								  <th>Telefono</th>
								  <th>Email</th>
								  <th>Productos</th>

								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>

<?php

$query = "SELECT proveedor_id, rfc, proveedor, contacto, telefono, email FROM proveedor  ";
$results = $database->get_results( $query );
foreach( $results as $row )
{

$proveedor_id=$row['proveedor_id'];
	$query = "SELECT COUNT(producto.proveedor_id) as proveedor FROM producto where producto.proveedor_id=$proveedor_id "; //; SELECT * FROM gruponomina  ORDER BY gruponomina  ";
	list( $total_clientes ) = $database->get_row( $query );
?>
							<tr>
								<td><a href=index.php?data=proveedores&op=detalles&pid=<?=$row['proveedor_id']?>><?php echo strtoupper($row['proveedor'])?></a></td>
								<td class="center"><?=strtoupper($row['contacto'])?></td>
								<td class="center"><?=$row['telefono']?></td>
								<td class="center"><?=$row['email']?></td>
								<td class="center"><?php echo $total_clientes?></td>

								<td class="center">
									<a class="btn btn-success" href=index.php?data=proveedores&op=detalles&pid=<?php echo $row['proveedor_id']?>>
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="index.php?data=proveedores&op=proveedor_form&f=editar&pid=<?php echo $row['proveedor_id']?>">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
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