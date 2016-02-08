<?php

$activo=isset($_GET['activo']) ? $_GET['activo'] : "";


echo "<ul>";
if (!$activo){
    echo "<a href=\"/functions/crud_cupones.php?func=p\"><button class=\"btn-primary\"><i class=\"halflings-icon inbox white \"></i>&nbsp;Generar csv</button></a>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href=\"/functions/crud_cupones.php?func=e\"><button class=\"btn-success\"><i class=\"halflings-icon inbox white \"></i>&nbsp;Activar Cupones</button></a>";
    echo "<a href=\"/functions/crud_cupones.php?func=d\"><button class=\"btn-danger\"><i class=\"halflings-icon inbox white \"></i>&nbsp;Cancelar Cupones</button></a>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"/index.php?data=cupones&op=generados&activo=1\"><button class=\"btn-success\"><i class=\"halflings-icon inbox white \"></i>&nbsp;Ver Activados</button></a>";
    }
    else{
    echo "<a href=\"/index.php?data=cupones&op=generados&activo=0\"><button class=\"btn-danger\"><i class=\"halflings-icon inbox white \"></i>&nbsp;Ver Sin Activar</button></a>";

    }

echo "</ul>"
?>
<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Clientes</h2>
						<div class="box-icon">
							<a href="index.php?data=clientes&op=cliente_form&f=agregar" classa="btn-setting"><i class="halflings-icon check"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered ">
						  <thead>
							  <tr>
                                  <th>Bulk</th>
                                  <th>Cupon</th>
                                  <th>sku</th>
								  <th>Fecha Inicio</th>
								  <th>Fecha Fin</th>
								  <th>Cantidad</th>
								  <th>Tipo</th>
								  <th>Usuario</th>
                                  <th>Activado</th>
							  </tr>
						  </thead>
						  <tbody>


<?php

$query = "SELECT cupon.cupon,cupones.sku,cupones.fecha_ini,cupones.fecha_fin,cupones.cantidad,cupontipo.cupontipo,admin.nombre,admin.apellidop,cupones.bulk
    FROM cupon,cupones,cupontipo,admin
    where cupones.cupon_id=cupon.cupon_id AND cupones.cupontipo_id=cupontipo.cupontipo_id AND cupones.admin_id=admin.admin_id AND cupones.activo=$activo ORDER BY cupones_id DESC";
$results = $database->get_results( $query );
foreach( $results as $row )
{

$nombre_admin=$row['apellidop'].' '.$row['nombre'];
?>
							<tr>
                                <td class="center"><?php echo $row['bulk']?></td>
								<td><a href=index.php?data=clientes&op=detalles&cid=<?php echo $row['cupon']?>><?php echo strtoupper($row['cupon'])?></a></td>
                                <td class="center"><?php echo $row['sku']?></td>
								<td class="center"><?php echo $row['fecha_ini']?></td>
								<td class="center"><?php echo $row['fecha_fin']?></td>

								<td class="center"><?php echo dinero($row['cantidad']) ?></td>


								<td class="center"><?php echo $row['cupontipo']?></td>
                                <td class="center"><?php echo $nombre_admin?></td>
                                <?php
                                 if ($activo)
                                 echo "<td><i class=\"icon-check\"></i></td>";
                                else echo "<td><i class=\"icon-check-empty\"></i></td>";
                                ?>
							</tr>

<?php
	}
?>


						  </tbody>
					  </table>
					</div>
				</div><!--/span-->

			<!--/div></row-->


