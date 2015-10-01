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



function tallas()
{
$database = new DB();
	
	$query = "SELECT talla_id,talla  FROM talla 
		where 1 ";

	
	$results = $database->get_results( $query );
	
	
	
	foreach( $results as $row )
	{
		
		
		echo "<tr >
			<td colspan=3><a href=/index.php?data=tallas&talla_id=".$row['talla_id'].">".$row['talla']."</a> </td>
			</tr>";


	$query = "SELECT talladet_id,talladet  FROM talladet where talla_id=".$row['talla_id'];
	$subs = $database->get_results( $query );
	
				foreach( $subs as $sub )
					{		


					$query = "SELECT count(producto_id) as productos FROM producto 
					where subcategoria_id=".$sub['subcategoria_id'];
					//list($productos)= $database->get_row($query);

					echo "<tr><td></td><td align=right> 
						<a href=/index.php?data=tallas&subcat=".$sub['talladet_id'].">".$sub['talladet']."</a>&nbsp;&nbsp; </td>
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
					$query = "SELECT producto_id,codigo,producto,precio_compra,stock  FROM producto where subcategoria_id=$subcat";
					$subs = $database->get_results( $query );
	
					foreach( $subs as $sub )
						{		
							echo "<tr>
							<td>".$sub['codigo']."</td>
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

function tallasdet($talla_id)
{
$database = new DB();

$query = "SELECT talla  FROM talla where talla_id=$talla_id ";
list( $talla ) = $database->get_row( $query );


			

echo "<div class=\"box-header\">
						<h2><i class=\"halflings-icon align-justify\"></i><span class=\"break\"></span>tallas de: ".strtoupper($talla)." </h2>
						<div class=\"box-icon\">
							<a href=\"#\" class=\"btn-setting\"><i class=\"halflings-icon wrench\"></i></a>
							<a href=\"#\" class=\"btn-minimize\"><i class=\"halflings-icon chevron-up\"></i></a>
							<a href=\"#\" class=\"btn-close\"><i class=\"halflings-icon remove\"></i></a>
						</div>
					</div>
					<div class=\"box-content\">";


echo"			<form class=\"form-horizontal\" action=\"/functions/crud_tallas.php\">
							<fieldset>

								
								<div class=\"control-group \">
								
								<label class=\"control-label\" for=\"categoria\">Talla</label>
								<div class=\"controls\">
								  <input class=\"input-large\" id=\"talladet\" name=\"talladet\" type=\"text\" value=\"".strtoupper($rfc)."\"> 
								<button type=\"submit\" class=\"btn btn-primary\">Agregar Talla</button>
								</div>
							  </div>
							

							</fieldset>
						</form>";





						echo "<table class=\"table table-striped table-bordered \">
							  <thead>
								  <tr>
									  <th>id</th>
									  <th>Subcategoria</th>
									  <th>Orden</th>
									  <th>Acciones</th>
								  </tr>
							  </thead>   
							  <tbody>";

$query = "SELECT talladet_id,talladet,orden  FROM talladet where talla_id=".$talla_id;
	$subs = $database->get_results( $query );
	
				foreach( $subs as $sub )
					{		


					$query = "SELECT count(producto_id) as productos FROM producto 
					where subcategoria_id=".$sub['subcategoria_id'];
					//list($productos)= $database->get_row($query);

					echo "<tr><td>".$sub['talladet_id']."</td><td align=right> 
						<a href=/index.php?data=catalogo&subcat=".$sub['talladet_id'].">".$sub['talladet']."</a>&nbsp;&nbsp; </td>
						<td>".$sub['orden']."</td><td>$productos</td></tr>";
					}

echo "				  </tbody>
						 </table>     
					</div>
				";

}

?>