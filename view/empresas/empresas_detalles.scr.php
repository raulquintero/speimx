<?php

$eid=(htmlspecialchars($_GET["eid"]));
$query = "SELECT empresa.empresa_id,rfc,empresa,contacto,  
	telefono, email,domicilio,colonia_id, telefono_oficina, gruponomina.gruponomina FROM empresa,gruponomina 
	WHERE empresa.empresa_id=$eid  AND empresa.gruponomina_id=gruponomina.gruponomina_id";
//$results = $database->get_results( $query );
//$query = "SELECT group_id, group_name, group_parent FROM your_table WHERE group_name LIKE '%production%'";
list( $empresa_id, $rfc,$empresa, $contacto, $telefono,$email, $domicilio,$colonia_id,$telefono_oficina,$gruponomina ) = $database->get_row( $query );



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
			<td><font >".$row['fecha']." </td>";

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