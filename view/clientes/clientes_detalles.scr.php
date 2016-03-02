<?php

$cid=(htmlspecialchars($_GET["cid"]));
$query = "SELECT cliente_id,gruponomina.gruponomina_id,gruponomina,empresa, curp,nombre, apellidop, apellidom, domicilio_casa, 
	telefono_personal, credito,saldo,abono,fecha_total_inicio,fecha_total_ultimo,
	total_ultimo,cliente.observaciones,tipocredito_id FROM cliente,gruponomina, empresa WHERE cliente.cliente_id=$cid  
	AND empresa.gruponomina_id=gruponomina.gruponomina_id AND cliente.empresa_id=empresa.empresa_id";
//$results = $database->get_results( $query );
//$query = "SELECT group_id, group_name, group_parent FROM your_table WHERE group_name LIKE '%production%'";
list( $cliente_id,$gruponomina_id, $gruponomina, $empresa, $curp,$nombre, $apellidop,$apellidom,$domicilio_casa, 
	$telefono_personal,$credito,$saldo,	$abono,$fecha_total_inicio,$fecha_total_ultimo,$total_ultimo, $observaciones,$tipocredito_id) = $database->get_row( $query );

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
	$fecha_hoy=date("Y-m-d  H:i:s");
	$fecha=fechaminusmonth($fecha_hoy,3);
	 $query = "SELECT sum(cantidad) FROM cliente,movimiento,admin,tipomov 
		where movimiento.cliente_id=$cliente_id AND movimiento.tipomov_id=tipomov.tipomov_id AND movimiento.cliente_id=cliente.cliente_id 
		AND movimiento.admin_id=admin.admin_id AND fecha >= '$fecha' AND tipomov.tmov=1 ORDER BY movimiento.fecha ASC limit 100";
	list($total_abonos) = $database->get_row($query);
	$query = "SELECT sum(cantidad) FROM cliente,movimiento,admin,tipomov 
		where movimiento.cliente_id=$cliente_id AND movimiento.tipomov_id=tipomov.tipomov_id AND movimiento.cliente_id=cliente.cliente_id 
		AND movimiento.admin_id=admin.admin_id AND fecha >= '$fecha' AND tipomov.tmov=0 ORDER BY movimiento.fecha ASC limit 100";
	list($total_cargos) = $database->get_row($query);
	 $query = "SELECT factura_id,fecha, cantidad, tipomov.tipomov,tmov, admin.nombre,total_ultimo FROM cliente,movimiento,admin,tipomov 
		where movimiento.cliente_id=$cliente_id AND movimiento.tipomov_id=tipomov.tipomov_id AND movimiento.cliente_id=cliente.cliente_id 
		AND movimiento.admin_id=admin.admin_id AND fecha >= '$fecha' ORDER BY movimiento.fecha ASC limit 100";

	$saldo=$saldo+$total_cargos-$total_abonos;
	$results = $database->get_results( $query );
	
	$i=0;
	foreach( $results as $row )
	{
		if ($row['tmov']==0 || $row['tmov']==1 )
		{
		$i+=1;

		if ($row['tmov']==0)		
			$saldo-=$row['cantidad'];
		if ($row['tmov']==1)
			$saldo+=$row['cantidad'];

		echo "<tr >
			<td align=right><font >&nbsp;$i&nbsp;</td>
			<td><a class=\"hidden-print\" href=\"/index.php?data=clientes&op=factura&fid=".$row['factura_id']."\">".($row['fecha'])."<a>
				<a class=\"visible-print\" >".fechamysqltomx($row['fecha'],1)."<a>
			 </td>";

			if ($row['tmov']==0)
			{
				echo "<td align=center>---</td>
				<td align=right> <font >".$row['cantidad']."&nbsp;&nbsp; </td>";
			}
			if ($row['tmov']==1)
			{
					echo "
				<td align=right> <font >".$row['cantidad']."&nbsp;&nbsp; </td>
				<td align=center>---</td>";
			}	



			echo "<td><font ><b>".dinero($saldo)."</td>
			<td><font >".$row['tipomov']."</td>
			<td hidden> <font >".$row['admin_id']."</td>";

		echo "</tr>";
	
		}
	}						  	


}



?>