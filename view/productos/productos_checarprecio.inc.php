
<form action="/index.php" method="get">
<table  width=100%  >
				 			<tr bgcolor=#dddddd>
				  			<td style="padding:10px">

							<input type=hidden name=data value=pos>
							<input type=hidden name=op value=detalles>
							<input type=hidden name=type value=checarprecio>
				  			 &nbsp;&nbsp;Codigo <input classe="input-xlarge" id="textcode" name="code" >
				  			</td>
				  		</tr>
				  		</table>
</form>

<?php

$code=$_GET['code'];
	$query="SELECT producto.producto_id,producto,precio_contado,precio_credito,stock,cantidad,subcategoria,color,talladet
	from producto,inventariodet,subcategoria,color,talladet
		where producto.producto_id=inventariodet.producto_id AND 
		producto.subcategoria_id=subcategoria.subcategoria_id AND 
		color.color_id=inventariodet.color_id AND 
		talladet.talladet_id=inventariodet.talladet_id AND
		inventariodet.codigo=$code";
	
	list( $producto_id,$producto,$precio_contado,$precio_credito,$stock,$cantidad,$subcategoria,$color,$talla) = $database->get_row( $query );

if ($producto_id)
{

	echo "<br> $code";
	echo "<br> $producto";
	echo "<br> $subcategoria";
	echo "<br>Precio Contado: $".dinero($precio_contado*1.16);
	echo "<br>Precio Credito: $".dinero($precio_credito*1.16);

	echo "<br>Color: $color";
	echo "<br>Talla: $talla";
	echo "<br>Stock: $stock";

	$query="SELECT color from color where  producto_id=$producto_id ";

	$results = $database->get_results( $query );
	
	
	$i=0;
	foreach( $results as $row )
	{

	}

}
else
{
				echo "<div class=\"alert alert-block span10\">
					<h4 class=\"alert-heading\">Aviso!</h4>
					<p>No se encotro informacion sobre este producto.</p>
				</div>";

}
?>