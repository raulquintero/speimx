		<!-- start: Content **************************************************************************************************************************                  -->
		<?php 
			$cliente_id = $_SESSION['cliente_id'];


			if($cliente_id)
				{
					$query = "SELECT apellidop, apellidom, nombre, credito, saldo  FROM cliente 
						WHERE  cliente_id=".$cliente_id;
					list( $apellidop,$apellidom,$nombre,$credito, $saldo  ) = $database->get_row( $query );
	 					$cliente= $apellidop." ".$apellidom." ".$nombre;




	 		

						
					echo "<div class=\"alert alert-info \">
		 			<a href=/functions/cart.php?func=del_cliente&cid=".$row['cliente_id']."><button type=\"button\" class=\"close\" >×</button></a>
					<strong>Cliente: <a href=\"/index.php?data=clientes&op=detalles&h=1&cid=$cliente_id\" >".$cliente."</a></strong> <br><strong>Saldo: </strong>$ ". dinero($saldo)." 
					<strong>Credito: </strong>$ ".dinero($credito)."<br><strong> Credito Total Disponible: </strong>$ ".dinero($credito-$saldo)."</div> ";
						
				} 
				 // else
				 // 		echo "<a href=\"/index.php?data=pos&op=clientes\" class=\"btn btn-success blue  hidden-print\">Seleccionar Cliente</a>";


		?>				
				


			<div class="row-fluid condensed">
		
					<div class="box-content span8 hidden-phone hidden-tablet" >

					<div class="hidden-print ">
					<form action="/index.php" method="get">
							<table  width=100%  >
				 			<tr bgcolor=#dddddd>
				  			<td style="padding:10px">

							<input type=hidden name=data value=pos>
							<input type=hidden name=op value=detalles>
							<input type=hidden name=type value=item>
				  			 &nbsp;&nbsp;Codigo: <input class="input-large" id="textcode" name="code" >
				  			</td>
				  		</tr>
				  		</table>
				  		</form>
				  	</div>
			
		
				
				  		<div class="box-header " data-original-title>
					  		<h2><i class="halflings-icon calendar"></i><span class="break"></span>Punto de Venta</h2>
				  		</div>
						        
					
					</div>


					<div class="boxi span4" styles='border-left:1px dotted'>
						
