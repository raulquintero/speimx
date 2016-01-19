
<?php
	$nid=$_GET['nid'];
	$query = "SELECT gruponomina FROM gruponomina where gruponomina_id=$nid "; //; SELECT * FROM gruponomina  ORDER BY gruponomina  ";
	list( $gruponomina ) = $database->get_row( $query );
?>						
<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Empresas de la Nomina: <?php echo strtoupper($gruponomina) ?></h2>
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
								  <th>Deben</th>
								 <th>No deben</th> 
								  <th>Acciones</th> 
							  </tr>
						  </thead>   
						  <tbody>

<?php


$nomina_id=$_GET['nid'];
$query = "SELECT * FROM empresa WHERE gruponomina_id=$nomina_id ORDER BY empresa  ";
$results = $database->get_results( $query );
foreach( $results as $row )
{

	$empresa_id=$row['empresa_id'];
	$query = "SELECT COUNT(cliente.cliente_id) as clientes FROM cliente where cliente.empresa_id=$empresa_id  AND saldo>0"; //; SELECT * FROM gruponomina  ORDER BY gruponomina  ";
	list( $total_clientes_deben ) = $database->get_row( $query );

	$query = "SELECT COUNT(cliente.cliente_id) as clientes FROM cliente where cliente.empresa_id=$empresa_id  AND saldo<=0"; //; SELECT * FROM gruponomina  ORDER BY gruponomina  ";
	list( $total_clientes_nodeben ) = $database->get_row( $query );
?>
							<tr>
								<td><a href=index.php?data=<?php echo $_GET['data']?>&op=clientes&eid=<?=$row['empresa_id']?>><?php echo strtoupper($row['empresa'])?></a></td>
								 <td class="center"><?php echo strtoupper($row['sucursal'])?></td>
								<td class="center"> <span class="label label-success"><?php echo $total_clientes_deben?></span></td>
								<td class="center"><span class="label label-important"><?=$total_clientes_nodeben?></span></td>
								<td class="center">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="#">
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