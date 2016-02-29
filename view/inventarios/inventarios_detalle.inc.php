<?php 
$code=isset($_GET['code']) ? $_GET['code'] :"0";
$isid=isset($_GET['isid']) ? $_GET['isid'] :"0";

?>
<form action='/functions/crud_inventarios.php' method='GET'>
<table width="100%">
				 			<tbody><tr bgcolor="#0E3500">
				  			<td style="padding:10px">

							<input type="hidden" name="data" value="inventarios">
							<input type="hidden" name="op" value="detalle">
							<input type="hidden" name="func" value="i">
							<input type="hidden" name="isid" value="<?php echo $isid?>">
				  			 &nbsp;&nbsp;<font color="white">Codigo:</font> <input class="input-large" onkeypress="return enfocarPos(event)" id="textcode" name="code">
				  			</td>
				  		</tr>
				  		</tbody></table>
</form>
<?php 
$query = "SELECT producto,producto.producto_id as prid,inventariosdet.codigo,color,color.color_id,talladet,inventario,
	(SELECT sum(inventario) from inventariosdet where producto_id=prid)  
	from producto,inventariosdet,color,talladet 
	where producto.producto_id=inventariosdet.producto_id AND inventariosdet.color_id=color.color_id 
	AND inventariosdet.talladet_id=talladet.talladet_id
	AND inventariosdet.codigo='$code'";

if (isset($code)) list($producto,$producto_id,$codigo,$color,$color_id,$talladet,$inventario,$global) = $database->get_row($query);


 ?>
<div class="row-fluid condensed">
					<div class="box span6 hidden-print">
					<div class="box-header " data-original-title >
						<h2><i class="halflings-icon barcode"></i><span class="break"></span>Inventario [<?php echo $isid?>]</h2>
						<div class="box-icon">
							<a href="index.php?data=clientes&op=cliente_form&f=agregar" ><i class="halflings-icon plus"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php  
						echo "<table class='table'>";
						echo "<tr><td><h2>$producto</h2></td><td><h2>$code</h2></td><td><h2>GlobaL: $global</h2></td></tr>";
						echo "<tr><td><h2>Color: $color </h2></td><td><h2>Talla: $talladet</h2></td>
								<td><h2>Total: <button>-</button> $inventario <button>+</button></h2></td></tr>";
						echo "</table>";
						?>
						</div>


<div class="box-noborder">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Imagenes <?php echo $_GET['prid'].$color_id?></h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">

                      <?php
               	$query = "SELECT producto.producto_id,producto,subcategoria,color from producto,subcategoria,color
                    where producto.subcategoria_id=subcategoria.subcategoria_id
                    AND '$color_id'=color.color_id
                    AND producto.producto_id='".$producto_id."'";
				list( $producto_id,$producto,$subcategoria,$color) = $database->get_row( $query );
                $nombre_producto=ucwords(strtolower($producto));
            $nombre_producto = str_replace(" ", "-", $nombre_producto);
            $nombre_subcategoria = ucwords(str_replace(" ", "-", $subcategoria));
            $nombre_color=ucwords(strtolower($color));

            $nombre_archivo=$nombre_subcategoria."-".$nombre_producto."-".$nombre_color."-".$producto_id."_p.jpg";
                                ?>
						  	<table class="table table-condensed">

							  <tbody>
							  	<tr><td align=center>

							  		<img src='/productos/<?php echo $nombre_archivo?>' width=200>
							  	</td>
							  	<td>




							  		<form action="view/productos/subirf.php" method="post" enctype="multipart/form-data">
										<p><input type="file" name="uploadedfile" /></p>
										<p><input type="submit" value="Subir Foto" /></p>
                                        <input type="hidden" name="prid" value="<?php echo $_GET['prid']?>"/>
                                        <input type="hidden" name="color" value="<?php echo $color_id?>"/>
                                        <input type="hidden" name="nombre_archivo" value="<?php echo $nombre_archivo?>"/>
                                        <input type="hidden" name="isid" value="<?php echo $isid?>" />
                                        <input type="hidden" name="code" value="<?php echo $code?>" />
                                        <input type="hidden" name="data" value="<?php echo $_GET['data']?>" />
                                        <input type="hidden" name="op" value="<?php echo $_GET['op']?>" />
                                        <input type="hidden" name="f" value="a"/>
									</form>
                                </td>
                                </tr>
 							 </tbody>
						 </table>
						No hay imagenes por el momento

					</div>
		</div><!--/span-->



					</div>




				<div class="box span6 hidden-print">
					<div class="box-header " data-original-title >
						<h2><i class="halflings-icon barcode"></i><span class="break"></span>Tallas</h2>
						<div class="box-icon">
							<a href="index.php?data=clientes&op=cliente_form&f=agregar" ><i class="halflings-icon plus"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					

						<div class="box-content">
						<table class="table table-striped table-bordered"> <temp="bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Talla</th>
							  	  <th>Sistema</th>
								  <th>Inventario</th>
								  <th>diferencia</th>
							  </tr>
						  </thead>
						  <tbody>
<?php 

$query="SELECT producto_id,color_id from inventariosdet WHERE inventarios_id='$isid' AND codigo='$code'";
list($producto_id,$color_id)=$database->get_row($query);
$query ="SELECT talladet,sistema,inventario,(sistema-inventario) as diferencia FROM inventariosdet,talladet 
	where inventariosdet.talladet_id=talladet.talladet_id AND inventariosdet.color_id='$color_id' 
	AND inventariosdet.producto_id='$producto_id' AND inventarios_id='$isid' ORDER BY orden";
$results=$database->get_results($query);

foreach ($results as $row)
{
echo "<tr><td>".$row['talladet']."</td><td>".$row['sistema']."</td><td>".$row['inventario']."</td><td>".$row['diferencia']."</td></tr>";

}

 ?>

						  </tbody>
						</table>
					</div>
						</div >  <!--table -->






</div>