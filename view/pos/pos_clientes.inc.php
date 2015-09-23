
						
<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Seleccione Cliente</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="/index.php?data=pos" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>Lugar de Trabajo</th>
								  
							  </tr>
						  </thead>   
						  <tbody>

<?php

	for ($i=0; $i < 10; $i++) { 
		echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	}

$query = "SELECT cliente_id,nombre, apellidop, apellidom, saldo,abono,empresa.empresa, empresa.sucursal FROM cliente,empresa where cliente.cliente_id>0 AND cliente.empresa_id=empresa.empresa_id  ";
$results = $database->get_results( $query );
foreach( $results as $row )
{


?>
							<tr>
								<td><a href=/functions/cart.php?func=sel_cliente&cid=<?php echo $row['cliente_id']?>><?php echo strtoupper($row['apellidop'].' '.$row['apellidom']).' '.$row['nombre']?></a></td>
								<td class="center"><?php echo $row['empresa'].' '.$row['sucursal']?></td>
								
							</tr>

<?php 
	}
?>


						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			<!--/div></row-->