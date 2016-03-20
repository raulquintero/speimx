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

function productos($subcat,$tid)
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
						<table class=\"table table-striped table-bordered\">   <!-- bootstrap-datatable datatable -->
							  <thead>
								  <tr>
									  <th>Id</th>
									  <th>Producto</th>
									  <th>PCM</th>
                                      <th>PCN</th>
									  <th>Stock</th>
                                      <th>Desc</th>
                                      <th>Season</th>
								  </tr>
							  </thead>
							  <tbody>";
					$query = "SELECT producto_id,codigo,producto,precio_compra,precio_contado,stock,producto.descuento,temporada
                        FROM producto,temporada where producto.temporada_id=temporada.temporada_id AND subcategoria_id=$subcat";
                        if($tid>=0)
                        $query.=" AND producto.temporada_id=$tid";
					$subs = $database->get_results( $query );

					foreach( $subs as $sub )
						{
                            if ($_GET['prid']==$sub['producto_id'])
                            echo "<tr bgcolor=green'>";
                            else
                            echo "<tr>";
							echo "<td>".$sub['codigo']."</td>
							<td><a href=\"#\" onclick='showProduct(". $sub['producto_id'].")'
                            class=\"btn-setting\">".$sub['producto']."</a>&nbsp;&nbsp;";
                            if ($_GET['prid']==$sub['producto_id']) echo "<i class=\"halflings-icon ok \"></i>";
                            echo "</td>
							<td style='text-align:right'>".dinero($sub['precio_compra']*1.16)."</td>
							<td style='text-align:right'>".dinero($sub['precio_contado']*1.16)."</td>
							<td style='text-align:right'>".$sub['stock']."</td>
                            <td style='text-align:right'>".$sub['descuento']."%</td>
                            <td style='text-align:right'>".strtoupper($sub['temporada'])."</td>
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
								
								<label class=\"control-label\" for=\"subcategoria\">SubCategoria</label>
								<div class=\"controls\">
								  <input class=\"input-large\" id=\"subcategoria\" name=\"subcategoria\" type=\"text\" value=\"".strtoupper($rfc)."\"> 
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