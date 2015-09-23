<?php

$prid=$pid=(htmlspecialchars($_GET["pid"]));
$query = "SELECT proveedor.proveedor_id,rfc,proveedor,contacto,  
	telefono, email,domicilio,colonia_id, telefono_oficina FROM proveedor 
	WHERE proveedor.proveedor_id=$pid ";
//$results = $database->get_results( $query );
//$query = "SELECT group_id, group_name, group_parent FROM your_table WHERE group_name LIKE '%production%'";
list( $proveedor_id, $rfc,$proveedor, $contacto, $telefono,$email, $domicilio,$colonia_id,$telefono_oficina,$gruponomina ) = $database->get_row( $query );

$query = "SELECT count(producto_id) as productos FROM producto 
					where  proveedor_id=$proveedor_id";
					list($productos)= $database->get_row($query);




function n_pagos_total($total_ultimo,$abono)
{
 	 return $num_pagos = ceil($total_ultimo/$abono);
//	 return $num_pagos;

}

function n_pagos_restantes($total_ultimo,$saldo,$abono)
{

 	 return $num_pagos = ceil(($saldo)/$abono);
	 //return $num_pagos;

}



function catalogo($proveedor_id)
{
$database = new DB();
	
	$query = "SELECT categoria_id,categoria  FROM categoria 
		where 1 ";

	
	$results = $database->get_results( $query );
	
	
	
	foreach( $results as $row )
	{
		
		
		echo "<tr >
			<td><font >".$row['categoria']." </td>
			<td><font > </td>
			<td><font > </td>
			<td><font > </td>
			<td><font > </td>
			</tr>";


	$query = "SELECT subcategoria_id,subcategoria  FROM subcategoria where categoria_id=".$row['categoria_id'];
	$subs = $database->get_results( $query );
	
				foreach( $subs as $sub )
					{		
					$query = "SELECT MIN(precio_compra) as precio_min,MAX(precio_compra) as precio_max FROM producto 
						where subcategoria_id=".$sub['subcategoria_id']." AND proveedor_id=$proveedor_id";
					list($precio_min,$precio_max)= $database->get_row($query);


					$query = "SELECT count(producto_id) as productos FROM producto 
					where subcategoria_id=".$sub['subcategoria_id']." AND proveedor_id=$proveedor_id";
					list($productos)= $database->get_row($query);

					echo "<tr><td></td><td align=right> 
						<a href=/index.php?data=proveedores&op=detalles&pid=$proveedor_id&subcat=".$sub['subcategoria_id'].">".$sub['subcategoria']."</a>&nbsp;&nbsp; </td>
						<td>$productos</td><td style='text-align:right'>".dinero($precio_min)."</td><td style='text-align:right'>".dinero($precio_max)."</td></tr>";
					}
	
	}						  	


}

function productos($proveedor_id,$subcat)
{
$database = new DB();
echo "<div class=\"box-header\">
						<h2><i class=\"halflings-icon align-justify\"></i><span class=\"break\"></span>Productos</h2>
						<div class=\"box-icon\">
							<a href=\"#\" class=\"btn-setting\"><i class=\"halflings-icon wrench\"></i></a>
							<a href=\"#\" class=\"btn-minimize\"><i class=\"halflings-icon chevron-up\"></i></a>
							<a href=\"#\" class=\"btn-close\"><i class=\"halflings-icon remove\"></i></a>
						</div>
					</div>
					<div class=\"box-content\">
						<table class=\"table table-striped table-bordered bootstrap-datatable datatable\">
							  <thead>
								  <tr>
									  <th>Id</th>
									  <th>Producto</th>
									  <th>P. Compra</th>
									  <th>Stock</th>
								  </tr>
							  </thead>   
							  <tbody>";
					$query = "SELECT producto_id,producto,precio_compra,stock  FROM producto where proveedor_id=$proveedor_id AND subcategoria_id=$subcat";
					$subs = $database->get_results( $query );
	
					foreach( $subs as $sub )
						{		
							echo "<tr>
							<td>".$sub['producto_id']."</td>
							<td>".$sub['producto']."</td>
							<td style='text-align:right'>".$sub['precio_compra']."</td>
							<td style='text-align:right'>".$sub['stock']."</td>
							</tr>";	
							
						}



								                                  
			echo "				  </tbody>
						 </table>     
					</div>
				";
}

function movimientos($proveedores_id)
{
echo "<div class=\"box-header\">
						<h2><i class=\"halflings-icon align-justify\"></i><span class=\"break\"></span>Movimientos</h2>
						<div class=\"box-icon\">
							<a href=\"#\" class=\"btn-setting\"><i class=\"halflings-icon wrench\"></i></a>
							<a href=\"#\" class=\"btn-minimize\"><i class=\"halflings-icon chevron-up\"></i></a>
							<a href=\"#\" class=\"btn-close\"><i class=\"halflings-icon remove\"></i></a>
						</div>
					</div>
					<div class=\"box-content\">
						<table class=\"table table-striped table-bordered bootstrap-datatable datatable\">
							  <thead>
								  <tr>
									  <th>ID</th>
									  <th>Fecha</th>
									  <th>Saldo</th>
									  <th>Abono</th>
									  <th></th>                                          
								  </tr>
							  </thead>   
							  <tbody>";
								
							




								                                  
			echo "				  </tbody>
						 </table>     
					</div>
				";
}

?>