<?php

if ($_GET['pnid'])
    {
       	$query = "SELECT  pedido_nombre_id,nombre,telefono,notas from pedido_nombre
             where pedido_nombre_id='".$_GET['pnid']."'";
        list( $pnid,$nombre,$telefono,$notas ) = $database->get_row( $query );
    }

$fecha = new DateTime(date("Y-m-d"));

if (date("G")<12)
    $fecha->add(new DateInterval('P1D'));
else
    $fecha->add(new DateInterval('P2D'));
$fecha_entrega =$fecha->format('Y-m-d');



$item=$_SESSION['cart'];
$items = count($item);
$n=$items-1;
$total=0;
foreach ($item as $row => $value)
									{


										$total_contado+=$item[$n]['precio_venta'];

										$n--;




?>

	<div class="box span8">
                    <div class="box-header orange">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>PEDIDOS</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div><!--/span-->

                    <div class="box-content">

                                <p style="text-align:center">Fecha de Entrega: <?php echo fechamysqltous($fecha_entrega) ?></p>
                        <form class="form-horizontal" action="/functions/cerrarpedido.php">
	    			    <fieldset>


                                <input type="hidden" name="fecha_entrega" value="<?php echo $fecha_entrega?>">
								<input type="hidden" name="pnid" value="<?php echo $pnid?>">

    <script type="text/javascript">
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","/functions/getpedido_cliente.php?q="+str,true);
xmlhttp.send();
}
</script>

