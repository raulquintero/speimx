
<div class="box-content buttons">
						<a href="/index.php?data=productos&op=producto_form&f=agregar"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR PRODUCTO</button></a>
						<a href="/index.php?data=empresas&op=empresa_form&f=agregar"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR CATEGORIA</button></a>
						<a href="/index.php?data=empresas&op=empresa_form&f=agregar"><button class="btn btn-small btn-primary"><b>+</b> AGREGAR SUBCATEGORIA</button></a>
						<a href="/index.php?data=proveedores&op=proveedor_form&f=agregar"><button class="btn btn-small btn-info"><b>+</b> AGREGAR PROVEEDOR</button></a>
						
</div>
						
<div class="box span12 hidden-phone" >
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon barcode"></i><span class="break"></span>Productos</h2>
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
								  <th>ID</th>
								  <th>Producto</th>
								  <th>Subcategoria</th>
								  <th>Precio Compra</th>
								  <th>Precio Contado</th>
								  <th>Precio Credito</th>
								  <th>Stock</th>
								  <th>Proveedor</th>
								  <th>Acciones</th>

							  </tr>
						  </thead>   
						  <tbody>

						<?php

						$query = "SELECT producto_id,producto,precio_compra,precio_contado,precio_credito,stock,proveedor,subcategoria FROM producto,proveedor,subcategoria 
								where producto.proveedor_id=proveedor.proveedor_id AND producto.subcategoria_id=subcategoria.subcategoria_id";
								$results = $database->get_results( $query );
						foreach( $results as $row )
						{


						?>
							<tr>
								<td class="center"><?php echo $row['producto_id']?></td>
								<td><a href=index.php?data=productos&op=detalles&prid=<?=$row['producto_id']?>><?php echo strtoupper($row['producto'])?></a></td>
								<td class="center"><?php echo $row['subcategoria']?></td>
								<td class="center"><?php echo $row['precio_compra']?></td>
								<td class="center"><?php echo $row['precio_contado']?></td>
								<td class="center"><?php echo $row['precio_credito']?></td>
								<td class="center"><?php echo $row['stock']?></td>
								<td class="center"><?php echo $row['proveedor']?></td>
								<td class="center">  
									<a class="btn btn-success" href="index.php?data=productos&op=detalles&prid=<?php echo $row['producto_id']?>">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a href="index.php?data=productos&op=producto_form&f=editar&prid=<?php echo $row['producto_id']?>">
													<button class="btn btn-primary"><i class="halflings-icon white edit"></i></button></a>

									<a href="index.php?data=clientes&op=subirfoto&cid=<?php echo $producto_id?>">
											<button class="btn btn-info"><i class="halflings-icon white th-list"></i></button></a><br>
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





<div class="box span12 hidden-desktop" >
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon barcode"></i><span class="break"></span>Productos</h2>
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
								  <th>ID</th>
								  <th>Producto</th>
								  <th>Subcategoria</th>
								  <th>Proveedor</th>
								  <th>Acciones</th>

							  </tr>
						  </thead>   
						  <tbody>

						<?php

						$query = "SELECT producto.codigo,producto_id,producto,precio_compra,precio_contado,precio_credito,stock,proveedor,subcategoria FROM producto,proveedor,subcategoria 
								where producto.proveedor_id=proveedor.proveedor_id AND producto.subcategoria_id=subcategoria.subcategoria_id";
								$results = $database->get_results( $query );
						foreach( $results as $row )
						{


						?>
							<tr>
								<td class="center"><?php echo $row['codigo']?></td>
								<td><a href=index.php?data=productos&op=detalles&prid=<?=$row['producto_id']?>><?php echo strtoupper($row['producto'])?></a><br>
									PCM: $<?php echo ($row['precio_compra']+($row['precio_credito']*.16))?> PCN: $<?php echo ($row['precio_contado']+($row['precio_contado']*.16))?> PVE: $<?php echo ($row['precio_credito']+($row['precio_credito']*.16))?> </td>
								<td class="center"><?php echo $row['subcategoria']?></td>
								<td class="center"><?php echo $row['proveedor']?></td>
								<td class="center">  
									<a class="btn btn-success" href="index.php?data=productos&op=detalles&prid=<?php echo $row['producto_id']?>">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a href="index.php?data=productos&op=producto_form&f=editar&prid=<?php echo $row['producto_id']?>">
													<button class="btn btn-primary"><i class="halflings-icon white edit"></i></button></a>

									<a href="index.php?data=clientes&op=subirfoto&cid=<?php echo $producto_id?>">
											<button class="btn btn-info"><i class="halflings-icon white th-list"></i></button></a><br>
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