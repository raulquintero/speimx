
<?php
$empresa_id=$_GET['eid'];
$query = "SELECT empresa,sucursal from empresa WHERE empresa_id=$empresa_id";
list( $empresa,$sucursal ) = $database->get_row( $query );

$query = "SELECT gruponomina.gruponomina_id,gruponomina.gruponomina from gruponomina,empresa WHERE gruponomina.gruponomina_id=empresa.gruponomina_id AND empresa.empresa_id=$empresa_id";
list( $gid,$gruponomina ) = $database->get_row( $query );


$query = "SELECT sum(total_ultimo) as saldo_total FROM cliente WHERE  empresa_id=$empresa_id  AND saldo>0 ";
list( $saldo_total ) = $database->get_row( $query );

$query = "SELECT sum(saldo) as saldo_total FROM cliente WHERE  empresa_id=$empresa_id  AND saldo>0 ";
list( $saldo_pendiente ) = $database->get_row( $query );

$porcentaje_credito=ceil(($saldo_pendiente*100)/$saldo_total);

$query = "SELECT count(cliente_id) as saldo_total FROM cliente WHERE  empresa_id=$empresa_id  AND saldo>0 ";
list( $clientes_deben ) = $database->get_row( $query );

$query = "SELECT count(cliente_id) as saldo_total FROM cliente WHERE  empresa_id=$empresa_id  AND saldo<=0 ";
list( $clientes_nodeben ) = $database->get_row($query);

$porcentaje_clientes=ceil(($clientes_nodeben*100)/$clientes_deben);

?>

<!-- 
<div class="box-content buttons">
						<a href="index.php?data=nominas&op=nomina_form&f=agregar"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR nomina</button></a>
						<a href="index.php?data=clientes&op=grupo_form"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR GRUPO</button></a>
						<a href="index.php?data=nominas"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR nomina</button></a>
						
</div> -->

			<div class="row-fluid">	
				<div class="box span12">
					
							
				             	<h5>Credito Flotante: <?php echo dinero($saldo_pendiente).' ('.$porcentaje_credito.'%)'?> </h5>
				            <!--	<div class="meter green"><span style="width: <?php echo $porcentaje?>%"></span></div>
				          		 -->		

						<div class="progress progress-success" style="margin-bottom: 9px;">
							<div class="bar" style="width:  <?php echo $porcentaje_credito?>%"></div>
						</div>
				    
				             	<h5>Clientes sin deuda: <?php echo $clientes_deben.' ('.$porcentaje_clientes.'%)'?> )</h5>
				        <div class="progress progress-success" style="margin-bottom: 9px;">
							<div class="bar" style="width:  <?php echo $porcentaje_clientes?>%"></div>
						</div>
				    
				</div>
			</div>		

<div class="box span11">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Nomina:
								<a href=index.php?data=nomina&op=empresas&nid=<?php echo $gid?> ><u><?php echo strtoupper($gruponomina)?></u></a>
									 - Empresa: <b><?php echo $empresa?> [<?php echo $sucursal?>]</b> <?php echo dinero($saldo_pendiente)?> de  <?php echo dinero($saldo_total)?></h2>
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
								 <th>Email</th> 
								  <th>Acciones</th> 
							  </tr>
						  </thead>   
						  <tbody>

<?php


$empresa_id=$_GET['eid'];
$query = "SELECT * FROM cliente WHERE  empresa_id=$empresa_id  AND saldo>0 ";
$results = $database->get_results( $query );
foreach( $results as $row )
{

	
?>
							<tr>
								<td><a href=/index.php?data=clientes&op=detalles&cid=<?php echo $row['cliente_id']?> >
									<?php echo strtoupper($row['apellidop'].' '.$row['apellidom'].' '.$row['nombre'])?></a></td>
								<td class="center"><?php echo  dinero($row['abono'])?></td>
								 <td class="center"><?php echo dinero($row['saldo'])?></td>
								<td class="center"><?php echo $row['email']?></td>
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
			
		
<div class="box span11">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Nomina:
								<a href=index.php?data=nomina&op=empresas&nid=<?php echo $gid?> ><u><?php echo strtoupper($gruponomina)?></u></a>
									 - Empresa: <b><?php echo $empresa?> [<?php echo $sucursal?>]</b></h2>
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
								 <th>Email</th> 
								  <th>Acciones</th> 
							  </tr>
						  </thead>   
						  <tbody>

<?php


$empresa_id=$_GET['eid'];
$query = "SELECT * FROM cliente WHERE  empresa_id=$empresa_id AND saldo<=0 ";
$results = $database->get_results( $query );
foreach( $results as $row )
{

	
?>
							<tr>
								<td><a href=/index.php?data=clientes&op=detalles&cid=<?php echo $row['cliente_id']?> >
									<?php echo strtoupper($row['apellidop'].' '.$row['apellidom'].' '.$row['nombre'])?></a></td>
								<td class="center"><?php echo dinero($row['abono'])?></td>
								 <td class="center"><?php echo dinero($row['saldo'])?></td>
								<td class="center"><?php echo $row['email']?></td>
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