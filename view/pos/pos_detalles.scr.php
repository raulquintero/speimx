<?php

$prid=(htmlspecialchars($_GET["prid"]));
$query = "SELECT producto_id,producto,proveedor,precio_compra,precio_contado,precio_credito,precio_promocion,descuento,
		marca,producto.codigo,producto.talla_id,talla,unidad,estilo,subcategoria FROM producto,proveedor,marca,talla,unidad,subcategoria 
	WHERE producto.proveedor_id=proveedor.proveedor_id AND producto.marca_id=marca.marca_id AND producto.talla_id=talla.talla_id
		AND producto.unidad_id=unidad.unidad_id AND producto.subcategoria_id=subcategoria.subcategoria_id AND producto_id=".$prid;
list( $producto_id,$producto,$proveedor,$precio_compra,$precio_contado,$precio_credito,$precio_promocion,$descuento,
		$marca,$codigo, $talla_id, $talla,$unidad,$estilo,$subcategoria  ) = $database->get_row( $query );



function n_pagos_total($total_ultimo,$abono)
{
 	 return $num_pagos = ceil($total_ultimo/$abono);
//	 return $num_pagos;

}





function movimientos($cliente_id,$saldo)
{
$database = new DB();
	
	$query = "SELECT fecha, cantidad, tipomov.tipomov,tmov, admin.nombre,total_ultimo FROM cliente,movimiento,admin,tipomov 
		where movimiento.cliente_id=$cliente_id AND movimiento.tipomov_id=tipomov.tipomov_id AND movimiento.cliente_id=cliente.cliente_id 
		AND movimiento.admin_id=admin.admin_id AND fecha >= '2014-01-01' ORDER BY movimiento.fecha DESC limit 100";

	
	$results = $database->get_results( $query );
	
	
	$i=0;
	foreach( $results as $row )
	{
		
		$i+=1;
		echo "<tr >
			<td align=right><font >&nbsp;$i&nbsp;</td>
			<td><font >".fechamysqltous($row['fecha'],1)." </td>";

			if (!$row['tmov'])
					echo "<td align=center>---</td>
					<td align=right> <font >".$row['cantidad']."&nbsp;&nbsp; </td>";
				else
					echo "
					<td align=right> <font >".$row['cantidad']."&nbsp;&nbsp; </td>
					<td align=center>---</td>";
				


			echo "<td><font ><b>$ $saldo.00</td>
			<td><font >".$row['tipomov']."</td>
			<td> <font >".$row['admin_nombre']."</td></tr>";


		if (!$row['tmov'])		
			$saldo+=$row['cantidad'];
		else
			$saldo-=$row['cantidad'];
	
	}						  	


}





?>