<div class="hidden-desktop">
					<form action="/index.php" method="get">
							<table  width=100%  >
				 			<tr bgcolor=#dddddd>
				  			<td style="padding:10px">

							<input type=hidden name=data value=pos>
							<input type=hidden name=op value=detalles>
							<input type=hidden name=type value=item>
				  			 &nbsp;&nbsp;Codigo <input classe="input-xlarge focused" id="textcode" name="code" >
				  			</td>
				  		</tr>
				  		</table>
				  		</form>
				  	</div>

					<div class="hidden-phone">
							<table width=100% >
							<tr>
								<td style='text-align:center;border-bottom:1px dotted black' colspan=4>
									<br>Tiendas Alberto
									<br>R.F.C QURC750708PM7
									<br>Av. Presa Lopez Zamora #1501 <br>Col. Venustiano Carranza<br>
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
										<img src=/img/empty_cart.jpeg><br><strong>Carrito Vacio</strong><br><br><br></td></tr>";
								else
								{
									$item=$_SESSION['cart'];
								
									$n=0;
									$total=0;
									foreach ($item as $row => $value) 
									{
										echo "<tr><td> 1 @  ".$item[$n]['id_hide']."</td> <td>
											<a href=\"/index.php?data=pos&op=detalles&prid=".$item[$n]['id']."\">".$item[$n]['sku']."<br>". substr($item[$n]['producto'],0,23)."...</a> 
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



								echo "<tr><td><br></td></td>";									
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
									echo "<tr><td colspan=3><br><br>Credito Actual Disponible: $ ".dinero($disponible)."</td></tr>";

							} else
								if ($total_contado)
									{
								$total_iva_contado=$total_contado*.16;
									echo "<tr><td><br></td></tr>";
									// echo "<tr><td>&nbsp;</td></tr><tr><td></td><td style='text-align:right'>Subtotal</td><td style='text-align:right'>$". dinero($total_contado+$total_iva_contado)."</td></tr>";
									// echo "<tr><td></td><td style='text-align:right'>Incluye IVA(16%) por</td><td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
									echo "<tr><td></td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
											<td style='text-align:right;text-align:right;border-top:2px solid;'><strong>".dinero($total_iva_contado+$total_contado)."</strong></td></tr>";	
									
									}
						?>
					</table>
				<div class="form-actions">
						<?php
								if ($_SESSION['cliente_id'])
								{ 
								$disponible=$credito-$saldo-($total_credito*1.16);
								if($disponible>=0 AND $total_credito>0 AND $cliente_id)
									echo "<a href=\"#\" class=\"btn btn-info blue btn-setting\">Cerrar Venta a Credito</a>
									 <!-- <button class=\"btn\">Cancelar</button> -->";
								if($disponible<0 AND $total_credito>0 AND $cliente_id)
									echo "<div class=\"alert alert-error\">
										<strong>Credito Excedido!</strong> Quite uno o mas productos.
										</div>";
								}
							else{
						
									if ($total_contado)
						echo "<a href=\"#\" class=\"btn btn-info blue btn-setting\">Cerrar Venta</a>";
								}					
						?>
	    		</div>
						
				



						<div class="clearfix">
						</div>
				</div>
<br><br><br><br><br><br><br><br>	
			</div><!--/row-->
		

	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Cerrar Venta</h3>
		</div>
		<div class="modal-body">

		<?php	
			if ($_SESSION['cliente_id'])
			{
				echo "<p> Tipo de Venta: <span class=\"label label-inverse\">Credito</span><br><br>
					Cliente: <strong>$cliente</strong></p><br>
					<table width=100%>";
					//echo "<tr><td style='text-align:right'>SubTotal:</td><td width=100 style='text-align:right'> $". dinero($total_credito+$total_iva_credito)."</td></tr>";
								// echo "<tr><td style='text-align:right'>&nbsp;Incluye IVA(16%) por</td><td style='text-align:right;border-bottom:2px solid;'>".dinero($total_iva_credito)."</td></tr>";	
								echo "<tr><td style='text-align:right'>&nbsp;<strong>Total</strong></td><td width=120 style='text-align:right;'><strong>$ ".dinero($total_iva_credito+$total_credito)."</strong></td></tr>";	
								echo "<tr><td>&nbsp;</td></tr>";
								echo "<tr><td style='text-align:right'>Saldo Actual</td><td style='text-align:right'>+ $ ".dinero($saldo)."</td></tr>";	
					echo "<tr><td style='text-align:right'>Saldo Nuevo:</td><td style='text-align:right;border-top:2px solid black;'> $ ". dinero($saldo_total)."</td></tr>";
								//echo "<tr><td style='text-align:right'>Saldo Actual</td><td style='text-align:right'>+ &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;$ ".dinero($saldo)."</td></tr>";	
								//echo "<tr><td style='text-align:right;'>Saldo Total</td><td style='text-align:right;border-top:2px solid;'>$ ".dinero($saldo_total)."</td></tr>";	
					echo "<tr><td style='text-align:right'>Abono:</td><td style='text-align:right'> $ ". dinero($abono)."</td></tr>
					</table>";
			}
			else
			{

				echo "<p> Tipo de Venta: <span class=\"label label-inverse\">Contado</span></p><br>
					<table  width=100%>";

					$total_iva_contado=$total_contado*.16;
									echo "<tr><td>&nbsp;</td></tr>";
									// echo "<tr><td>&nbsp;</td><td style='text-align:right'>Total</td><td style='text-align:right'>$". dinero($total_contado+$total_iva_contado)."</td></tr>";
									// echo "<tr><td>&nbsp;</td><td style='text-align:right'>Incluye IVA(16%) por</td><td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
									echo "<tr><td>&nbsp;</td><td style='text-align:right'>&nbsp;<strong>Total</strong></td>
											<td width=190 style='text-align:right;text-align:right;border-top:0px solid;'><h1> $ ".dinero($total_iva_contado+$total_contado)."</h1></td></tr>";	
									
									echo"</table>";

			}

		?>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<a href="/functions/cerrarventa.php" class="btn btn-primary">Continuar</a>
		</div>
	</div>
