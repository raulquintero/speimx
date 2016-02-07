
<form action="/index.php" method="get">
<table  width=100%  >
				 			<tr bgcolor=#FFE104>
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
if ($code)
{
	$query="SELECT producto.producto_id,producto,precio_contado,precio_credito,descuento,stock,cantidad,subcategoria,color,talladet
	from producto,inventariodet,subcategoria,color,talladet
		where producto.producto_id=inventariodet.producto_id AND
		producto.subcategoria_id=subcategoria.subcategoria_id AND
		color.color_id=inventariodet.color_id AND
		talladet.talladet_id=inventariodet.talladet_id AND
		inventariodet.codigo=$code";

	list( $producto_id,$producto,$precio_contado,$precio_credito,$descuento,$stock,$cantidad,$subcategoria,$color,$talla) = $database->get_row( $query );
}

if ($producto_id)
{

?>
	<div class="priority low"><span><?php echo $code?></span></div>

					<div class="task low">
						<div class="desc">
							<div class="title"><?php echo $producto?></div>
							<div>Color: <b><?php echo $color?></b> &nbsp;&nbsp;&nbsp;Talla: <b><?php echo $talla?></b></div>
						</div>
						<div class="time">
							<div class="date">Jun 1, 2012</div>
							<div> 1 day</div>
						</div>
					</div>
					<div class="task low">
						<div class="desc">
							<div class="title">Precio Contado</div>
							<div><button class="btn btn-large btn-primary">$ <?php echo dinero($precio_contado*1.16)?></button></div>
                        <?php
                         if ($descuento)
                          {  echo "<div><button class=\"btn btn-large btn-warning\"> <font color=black>";
                            echo "Desc.".$descuento."%:  $ ". dinero($precio_contado*1.16-($precio_contado*1.16*$descuento/100));
                            echo "</font></button></div>";
                            }
                         ?>

                        </div>
						<div class="time">
							<div class="date">Jun 1, 2012</div>
							<div> 1 day</div>
						</div>
					</div>
					<div class="task low">
						<div class="desc">
							<div class="title">Precio Credito</div>
							<div><button class="btn btn-large">$ <?php echo dinero($precio_credito*1.16)?></button></div>
						</div>
						<div class="time">
							<div class="date">Jun 1, 2012</div>
							<div> 1 day</div>
						</div>
					</div>
					<div class="task low">
						<div class="desc">
							<div class="title">Stock</div>
							<div>Talla:<?php echo $stock?>
								<br>Modelo:<?php echo $cantidad?>
							</div>
						</div>
						<div class="time">
							<div class="date">Jun 1, 2012</div>
							<div> 1 day</div>
						</div>
					</div>

<?php
	// echo "<br> $code";
	// echo "<br> <h2>$producto</h2>";
	// echo "<br> $subcategoria";
	// echo "<br>Precio Contado: $".dinero($precio_contado*1.16);
	// echo "<br>Precio Credito: $".dinero($precio_credito*1.16);

	// echo "<br>Color: $color";
	// echo "<br>Talla: $talla";
	// echo "<br>Stock: $stock";
	// echo "<br>Stock General: $cantidad";

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