<script type="text/javascript">
function pulsar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return (tecla != 13);
}
</script>


                    <div class="control-group">
							  <label class="control-label" for="telefono"><b>Telefono</b></label>
							  <div class="controls">
								<input type="text" onkeypress="return pulsar(event)"
                                <?php
								  if ($_GET['f']<>"editar") echo " onkeyup='showUser(this.value)' ";
								  ?>
                                class="input-small" id="telefono" name="telefono" value="<?php echo $telefono?>" autocomplete="off">

                              <div id='txtHint'><ul><b> </b></ul></div>
                              </div>
					</div>

                    <div class="control-group">
							  <label class="control-label" for="nombre"><b>Nombre del Cliente</b></label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="nombre" name="nombre" value="<?php echo $nombre?>">
							  </div>
					</div>

                    <div class="control-group">
							  <label class="control-label" for="anticipo"><b>Anticipo Minimo</b></label>
							  <div class="controls">
								$ <input type="text" class="input-small " id="anticipo" name="anticipo" value="<?php echo dinero($total_contado/2)?>">
							  </div>
					</div>

                    <div class="control-group">
							  <label class="control-label" for="notas"><b>Notas</b></label>
							  <div class="controls">
								 <input type="text" class="input-xlarge" id="notas" name="notas" value="<?php echo $notas?>">
							  </div>
					</div>

					 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Grabar Pedido</button>
							  </div>
						</fieldset>
		        	</form>

                    </div>
                        <br>

	<div class="box span11">
                    <div class="box-header orange">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>PEDIDOS PENDIENTES</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div><!--/span-->

            <?php
            if($_GET['pnid'])
            {
            $query = "SELECT  nombre,pedido.pedido_id,total,anticipo,status,fecha_orden,fecha_entrega FROM pedido,pedido_nombre,status
					WHERE  pedido.pedido_nombre_id=pedido_nombre.pedido_nombre_id AND
                    pedido.status_id=status.status_id AND pedido.pedido_nombre_id=".$pnid." ORDER BY status.status_id,pedido.pedido_id DESC";
					$results = $database->get_results( $query );
            echo "<table class='table' width=400>";
            echo "<thead>
                    <tr><th></th><th>No.</th><th>Nombre</th><th>Fecha Orden</th><th>Feche Entrega</th><th>Status</th><th>Total</th><th>Anticipo</th><th>Saldo</th>
                  </thead>  ";
            echo "<tbody>";
                    foreach( $results as $item )
					{

						echo "<tr><td>&nbsp;</td><td>".$item['pedido_id']."</td><td> ".$item['nombre']."</td>
							<td> ".$item['fecha_orden']."</td><td> ".$item['fecha_entrega']."</td>
                            <td> ".$item['status']."</td><td>". substr($item['total'],0,26)."</td><td>".dinero($item['anticipo'])."
							<td style='text-align:right;vertical-align:text-top'>";
						echo dinero($item['total']-$item['anticipo']);

						echo "&nbsp;&nbsp;</td></tr>";

						$grantotal+=$item['total'];

						$n++;
					}
            echo "</tbody>";
            echo "</table>";


            }


            ?>

                    <div class="box-content">

                    </div>
    </div>


    </div>

			<div class="box span4 hidden-print">
                    <div class="box-header orange">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Articulos</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div><!--/span-->

                    <div class="box-content">
						<table class="table table-condensed">

							  <tbody>

                                    <?php

                                    	//$fecha_inicio=fechaustomysql($fecha_inicio);
                                    	//$fecha_final =fechaustomysql($fecha_final);
                                   // mostrar_transacciones($fecha_inicio,$fecha_final,$user);?>



                    <?php



												}
                                  	//if ($total_contado)
									{
								$total_iva_contado=$total_contado*.16;
									// echo "<tr><td>&nbsp;</td></tr><tr><td></td><td style='text-align:right'>Subtotal</td><td style='text-align:right'>$". dinero($total_contado+$total_iva_contado)."</td></tr>";
									// echo "<tr><td></td><td style='text-align:right'>Incluye IVA(16%) por</td><td style='text-align:right'>$". dinero($total_iva_contado)."</td></tr>";
									echo "<tr><td></td><td style='text-align:right'>&nbsp;<font size=+1>Total</font></td>
											<td width=180 style='text-align:right;text-align:right;background:yellow;color:black;'>
											<font size=+3><b>$ ".dinero($total_contado)."</b></font></td></tr>";

										$fecha_hoy=date("Y-m-d");
										$query = "SELECT  promocion_id,promocion,tipodesc from promocion where \"$fecha_hoy\">=fecha_inicio AND \"$fecha_hoy\"<=fecha_fin";
										list( $promocion_id,$promocion,$tipodesc ) = $database->get_row( $query );
												$promociones= $database->num_rows( $query );

									if ($promociones)
									{

										switch ($tipodesc) {
											case '1':
												$promo=get_promo($total_contado);
												break;
											case '2':
												$promo=get_promo_porcentaje($total_contado);
												break;

											default:
												# code...
												break;
										}

										echo "<tr><td></td><td style='text-align:right'>&nbsp;<font size=+1>$promocion</font></td>
											<td width=180 style='text-align:right;text-align:right;color:black;border-bottom:1px solid black;'>
											<font size=+3><b>- ".dinero($promo)."</b></font></td></tr>";

										echo "<tr><td></td><td style='text-align:right'>&nbsp;<font size=+1>Ud. Paga</font></td>
											<td width=180 style='text-align:right;text-align:right;color:black;border:1px solid black;'>
											<font size=+3><b> $ ".dinero($total_contado-$promo)."</b></font></td></tr>";
									}



									}

                            echo "</table>";
							echo "<table width=100%>";
							echo "<tr><td>&nbsp;</td></tr>";
									$item=$_SESSION['cart'];
                                        $items = count($item);
									$n=$items-1;
									//$total=0;
									foreach ($item as $row => $value)
									{
										echo "<tr><td style='border-top:1px dotted gray;'> ".($n+1)."</td> <td style='border-top:1px dotted gray;'>
											".$item[$n]['sku']."<br>". substr($item[$n]['producto'],0,30)."...
											<br><i><font size=-1>".strtolower($item[$n]['color'])." ".strtoupper($item[$n]['talla'])."</font></i></td>
											<td valign=top style='text-align:right;border-top:1px dotted gray;'>";
											if ($cliente_id) echo dinero($item[$n]['precio_credito']+($item[$n]['precio_credito']*.16));
                                             else
                                                if($item[$n]['descuento']>0) {
                                                 echo "(-".$item[$n]['descuento']."%)&nbsp; <s>".dinero($item[$n]['precio_contado']*1.16)."</s><br>";
                                                 echo dinero($item[$n]['precio_venta']);
                                                 }
                                                 else
                                                       echo dinero($item[$n]['precio_contado']*1.16);
											echo "</td><td class='hidden-print'><a href=\"/functions/cart.php?func=del_item&i=$n\" class=\"\">
											<i class=\"halflings-icon trash\"></i></i></a></td></tr>";
										//<a href=\"/index.php?data=pos&op=detalles&prid=".$item[$n]['id']."\"></a>
										//$total_credito+=$item[$n]['precio_credito'];
										//$total_contado+=$item[$n]['precio_contado'];

										$n--;

									}
                                echo "</table>";

                    ?>












            			  	<?php  //getticket(139);?>



  				</tbody>
						 </table>

					</div>
			</div><!--/row-->
		</div>
		</div>