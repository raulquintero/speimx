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

function fechaplus_onesecond($fecha)

{

	$time = strtotime($fecha);
	$final = date("Y-m-d H:i:s", strtotime("+1 second", $time));
return $final;

}

function plandepagos($total,$fecha,$abono,$saldo)
{
			//$fecha=fechaplusweek($fecha);

	$total_pagos=ceil($total/$abono);


	echo "
					<div class=\"box-header\">
						<h2></span>Plan de Pagos</h2>
						<div class=\"box-icon\">
							<a href=\"#\" class=\"btn-setting\"><i class=\"halflings-icon wrench\"></i></a>
							<a href=\"#\" class=\"btn-minimize\"><i class=\"halflings-icon chevron-up\"></i></a>
							<a href=\"#\" class=\"btn-close\"><i class=\"halflings-icon remove\"></i></a>
						</div>
					</div>
					<div>
						<table class=\"table table-condensed striped\" width=100%>
							  <thead>
								  <tr>
									  <th style='text-align:right'>Num</th>
									  <th style='text-align:center'>Vence</th>
									  <th style='text-align:right'>Abono</th>
									  <th style='text-align:right'>Saldo</th>
									  <th></th>                                          
								  </tr>
							  </thead>   
							  <tbody>";
echo "<tr ><td style='text-align:right'>".($c)."</td>
			<td  style='text-align:center'> ".fechamysqltous($fecha,1)."</td>
			<td style='text-align:right'>----</td>
			<td  style='text-align:right'>".dinero($total)."</td>
			<td  style='text-align:right'><font color=gray> &nbsp;</td></tr>";


	$c=1;
	$pagos_atrazados=0;
	//$total-=$abono;
	$saldo_temp=$total-$saldo;
		for ($i=1; $i < $total_pagos; $i++) {
			$fecha=fechaplusweek($fecha);
			if ($saldo_temp>$abono) $ultimo=$abono;
				else {
					$ultimo=$saldo_temp;
					
				}
			if($total>=($saldo+$abono)){
				$atributo_begin="<s>";$atributo_end="</s>";
			}
				else {
					$atributo_begin=$atributo_end="";
			if ($ultimo<$saldo && $fecha<date("Y-m-d")) {
			$atributo_begin="<font color=red><b><i>";$atributo_end="</i></b></font>";
			$pagos_atrazados+=1;
			}
				else 
					$atributo_begin=$atributo_end="";
				}
			
			echo "<tr><td  style='text-align:right'>".($c)."</td>
			<td style='text-align:center'>$atributo_begin".fechamysqltous($fecha,1)."$atributo_end</td>
			<td  style='text-align:right'> $atributo_begin".dinero($abono)."$atributo_end </td>
			<td  style='text-align:right'>".dinero($total-$abono)."</td>
			<td  style='text-align:right'><font color=gray>$atributo_begin".dinero($ultimo)."$atributo_end</font>&nbsp;</td></tr>";
			$total=$total-$abono;
			$c++;
			if($saldo_temp<=$abono) $saldo_temp=0;
			if ($saldo_temp>$abono)	$saldo_temp=$saldo_temp-$abono;

		}

		if ($total) {
			$abono=$total;
			$total=0;


			echo "<tr ><td style='text-align:right'>".($c)."</td>
			<td  style='text-align:center'> ".fechamysqltous(fechaplusweek($fecha),1)."</td>
			<td style='text-align:right'>".dinero($abono)."</td>
			<td  style='text-align:right'>".dinero($total)."</td>
			<td  style='text-align:right'><font color=gray> ".dinero($ultimo)."&nbsp;</td></tr>";

		}







	echo " </tbody>
		</table> ";
		//echo "Pagos Atrazados: ".$pagos_atrazados;
echo "</div>";


}


