<?php

$activo=isset($_GET['activo']) ? $_GET['activo'] : "";
$bulk=isset($_GET['bulk']) ? $_GET['bulk'] : "";


echo "<ul>";
if (!$activo){
    echo "<a href=\"/functions/crud_cupones.php?func=csv&bulk=$bulk\"><button class=\"btn-primary\"><i class=\"halflings-icon inbox white \"></i>&nbsp;Generar csv</button></a>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href=\"/functions/crud_cupones.php?func=e\"><button class=\"btn-success\"><i class=\"halflings-icon inbox white \"></i>&nbsp;Activar Cupones</button></a>";
    echo "<a href=\"/functions/crud_cupones.php?func=d\"><button class=\"btn-danger\"><i class=\"halflings-icon inbox white \"></i>&nbsp;Cancelar Cupones</button></a>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"/index.php?data=cupones&op=generados&activo=1\"><button class=\"btn-success\"><i class=\"halflings-icon inbox white \"></i>&nbsp;Ver Activados</button></a>";
    }
    else{
    echo "<a href=\"/index.php?data=cupones&op=generados&activo=0\"><button class=\"btn-danger\"><i class=\"halflings-icon inbox white \"></i>&nbsp;Ver Sin Activar</button></a>";

    }
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"/imprimir_cupones_back.php\"><button class=\"btn-primary\"><i class=\"halflings-icon print white \"></i>&nbsp;Imprimir Reverso</button></a>";
echo "</ul>"
?>
<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Cupones</h2>
						<div class="box-icon">
							<a href="index.php?data=clientes&op=cliente_form&f=agregar" classa="btn-setting"><i class="halflings-icon check"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">


            <div class="box span6 hidden-print">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Esquema</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div>
					<div class="box-content">


                     <table class="table table-striped table-bordered ">
						  <thead>
							  <tr>
                                  <th>B</th>
                                  <th>Cupon</th>
                                  <th>Usuario</th>
                                  <th>Cant.</th>
                                  <th>Used</th>
							  </tr>
						  </thead>
						  <tbody>
<?php
$query = "SELECT sku,fecha_ini,fecha_fin,cantidad,cupontipo.cupontipo_id,cupontipo,compra_minima,admin.nombre,admin.apellidop,bulk
    FROM cupones,cupontipo,admin
    where cupones.cupontipo_id=cupontipo.cupontipo_id AND cupones.admin_id=admin.admin_id AND cupones.activo=$activo GROUP BY bulk DESC";
$results = $database->get_results( $query );

foreach( $results as $row )
{
    $nombre_admin=$row['apellidop'].' '.$row['nombre'];
    $query="SELECT count(cupones_id) from cupones where bulk=".$row['bulk'];
    list($cuantos)=$database->get_row($query);
    $query="SELECT count(usado) from cupones where usado='1' AND bulk=".$row['bulk'];
    list($usados)=$database->get_row($query);
?>
							<tr>
                                <td class="center"><?php echo $row['bulk']?></td>
								<td><a href=index.php?data=cupones&op=generados&activo=<?php echo $activo?>&bulk=<?php echo $row['bulk']?>><b>
                                <?php
                                    switch($row['cupontipo_id']){
                                        case 1: echo "$ ".dinero($row['cantidad'])." MX";break;
                                        case 2: echo $row['cantidad']." %";
                                        }
                                        ?></b></a>&nbsp;&nbsp;
                                        <a href="imprimir_cupones.php?bulk=<?php echo $row['bulk']?>"><i class="halflings-icon print "></i></a>
                                        <br><?php echo "CM: $ ".dinero($row['compra_minima'])." MX"?></td>
                                <td class="center"><?php echo $nombre_admin?></td>
                  <td class="center"><?php echo $cuantos?></td>
							    <td class="center"><?php echo $usados?></td>
							</tr>

<?php

}

?>
            </tbody>
					  </table>
                    </div>

                    </div>






                    <div class="box span6">
                     <div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Cupones </h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>

                      <table class="table table-striped table-bordered ">
						  <thead>
							  <tr>
                                  <th>Bulk</th>

                                  <th>sku</th>
								  <th>Vigencia</th>
								  <th>Cantidad</th>


                                  <th>Act</th>
                                  <th>Used</th>
							  </tr>
						  </thead>
						  <tbody>

                          <?php

$query = "SELECT cupones.sku,cupones.fecha_ini,cupones.fecha_fin,cupones.cantidad,cupontipo.cupontipo_id,usado,compra_minima,admin.nombre,admin.apellidop,cupones.bulk
    FROM cupones,cupontipo,admin
    where cupones.cupontipo_id=cupontipo.cupontipo_id AND cupones.admin_id=admin.admin_id AND cupones.activo=$activo ";
    if ($bulk) $query.=" AND bulk=$bulk ";
    $query .=" ORDER BY cupones_id DESC";
$results = $database->get_results( $query );
foreach( $results as $row )
{

$nombre_admin=$row['apellidop'].' '.$row['nombre'];
?>
							<tr>
                                <td class="center"><?php echo $row['bulk']?></td>
								<!--td><a href=index.php?data=clientes&op=detalles&cid=<?php echo $row['cupon']?>><?php echo strtoupper($row['cupon'])?></a></td-->
                                <td class="center"><?php echo $row['sku']?></td>
								<td class="center"><?php echo fechamysqltomx($row['fecha_ini'],"letra")?><br><?php echo fechamysqltomx($row['fecha_fin'],"letra")?></td>



                                <?php
                                 if ($row['cupontipo_id']==1)
								    echo "<td class=\"center\">$ ".dinero($row['cantidad'])." MX";

                                else
								    echo "<td class=\"center\"> ".dinero($row['cantidad'])." %";

                                echo "<br>CM: $ ".dinero($row['compra_minima'])." </td>";

                                 if ($activo)
                                 echo "<td><i class=\"icon-check\"></i></td>";
                                else echo "<td><i class=\"icon-check-empty\"></i></td>";
                                 if ($row['usado'])
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









					</div>
				</div><!--/span-->

			<!--/div></row-->


