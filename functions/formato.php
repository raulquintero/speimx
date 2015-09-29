<?php


function dinero($numero)
{
	return money_format(" %.2n", $numero);

}

function fechamysqltous($fecha,$letra)
{

	$fecha=explode(" ",$fecha);
	$values=preg_split('/(\/|-)/',$fecha[0]);
	

	if ($letra)
		{
				switch ($values[1]) {
  					  	case 1:	$mes="Ene"; break;
    					case 2:	$mes="Feb"; break;
    					case 3: $mes="Mar"; break;
  					  	case 4:	$mes="Abr"; break;
    					case 5:	$mes="May"; break;
    					case 6: $mes="Jun"; break;
  					  	case 7:	$mes="Jul"; break;
    					case 8:	$mes="Ago"; break;
    					case 9: $mes="Sep"; break;
  					  	case 10: $mes="Oct"; break;
    					case 11: $mes="Nov"; break;
    					case 12: $mes="Dic"; break;
				}
			

		 
		$fecha =  $mes.'/'.$values[2].'/'.$values[0];
		return $fecha;
	}
			else
		return date("m/d/Y",mktime(0,0,0,$values[1],$values[2],$values[0]));

}

function fechaustomysql($fecha)
{

	$values=preg_split('/(\/|-)/',$fecha);
	return date("Y-m-d",mktime(0,0,0,$values[0],$values[1],$values[2]));

}




function num_ticket16($num)
{
	$n=0;
						$cadena=substr( md5($num),0,16);
						$cadena2="hola";
						for ($i=0; $i < 16; $i++) { 
							$cadena2[$n]=$cadena[$i];
							//print_r($cadena2);
							if ($i==3 || $i==7 || $i==11)
								{
									
									$n++;
									$cadena2[$n]='-';
								}
								
								$n++;
						}
						return($cadena2);
}

function sku13($num)
{
	$n=0;
						$cadena=substr( md5($num),0,13);
						return($cadena);
}

function fechaplusweek($fecha)

{

	$time = strtotime($fecha);
	$final = date("Y-m-d", strtotime("+1 week", $time));
return $final;

}

function plandepagos($total,$fecha,$abono,$saldo)
{
			//$fecha=fechaplusweek($fecha);

	$total_pagos=ceil($total/$abono);


	echo "
					<div class=\"box-header\">
						<h2><i class=\"halflings-icon align-justify\"></i><span class=\"break\"></span>Plan de Pagos</h2>
						<div class=\"box-icon\">
							<a href=\"#\" class=\"btn-setting\"><i class=\"halflings-icon wrench\"></i></a>
							<a href=\"#\" class=\"btn-minimize\"><i class=\"halflings-icon chevron-up\"></i></a>
							<a href=\"#\" class=\"btn-close\"><i class=\"halflings-icon remove\"></i></a>
						</div>
					</div>
					<div>
						<table class=\"table table-condensed striped\">
							  <thead>
								  <tr>
									  <th>ID</th>
									  <th>Fecha Vence</th>
									  <th>Saldo</th>
									  <th>Abono</th>
									  <th></th>                                          
								  </tr>
							  </thead>   
							  <tbody>";

	$c=1;

	$saldo_temp=$total-$saldo;
		for ($i=0; $i < $total_pagos; $i++) {
			$fecha=fechaplusweek($fecha);
			if ($saldo_temp>$abono) $ultimo=$abono;
				else {
					$ultimo=$saldo_temp;
					
				}
			if($total>=($saldo+$abono)){
				$strike_begin="<s>";$strike_end="</s>";
			}
				else 
					$strike_begin=$strike_end="";
			
			echo "<tr><td>".($c)."</td><td align=right>".fechamysqltous($fecha,1)."</td><td class=\"right\">$strike_begin".dinero($total)."$strike_end</td><td class=\"right\"> $strike_begin".dinero($abono)."$strike_end </td><td align=right><font color=gray>".dinero($ultimo)." &nbsp;</td></tr>";
			$total=$total-$abono;
			$c++;
			if($saldo_temp<=$abono) $saldo_temp=0;
			if ($saldo_temp>$abono)	$saldo_temp=$saldo_temp-$abono;

		}

		if ($total) {
			$abono=$abono+$total;
			$total=0;


			echo "<tr ><td>".($c)."</td><td align=right> ".fechamysqltous(fechaplusweek($fecha),1)."</td><td align=right>".dinero($total)."</td><td class=\"right\">".dinero($abono)."</td><td align=right><font color=gray> ".dinero($ultimo)."&nbsp;</td></tr>";

		}







	echo " </tbody>
		</table> ";
echo "</div>";


}


