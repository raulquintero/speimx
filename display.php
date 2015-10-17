
<html>
<head>
	<meta http-equiv="refresh" content="1";
	<title></title>
	<style type="text/css">
	body{
		font-family: arial, helvetica;
		/*font-size: x-small; */
		background: #000000;
		color: #4EF84E;
	}

	</style>
</head>
<body>

<center><h2>Tiendas Alberto</h2></center>
		<!-- start: Content **************************************************************************************************************************                  -->
		<?php  

require_once('config/config.php');

$database = new DB();



 if (!$login->getUserActive())
 		header("location:/index.html");



foreach( $_POST as $key => $value )
{
    $_POST[$key] = $database->filter( $value );
}

foreach( $_GET as $key => $value )
{
    $_GET[$key] = $database->filter( $value );
}







			$cliente_id = $_SESSION['cliente_id'];


			if($cliente_id)
				{
					$query = "SELECT apellidop, apellidom, nombre, credito, saldo  FROM cliente 
						WHERE  cliente_id=".$cliente_id;
					list( $apellidop,$apellidom,$nombre,$credito, $saldo  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;




	 		

						
					echo "
		 			<strong>Cliente: ".strtoupper($cliente)."</a></strong>";
						
				} 
				 // else
				 // 		echo "<a href=\"/index.php?data=pos&op=clientes\" class=\"btn btn-success blue  hidden-print\">Seleccionar Cliente</a>";


		?>				
				


			<div class="row-fluid condensed">
		
			
		
				
				  		
						        
					
					</div>


					<div class="boxi span4" styles='border-left:1px dotted'>
						
<div class="hidden-desktop">
				

					<div class="hidden-phone">
							<table width=100% >
							<tr>
								<td style='text-align:center;border-bottom:1px dotted black' colspan=4>
								</td>
							</tr>
						</table>
					</div>
						
						<table width=100%>
									<?php
										if ($cliente_id)
											echo "<tr><td align=center style=\"border-bottom:1px dotted black\" colspan=4>Tipo de Venta: <span class=\"label label-inverse\">Credito</span><br></td></tr>";
										else
										echo "<tr><td align=center style=\"border-bottom:1px  black\" colspan=4><br></td></tr>"; //Tipo de Venta: <span class=\"label label-inverse\">Contado</span><br><br>";

									?>



							<?php 
								if (!$_SESSION['cart'])
									echo "<tr><td style='text-align:center'><br>
										<imge src=/img/empty_cart.jpeg><br><strong></strong><br><br><br></td></tr>";
								else
								{
									$item=$_SESSION['cart'];
								
									$n=0;
									$total=0;
									foreach ($item as $row => $value) 
									{
										echo "<tr><td> 1 @  ".$item[$n]['id_hide']."</td> <td>
											".$item[$n]['sku']."<br>". substr($item[$n]['producto'],0,23)."...</a> 
											<br>".strtolower($item[$n]['color'])." ".strtoupper($item[$n]['talla'])."</td> 
											<td style='text-align:right'>";
											if ($cliente_id) echo dinero($item[$n]['precio_credito']+($item[$n]['precio_credito']*.16)); else echo dinero($item[$n]['precio_contado']+($item[$n]['precio_contado']*.16));
											echo "</td><td><a href=\"/functions/cart.php?func=del_item&i=$n\" class=\"\">
											<i class=\"halflings-icon trash\"></i></i></a></td></tr>";
										
										$total_credito+=$item[$n]['precio_credito'];
										$total_contado+=$item[$n]['precio_contado'];
										
										$n++;

									}
								}
							?>

						<?php	
							if ($total_credito AND $cliente_id)
							{
								$total_iva_credito=$total_credito*.16;

								$disponible=$credito-$saldo-$total_credito-$total_iva_credito;

								$saldo_total=$saldo+$total_credito+$total_iva_credito;



								echo "<tr><td><br><a name=total>&nbsp;</a></td></td>";									
								// echo "<tr><td colspan=4 style=\"border-bottom:1px dotted black\">&nbsp;</td></tr><tr><td></td><td style='text-align:right'>Total</td><td style='text-align:right;boarder-top:2px solid;'>$". dinero($total_credito+$total_iva_credito)."</td></tr>";
								// echo "<tr><td></td><td style='text-align:right'>&nbsp;Incluye IVA(16%) por</td><td style='text-align:right;border-bottom:2px solid;'>".dinero($total_iva_credito)."</td></tr>";	
								echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td><td style='text-align:right;border-top:1px solid black;'><strong>".dinero($total_iva_credito+$total_credito)."</strong></td></tr>";	
								echo "<tr><td>&nbsp;</td></tr>";
								echo "<tr><td></td><td style='text-align:right'>Saldo Actual</td><td style='text-align:right'>+ &nbsp;&nbsp; $ ".dinero($saldo)."</td></tr>";	
								echo "<tr><td></td><td style='text-align:right;'>Saldo Total</td><td style='text-align:right;border-top:2px solid;'>$ ".dinero($saldo_total)."</td></tr>";	
								echo "<tr><td></td><td style='text-align:right'>Abono</td>";

									$query = "SELECT abono,limite FROM abono where activado=TRUE ORDER BY limite ASC";

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
									//echo "<tr><td colspan=3><br><br>Credito Actual Disponible: $ ".dinero($disponible)."</td></tr>";

							} else
								if ($total_contado)
									{
								$total_iva_contado=$total_contado*.16;
									echo "<tr><td><br></td></tr>";
									// echo "<tr><td>&nbsp;</td></tr><tr><td></td><td style='text-align:right'>Subtotal</td><td style='text-align:right'>$". dinero($total_contado+$total_iva_contado)."</td></tr>";
									// echo "<tr><td></td><td style='text-align:right'>Incluye IVA(16%) por</td><td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
									echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
											<td style='text-align:right;text-align:right;border-top:2px solid;'>
											<strong>".dinero($total_iva_contado+$total_contado)."</strong></td></tr>";	
									
									}
						?>
					</table>
				<div class="form-actions">
					<?php
								if ($_SESSION['cliente_id'])
								{ 
								$disponible=$credito-$saldo-($total_credito*1.16);
								
								if($disponible<0 AND $total_credito>0 AND $cliente_id)
									echo "<div  style='text-align:center;padding:10px;border:1px solid red;'>
										<strong>Credito Excedido!</strong> Quite uno o mas productos.
										</div>";
								}
											
						?>
						
	    		</div>
						
				



						<div class="clearfix">
						</div>
				</div>
<br><br><br><br><br><br><br><br>	
			</div><!--/row-->
		


</body>
</html>