<?php 
$isid=isset($_GET['isid']) ? $_GET['isid'] :"";
//echo $_GET['tid'];
$teid=isset($_GET['tid']) ? $_GET['tid'] :"7";
?>
<form action='/functions/crud_inventarios.php' method='GET'>
<table width="100%" class='hidden-print'>
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


<div class="row-fluid condensed">
					<div class="box span4 hidden-print">
					<div class="box-header " data-original-title >
						<h2><i class="halflings-icon barcode"></i><span class="break"></span>Temporadas</h2>
						<div class="box-icon">
							<a href="index.php?data=clientes&op=cliente_form&f=agregar" ><i class="halflings-icon plus"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php  
						echo "<table class='table'>";

						$query ="SELECT temporada_id as tid,temporada,
						(SELECT count(producto_id)  from producto where temporada_id=tid) as items from temporada";
						$results=$database->get_results($query);

						foreach ($results as $row)
						{	$tid=$row['tid'];
							echo "<tr><td><a href=/index.php?data=inventarios&op=resumen&isid=1&tid=$tid>".strtoupper($row['temporada'])."</a></td><td>".$row['items']."<td></tr>";
						}
						
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

                  

					</div>
		</div><!--/span-->



					</div>




				<div class="box span8 ">
					<div class="box-header " data-original-title >
						<?php 
		$query = "SELECT temporada from temporada where temporada_id=$teid";
		list ($temporada)=$database->get_row($query);
						echo "<h2><i class=\"halflings-icon barcode\"></i><span class=\"break\"></span>".strtoupper($temporada)."</h2>";
		 ?>
						<div class="box-icon">
							<i class="halflings-icon plus"></i>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					

						<div class="box-content">


<table class="table table-striped table-bordered">
	<thead>
	<tr>

		<td>Id</td><td>Producto</td><td>Sistema</td><td>Inventario</td>
	</tr>
	</thead>
	<tbody>

<?php

//SELECT numemp, nombre, (SELECT MIN(fechapedido) FROM pedidos WHERE rep = numemp)
//FROM empleados;


  $query="SELECT inventariosdet.producto_id,producto,sistema,inventario,
	(SELECT sum(inventario) from inventariosdet as idet where idet.producto_id=inventariosdet.producto_id) as tinventario,
	(SELECT sum(sistema) from inventariosdet as idet where idet.producto_id=inventariosdet.producto_id) as tsistema
	from inventariosdet,producto 
where inventariosdet.producto_id=producto.producto_id  AND temporada_id=$teid
GROUP BY inventariosdet.producto_id";
$results=$database->get_results($query);

	foreach($results as $row)
	{
		echo "<tr><td>".$row['producto_id']."</td>
		<td><a class='hidden-print ' href='/index.php?data=productos&op=inventario&prid=".$row['producto_id']."'>".strtoupper($row['producto'])."</a>
			<span class='hidden-desktop'>".strtoupper($row['producto'])."</td>
		<td>".$row['tsistema']."</td><td>".$row['tinventario']."</td></tr>";

	}
?>

	</tbody>
</table>



</div>
</div>