function getticket($fid)
{
$database = new DB();

	if($fid)
	{
					$query = "SELECT cliente.cliente_id,apellidop, apellidom, nombre, credito, saldo,total_ultimo,fecha_total_ultimo, abono,factura_id,
							tipomov_id,fecha,saldo_actual,saldo_total,ticket  FROM cliente,factura 
						WHERE  factura.cliente_id=cliente.cliente_id AND factura.factura_id=".$fid;
					list( $cliente_id,$apellidop,$apellidom,$nombre,$credito, $saldo, $total_ultimo, $fecha_total_ultimo,$abono, $factura_id,
							 $tipomov_id,$fecha_factura,$saldo_actual,$saldo_total,$ticket  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;
	 }

				echo "<table   width=100%>
						<tr>
							<td style='text-align:center;border-bottom:1px dotted black' colspan=3>
								<br><strong>Tiendas Alberto</strong>
								<br>R.F.C QURC750708PM7
								<br>Av. Presa Lopez Zamora #1501 <br>Col. Venustiano Carranza<br>
								<br>";
								
				echo "Cliente: ". strtoupper($cliente)."<br>";
				if ($tipomov_id==3)
					echo "Tipo de Venta: <span class=\"label label-inverse\">Credito</span><br>";
				else
					echo "<br>"; //Tipo de Venta: <span class=\"label label-inverse\">Contado</span><br><br>";

				echo "Folio: $factura_id [$cliente_id]<br>";
				echo "Fecha y Hora: <br>".$fecha_factura;    //date("d-m-Y  H:m:s");
				echo "<br>";
				

				echo "</td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";

							 
				if ($tipomov_id==3)
							
				{
					$query = "SELECT  facturadet.producto_id,facturadet.factura_id,facturadet.producto,facturadet.precio_credito,facturadet.iva_credito,producto.codigo,color,talla FROM facturadet,producto
					WHERE  facturadet.producto_id=producto.producto_id AND facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
	
	
					foreach( $results as $item )
					{
		
						echo "<tr><td>&nbsp;</td><td>".$item['producto_id']." ".$item['codigo']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br><p class=\"muted\" >"
							.$item['color']." ".$item['talla']."</p></td> 
							<td style='text-align:right;vertical-align:text-top'>";
						if ($tipomov_id==3) echo dinero($item['precio_credito']); else echo dinero($item['precio_contado']);
					
						echo "</td></tr>";
										
						$total_credito+=$item['precio_credito'];
						$total_contado+=$item['precio_contado'];
										
						$n++;
					}
				}	


				if ($total_credito AND $cliente_id>0)
				{
					$total_iva_credito=$total_credito*.16;
					$disponible=$credito-$saldo-$total_credito-$total_iva_credito;

					//$saldo_total=$saldo+$total_credito+$total_iva_credito;



					echo "<tr style=\"border-top:1px dotted black\"><td>&nbsp;</td><td style='text-align:right'>SubTotal</td>
					      	  <td style='text-align:right;boarder-top:2px solid;'>$". dinero($total_credito)."</td></tr>";
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;IVA(16%)</td><td style='text-align:right;border-bottom:2px solid;'>+&nbsp;".dinero($total_iva_credito)."</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Total</strong></td><td style='text-align:right;'><strong>".dinero($total_iva_credito+$total_credito)."</strong></td></tr>";	
					echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>Saldo Actual</td><td style='text-align:right'>+  $ ".dinero($saldo_actual)."</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right;'><strong>Saldo Total</strong></td><td style='text-align:right;border-top:2px solid;'><strong>$ ".dinero($saldo_total)."</strong></td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>Abono</td>";

					$query = "SELECT abono,limite FROM abono ORDER BY limite ASC";
					$results = $database->get_results( $query );
					foreach ($results as $row ) 
					{
							//echo $total_credito." ".$row['limite']." <br> ";
						if ($saldo_total<=$row['limite'])
						{
							$abono=$row['abono'];
							break;
						}
					}

					echo "<td style='text-align:right;border-top:2px solid;'>$". dinero($abono)."</td>";
					echo "</tr>";
				} 
				else
					if ($cliente_id==0)
					{

						$query = "SELECT  facturadet.factura_id,facturadet.producto,facturadet.precio_contado,facturadet.iva_contado,producto.codigo,color,talla FROM facturadet,producto
					WHERE  facturadet.producto_id=producto.producto_id AND facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
	
	
					foreach( $results as $item )
					{
		
						echo "<tr><td>&nbsp;</td><td>".$item['factura_id']." ".$item['codigo']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br><p class=\"muted\" >"
							.$item['color']." ".$item['talla']."</p></td> 
							<td style='text-align:right;vertical-align:text-top'>";
							echo dinero($item['precio_contado']+$item['iva_contado']);
					
						echo "</td></tr>";
										
						$total_credito+=$item['precio_credito'];
						$total_contado+=$item['precio_contado'];
										
						$n++;
					}
					


						$total_iva_contado=$total_contado*.16;
						echo "<tr>
								<td></td><td>&nbsp;</td></tr>
				  			<tr>
				  				<td></td><td stsyle='text-align:right'>Subtotal</td>
							<td style='text-align:right'>$". dinero($total_contado+$total_iva_contado)."</td></tr>";
						echo "<tr><td></td><td style='text-align:right'>Incluye IVA(16%) por</td>
							<td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
						echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
							<td style='text-align:right;text-align:right;border-top:2px solid;'><strong>".dinero($total_iva_contado+$total_contado)."</strong></td></tr>";	
									

									
									}
					
				echo "</table>";



}

?>