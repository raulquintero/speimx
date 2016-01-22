<div class="hidden-print ">
					<form action="/index.php" method="get">
							<table  width=100%  >
				 			<tr bgcolor=#dddddd>
				  			<td style="padding:10px">

							<input type=hidden name=data value=productos>
							<input type=hidden name=filtro value=buscar>
				  			 &nbsp;&nbsp;Codigo: <input class="input-large" id="textcode" name="code" >
				  			</td>
				  		</tr>
				  		</table>
				  		</form>
				  	</div>




<div class="box-content buttons">
						<a href="/index.php?data=productos&op=producto_form&f=agregar" class="btn btn-small btn-primary hidden-print"><b>+</b> AGREGAR PRODUCTO</a>
						<a href="/index.php?data=empresas&op=empresa_form&f=agregar" class="btn btn-small btn-primary hidden-print"><b>+</b> AGREGAR CATEGORIA</a>
						<a href="/index.php?data=empresas&op=empresa_form&f=agregar" class="btn btn-small btn-primary hidden-print"><b>+</b> AGREGAR SUBCATEGORIA</a>
						<a href="/index.php?data=proveedores&op=proveedor_form&f=agregar" class="btn btn-small btn-info hidden-print"><b>+</b> AGREGAR PROVEEDOR</a>

</div>

<div class="box span12  " >
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
								  <th class="hidden-print">ID</th>
								  <th>Producto</th>
								  <th>Subcategoria</th>
								  <th>PCM</th>
								  <th>VLIMP</th>
								  <th>PCN</th>
								  <th>PCR</th>
                                  <th>DESC %</th>
								  <th>Stock</th>
								  <th>Proveedor</th>
								  <th class="hidden-print">Acciones</th>

							  </tr>
						  </thead>
						  <tbody>

						<?php



                        if ($_GET['code'])
                        {
                        	$query = "SELECT  producto_id from inventariodet
                            where codigo=".$_GET['code'];
										list( $code ) = $database->get_row( $query );
                         }


						$query = "SELECT producto_id, producto, precio_compra,precio_contado,precio_credito,descuento,
                            precio_promocion,stock,proveedor.proveedor_id,proveedor,subcategoria.subcategoria_id,subcategoria,codigo FROM producto,proveedor,subcategoria
								where producto.proveedor_id=proveedor.proveedor_id AND producto.subcategoria_id=subcategoria.subcategoria_id";
                                switch ($_GET['filtro'])   {
                                    case "sub":$filtro=" AND subcategoria.subcategoria_id=".$_GET['sub'];
                                    break;
                                    case "proveedor": $filtro= " AND proveedor.proveedor_id=".$_GET['pid'];
                                    break;
                                    case "buscar" : if ($code) $filtro= " AND producto.producto_id=$code";
                                    break;
                                }
                        $query.=$filtro;
								$results = $database->get_results( $query );
						foreach( $results as $row )
						{
                            $query = "SELECT count(producto_id) FROM facturadet WHERE producto_id=".$row['producto_id'];
                            list( $productos_vendidos  ) = $database->get_row( $query );

							$vlimp=(($row['precio_contado']*1.16)-($row['precio_contado']*1.16*$row['descuento']/100));
						?>
							<tr>
								<td class="center hidden-print"><?php echo $row['codigo']?></td>
								<td><a class="hidden-print" href="index.php?data=productos&op=detalles&prid=<?php echo $row['producto_id']?>"><?php echo strtoupper($row['producto'])?></a>
                                <span class=hidden-desktop><?php echo strtoupper($row['producto'])?></span>
                                </td>
								<td><a class="hidden-print" href="index.php?data=productos&filtro=sub&sub=<?php echo $row['subcategoria_id']?>"><?php echo $row['subcategoria']?></a>
                                <span class=hidden-desktop><?php echo $row['subcategoria']?></span></td>
								<td style="text-align:right;"><?php echo dinero($row['precio_compra']*1.16)?></td>
								<?php echo "<td";
                                  if ($vlimp>$row['precio_compra']) echo " style=\"text-align:right;\">";
                                        else echo " style=\"text-align:right;background:red;color:white;\"> ** ";

									 echo dinero($vlimp);
                                     echo "</td>";
                                     ?>
								<td style="text-align:right;"><?php echo dinero($row['precio_contado']*1.16)?></td>
								<td style="text-align:right;"><?php echo dinero($row['precio_credito']*1.16)?></td>
                                <td style="text-align:right;"><?php echo dinero($row['descuento'])?></td>
								<td style="text-align:right;"><?php echo $productos_vendidos;//$row['stock']?></td>
								<td class="center"><a class="hidden-print" href="index.php?data=productos&filtro=proveedor&pid=<?php echo $row['proveedor_id']?>"><?php echo $row['proveedor']?></a>
                                <span class=hidden-desktop><?php echo $row['proveedor']?></span></td>
								<td class="center hidden-print">
									<a class="btn btn-success hidden-print" href="index.php?data=productos&op=detalles&prid=<?php echo $row['producto_id']?>">
										<i class="halflings-icon white zoom-in"></i>
									</a>
									<a href="index.php?data=productos&op=producto_form&f=editar&prid=<?php echo $row['producto_id']?>"
													class="btn btn-primary hidden-print"><i class="halflings-icon white edit"></i></a>

									<a href="index.php?data=clientes&op=subirfoto&cid=<?php echo $producto_id?>"
											 class="btn btn-info hidden-print"><i class="halflings-icon white th-list"></i></a><br>
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





<div class="box span12 hidden-desktop hidden-print" >
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
								  <th class="hidden-print">Acciones</th>

							  </tr>
						  </thead>
						  <tbody>

						<?php

						$query = "SELECT producto.codigo,producto_id,producto,precio_compra,precio_contado,precio_credito,stock,proveedor,subcategoria FROM producto,proveedor,subcategoria
								where producto.proveedor_id=proveedor.proveedor_id AND producto.subcategoria_id=subcategoria.subcategoria_id";
                        $query.=$filtro;
								$results = $database->get_results( $query );
						foreach( $results as $row )
						{


						?>
							<tr>
								<td class="center"><?php echo $row['codigo']?></td>
								<td>
                                <a class="hidden-print" href=index.php?data=productos&op=detalles&prid=<?=$row['producto_id']?>><?php echo strtoupper($row['producto'])?></a>
                                <?php echo strtoupper($row['producto'])?>
                                PCM: $<?php echo ($row['precio_compra']+($row['precio_credito']*.16))?> PCN: $<?php echo ($row['precio_contado']+($row['precio_contado']*.16))?> PVE: $<?php echo ($row['precio_credito']+($row['precio_credito']*.16))?> </td>
								<td class="center"><?php echo $row['subcategoria']?></td>
								<td class="center"><?php echo $row['proveedor']?></td>
								<td class="center hidden-print">
									<a class="btn btn-success hidden-print" href="index.php?data=productos&op=detalles&prid=<?php echo $row['producto_id']?>">
										<i class="halflings-icon white zoom-in"></i>
									</a>
									<a href="index.php?data=productos&op=producto_form&f=editar&prid=<?php echo $row['producto_id']?>"
													class="btn btn-primary hidden-print"><i class="halflings-icon white edit"></i></a>

									<a href="index.php?data=clientes&op=subirfoto&cid=<?php echo $producto_id?>"
											 class="btn btn-info hidden"><i class="halflings-icon white th-list"></i></a><br>
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