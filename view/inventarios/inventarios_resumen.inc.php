<?php 
$isid=isset($_GET['isid']) ? $_GET['isid'] :"";
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
where inventariosdet.producto_id=producto.producto_id 
GROUP BY inventariosdet.producto_id";
$results=$database->get_results($query);

	foreach($results as $row)
	{
		echo "<tr><td>".$row['producto_id']."</td><td>".strtoupper($row['producto'])."</td><td>".$row['tsistema']."</td><td>".$row['tinventario']."</td></tr>";

	}
?>

	</tbody>
</table>