function getticket($fid)
{
$database = new DB();

	if($fid)
	{
					$query = "SELECT cliente.cliente_id,apellidop, apellidom, nombre, credito, saldo,total_ultimo,fecha_total_ultimo, abono,factura_id,
							tipomov_id,fecha,saldo_actual,saldo_total,ticket,efectivo  FROM cliente,factura 
						WHERE  factura.cliente_id=cliente.cliente_id AND factura.factura_id=".$fid;
					list( $cliente_id,$apellidop,$apellidom,$nombre,$credito, $saldo, $total_ultimo, $fecha_total_ultimo,$abono, $factura_id,
							 $tipomov_id,$fecha_factura,$saldo_actual,$saldo_total,$ticket,$efectivo  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;
	 }

				echo "<table  width=100% >
						<tr>
							<td style='text-align:center;border-bottom:1px dotted black;' colspan=3>
								<a href=\"/index.php\"><img width=300 src=/img/tiendasalberto.png></a>
								<br>R.F.C QUCR750708PM7
								<center>NOTA DE VENTA</center>";
								
				echo "<font size=-1>";
								
				echo "Cliente: ". strtoupper($cliente)."<br>";
				if ($tipomov_id==3)
					echo "Tipo de Venta: <span class=\"label label-inverse\">Credito</span><br>";
				else
					echo "<br>"; //Tipo de Venta: <span class=\"label label-inverse\">Contado</span><br><br>";
							$no_ticket=sprintf('%06d', $factura_id);

				echo "No.: $no_ticket [$cliente_id.345]<br>";
				echo "Fecha y Hora: <br>".$fecha_factura;    //date("d-m-Y  H:m:s");
				echo "<br>";
				

				echo "</font></td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";

							 
				if ($tipomov_id==3)
							
				{
					$query = "SELECT  facturadet_id,facturadet.producto_id,facturadet.factura_id,facturadet.producto,facturadet.precio_credito,facturadet.iva_credito,producto.codigo,color,talla,facturadet.sku FROM facturadet,producto
					WHERE  facturadet.producto_id=producto.producto_id AND facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
	
	
					foreach( $results as $item )
					{
		
						echo "<tr><td>&nbsp;</td><td>".$itemaaaaa['facturadet_id']." ".$item['sku']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br>".$item['color']." ".$item['talla']."</td> 
							<td style='text-align:right;vertical-align:text-top'>";
						if ($tipomov_id==3) echo dinero($item['precio_credito']*1.16); else echo dinero($item['precio_contado']*1.16);
					
						echo "&nbsp;&nbsp;</td></tr>";
										
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


					echo "<tr><td>&nbsp;</td></tr>";
					echo "<tr style=\"border-top:1px dotted black\"><td style=\"border-top:1px dotted black\">&nbsp;</td><td style='text-align:right;border-top:1px dotted black'>Total</td>
					      	  <td style='text-align:right;border-top:1px dotted;'>$". dinero($total_credito*1.16)."&nbsp;&nbsp;</td></tr>";
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;Incluye IVA(16%) por</td><td style='text-align:right;border-bottom:2px solid;'>+&nbsp;".dinero($total_iva_credito)."&nbsp;&nbsp;</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Total</strong></td><td style='text-align:right;'><strong>".dinero($total_iva_credito+$total_credito)."</strong>&nbsp;&nbsp;</td></tr>";	
					echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
					echo "<tr><td>&nbsp;</td><td style='text-align:right'>Saldo Actual</td><td style='text-align:right'>+  $ ".dinero($saldo_actual)."&nbsp;&nbsp;</td></tr>";	
					echo "<tr><td>&nbsp;</td><td style='text-align:right;'><strong>Saldo Total</strong></td><td style='text-align:right;border-top:2px solid;'><strong>$ ".dinero($saldo_total)."</strong>&nbsp;&nbsp;</td></tr>";	
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

					echo "<td style='text-align:right;border-top:2px solid;'>$". dinero($abono)."&nbsp;&nbsp;</td>";
					echo "</tr>";
				} 
				else
					if ($cliente_id==0)
					{

						$query = "SELECT  facturadet_id,facturadet.factura_id,facturadet.producto,facturadet.precio_contado,facturadet.iva_contado,producto.codigo,color,talla,sku FROM facturadet,producto
					WHERE  facturadet.producto_id=producto.producto_id AND facturadet.factura_id=".$fid;

					$results = $database->get_results( $query );
								
					$n=0;
					$total=0;
	
	
					foreach( $results as $item )
					{
		
						echo "<tr><td>&nbsp;</td><td>".$itemaaaaaa['facturadet_id']." ".$item['sku']."<br>
							". substr($item['producto'],0,26)."...</a>
							<br>".$item['color']." ".$item['talla']."</td> 
							<td style='text-align:right;vertical-align:text-top'>";
							echo dinero($item['precio_contado']+$item['iva_contado']);
					
						echo "&nbsp;&nbsp;</td></tr>";
										
						$total_credito+=$item['precio_credito'];
						$total_contado+=$item['precio_contado'];
										
						$n++;
					}
					


						$total_iva_contado=$total_contado*.16;
						//echo "<tr><td></td><td>&nbsp;</td></tr>";"
						echo "<tr><td>&nbsp;</td></tr>";
					echo "<tr style=\"border-top:1px dotted black\"><td style=\"border-top:1px dotted black\">&nbsp;</td><td style='text-align:right;border-top:1px dotted black'>Total</td>
					      	  <td style='text-align:right;border-top:1px dotted;'>$". dinero($total_contado*1.16)."&nbsp;&nbsp;</td></tr>";
				  			// echo "<tr style=\"border-top:1px dotted black\"><td></td><td style='text-align:right'>Total</td><td style='text-align:right'>$". dinero($total_contado+$total_iva_contado)."</td></tr>";
						echo "<tr><td></td><td style='text-align:right'>Incluye IVA(16%) por</td>
							<td style='text-align:right'>$". dinero($total_iva_contado)."&nbsp;&nbsp;</td></tr>";
						echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
							<td style='text-align:right;text-align:right;border-top:2px solid;'><strong>".dinero($total_iva_contado+$total_contado)."</strong>&nbsp;&nbsp;</td></tr>";	
						


							$fecha_hoy=date("Y-m-d");
										$query = "SELECT  promocion_id from promocion where \"$fecha_hoy\">=fecha_inicio AND \"$fecha_hoy\"<=fecha_fin";
										$promociones= $database->num_rows( $query );

									if ($promociones)
									{
										$promo=get_promo($total_contado+$total_iva_contado);

										echo "<tr><td></td><td style='text-align:right'>&nbsp;<font size=+1>Promo BUEN FIN</font></td>
											<td style='text-align:right;text-align:right;color:black;border-bottom:1px solid black;'>
											<b>- ".dinero($promo)."</b>&nbsp;&nbsp;</td></tr>";
									
										echo "<tr><td></td><td style='text-align:right'>&nbsp;<font size=+1>Ud. Pag&oacute;</font></td>
											<td style='text-align:right;text-align:right;color:black;border:1px solid black;'>
											<b> $ ".dinero($total_contado+$total_iva_contado-$promo)."</b>&nbsp;&nbsp;</td></tr>";
									}
										


						if ($efectivo){
						echo "<tr><td></td><td style='text-align:right'>&nbsp;Efectivo</td>
							<td style='text-align:right;text-align:right;'>".dinero($efectivo)."&nbsp;&nbsp;</td></tr>";	
						echo "<tr><td></td><td style='text-align:right'>&nbsp;Cambio</td>
							<td style='text-align:right;text-align:right;border-top:2px solid;'>".dinero($efectivo-$total_iva_contado-$total_contado)."&nbsp;&nbsp;</td></tr>";	
						}			

									
									}


						if ($promociones)
						{
						echo "<tr><td colspan=3><br><br>RECUERDE:  En Promocion por BUEN FIN no hay cambios ni devoluciones</td></tr>";	
						
						}
					
				echo "</table>";







}





function getabono($mid)
{
$database = new DB();

	if($mid)
	{
					$query = "SELECT cliente.cliente_id,apellidop, apellidom, nombre, credito, saldo,total_ultimo,fecha_total_ultimo, abono,
							tipomov_id,fecha,saldo,cantidad,saldo_abono  FROM cliente,movimiento 
						WHERE  movimiento.cliente_id=cliente.cliente_id AND movimiento.movimiento_id=".$mid;
					list( $cliente_id,$apellidop,$apellidom,$nombre,$credito, $saldo, $total_ultimo, $fecha_total_ultimo,$abono, 
							 $tipomov_id,$fecha,$saldo,$cantidad,$saldo_abono  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;
	 }

				echo "<table  width=100% >
						<tr>
							<td style='text-align:center;border-bottom:1px dotted black' colspan=3>
								<a href=\"/index.php\"><img width=350 src=/img/tiendasalberto.png></a>
								<br>R.F.C QUCR750708PM7";
								
				echo "Cliente: ". strtoupper($cliente)."<br>";

				echo "Abono a Cuenta: [$cliente_id]<br>";
				echo "Fecha y Hora: <br>".$fecha;    //date("d-m-Y  H:m:s");
				echo "<br>";
				

				echo "</td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";

				echo "<tr><td>Saldo Anterior</td><td style=\"text-align:right\">$ ". dinero($saldo_abono+$cantidad)."</td><td>&nbsp;</td></tr>";				
				echo "<tr><td>Cantidad a Abonada</td><td style=\"text-align:right\">$ ". dinero($cantidad)."</td></tr>";				
				echo "<tr><td>Saldo Actual</td><td style=\"text-align:right;border-top:1px solid black;\">$ ". dinero($saldo_abono)."</td></tr>";				
 
				echo "<tr><td style=\"border-bottom:1px dotted black\" colspan=3>&nbsp;&nbsp;</td></tr>";	
				echo "</table>";







}



function get_promo($total_contado)
{
$database = new DB();

	

	 $query = "SELECT limite,descuento FROM promocion,promociondet WHERE promocion.promocion_id=promociondet.promocion_id AND activado=1 ORDER BY descuento DESC";

									$results = $database->get_results( $query );
									foreach ($results as $row ) 
									{
											//echo round($total_contado)." - ".$row['limite']." <br> ";
										if (ceil($total_contado)>$row['limite'])
											{
												$descuento=$row['descuento'];
												break;
											}
									}
	return $descuento;
}




?>