<?php




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



function catalogo()
{
$database = new DB();
	
	$query = "SELECT categoria_id,categoria  FROM categoria 
		where 1 ";

	
	$results = $database->get_results( $query );
	
	
	
	foreach( $results as $row )
	{
		
		
		echo "<tr >
			<td colspan=3><a href=/index.php?data=catalogo&cat=".$row['categoria_id'].">".$row['categoria']."</a> </td>
			</tr>";


	$query = "SELECT subcategoria_id,subcategoria  FROM subcategoria where categoria_id=".$row['categoria_id'];
	$subs = $database->get_results( $query );
	
				foreach( $subs as $sub )
					{		


					$query = "SELECT count(producto_id) as productos FROM producto 
					where subcategoria_id=".$sub['subcategoria_id'];
					list($productos)= $database->get_row($query);

					echo "<tr><td></td><td align=right> 
						<a href=/index.php?data=catalogo&subcat=".$sub['subcategoria_id'].">".$sub['subcategoria']."</a>&nbsp;&nbsp; </td>
						<td>$productos</td></tr>";
					}
	
	}						  	


}

function productos($subcat)
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
					$query = "SELECT producto_id,producto,precio_compra,stock  FROM producto where subcategoria_id=$subcat";
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

function subcategorias($categoria_id)
{
$database = new DB();

$query = "SELECT categoria  FROM categoria where categoria_id=$categoria_id ";
list( $categoria ) = $database->get_row( $query );


			

echo "<div class=\"box-header\">
						<h2><i class=\"halflings-icon align-justify\"></i><span class=\"break\"></span>Subcategorias de: ".strtoupper($categoria)." </h2>
						<div class=\"box-icon\">
							<a href=\"#\" class=\"btn-setting\"><i class=\"halflings-icon wrench\"></i></a>
							<a href=\"#\" class=\"btn-minimize\"><i class=\"halflings-icon chevron-up\"></i></a>
							<a href=\"#\" class=\"btn-close\"><i class=\"halflings-icon remove\"></i></a>
						</div>
					</div>
					<div class=\"box-content\">";


echo"			<form class=\"form-horizontal\" action=\"/functions/crud_proveedores.php\">
							<fieldset>

								
								<div class=\"control-group \">
								
								<label class=\"control-label\" for=\"categoria\">SubCategoria</label>
								<div class=\"controls\">
								  <input class=\"input-large\" id=\"categoria\" name=\"categoria\" type=\"text\" value=\"".strtoupper($rfc)."\"> 
								<button type=\"submit\" class=\"btn btn-primary\">Agregar SubCategoria</button>
								</div>
							  </div>
							

							</fieldset>
						</form>";





						echo "<table class=\"table table-striped table-bordered \">
							  <thead>
								  <tr>
									  <th>Subcategoria</th>
									  <th>Productos</th>
									  <th>Acciones</th>
								  </tr>
							  </thead>   
							  <tbody>";

$query = "SELECT subcategoria_id,subcategoria  FROM subcategoria where categoria_id=".$categoria_id;
	$subs = $database->get_results( $query );
	
				foreach( $subs as $sub )
					{		


					$query = "SELECT count(producto_id) as productos FROM producto 
					where subcategoria_id=".$sub['subcategoria_id'];
					list($productos)= $database->get_row($query);

					echo "<tr><td align=right> 
						<a href=/index.php?data=catalogo&subcat=".$sub['subcategoria_id'].">".$sub['subcategoria']."</a>&nbsp;&nbsp; </td>
						<td>$productos</td></tr>";
					}

echo "				  </tbody>
						 </table>     
					</div>
				";

}

?>