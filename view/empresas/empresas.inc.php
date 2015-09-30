

<div class="box-content buttons">
						<a href="index.php?data=clientes&op=cliente_form&f=agregar"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR CLIENTE</button></a>
						<a href="index.php?data=cobronomina&op=cobronomina_form&f=agregar"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR GRUPO</button></a>
						<a href="index.php?data=empresas&op=empresa_form&f=agregar"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR EMPRESA</button></a>
						
</div>
						
<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Empresas Registradas</h2>
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
								  <th>Empresa</th>
								  <th>Sucursal</th>								  
								  <th>Contacto</th>
								  <th>Telefono</th>
								  <th>Email</th>
								  <th>Clientes</th>

								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>

<?php

$query = "SELECT empresa_id, rfc, empresa, sucursal, contacto, telefono, email FROM empresa where empresa_id>0 ";
$results = $database->get_results( $query );
foreach( $results as $row )
{

$empresa_id=$row['empresa_id'];
	$query = "SELECT COUNT(cliente.cliente_id) as clientes FROM cliente where cliente.empresa_id=$empresa_id "; //; SELECT * FROM gruponomina  ORDER BY gruponomina  ";
	list( $total_clientes ) = $database->get_row( $query );
?>
							<tr>
								<td><a href=index.php?data=empresas&op=detalles&eid=<?=$row['empresa_id']?>><?php echo strtoupper($row['empresa'])?></a></td>
								<td><?php echo $row['sucursal']?></td>
								<td class="center"><?=strtoupper($row['contacto'])?></td>
								<td class="center"><?=$row['telefono']?></td>
								<td class="center"><?=$row['email']?></td>
								<td class="center"><?php echo $total_clientes?></td>

								<td class="center">
									<a class="btn btn-success" href=index.php?data=empresas&op=detalles&eid=<?php echo $row['empresa_id']?>>
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="index.php?data=empresas&op=empresa_form&f=editar&eid=<?php echo $row['empresa_id']?>">
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