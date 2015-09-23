

<div class="box-content buttons">
						<a href="index.php?data=clientes&op=cliente_form&f=agregar"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR CLIENTE</button></a>
						<a href="index.php?data=cobronomina&op=cobronomina_form&f=agregar"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR GRUPO</button></a>
						<a href="index.php?data=empresas&op=empresa_form&f=agregar"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR EMPRESA</button></a>
						
</div>
						
						
<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Nominas</h2>
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
								  <th>Nomina</th>
								  <th>Empresas</th>
								<!--   <th>Telefono</th>
								  <th>Email</th> -->
								  <th>Acciones</th> 
							  </tr>
						  </thead>   
						  <tbody>

<?php

$query = "SELECT * FROM gruponomina where gruponomina_id>0 ORDER BY gruponomina  ";
$results = $database->get_results( $query );
foreach( $results as $row )
{

	$gruponomina_id=$row['gruponomina_id'];
	$query = "SELECT COUNT(empresa.empresa_id) as empresas FROM empresa where empresa.gruponomina_id=$gruponomina_id "; //; SELECT * FROM gruponomina  ORDER BY gruponomina  ";
	list( $total_empresas ) = $database->get_row( $query );

?>
							<tr>
								<td><a href=index.php?data=<?php echo $_GET['data']?>&op=empresas&nid=<?=$row['gruponomina_id']?>><?php echo strtoupper($row['gruponomina'])?></a></td>
								<td class="center"><?php echo $total_empresas?></td>
								<!-- <td class="center"><?=$row['telefono']?></td>
								<td class="center"><?=$row['email']?></td>
								 --><td class="center">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="/index.php?data=cobronomina&op=cobronomina_form&f=editar&gid=<?=$row['gruponomina_id']?>">
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