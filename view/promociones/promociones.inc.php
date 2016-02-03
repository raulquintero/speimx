<?php
  require_once($realpath.'/view/promociones/promociones.src.php');

	if(!$_GET['fi'])
		$fecha_inicio=date("m/d/Y"); else $fecha_inicio=$_GET['fi'];
	if(!$_GET['ff'])
		$fecha_final=date("m/d/Y");else $fecha_final=$_GET['ff'];
    if (!$_GET['tid'])
        $tid=0;else $tid=$_GET['tid'];
?>








	<div class="row-fluid condensed">
				<div class="box span4 hidden-print">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Temporadas</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div>
					<div class="box-content">

                    	<table class="table table-condensed" >
							  <thead>
								  <tr>
									  <th style="text-align:center">Temporada</th><th>Descuento</th><th>Items</th>
								  </tr>
							  </thead>
							  <tbody>



<?php
	$query = "SELECT * from temporada ";
	$results = $database->get_results( $query );
    foreach( $results as $row )
        {
        $query = "SELECT count(producto_id) as total from producto where temporada_id=".$row['temporada_id'];
        list( $total_items ) = $database->get_row( $query );

        echo " <tr><td><b>".strtoupper($row['temporada'])."</b></td>
        <td style='text-align:left'><div id='editar_".strtolower($row['temporada'])."'>".dinero($row['descuento'])."%
        <a  onclick=\"showData('editar_".strtolower($row['temporada'])."','promociones_f.php','data=promociones&case=editar_porcentaje&temporada_id=".$row['temporada_id']."')\">[Editar]</a></div>
        <td style='text-align:left'>".$total_items."</td></tr>";


        $query = "SELECT count(producto_id) as total from producto where temporada_id=".$row['temporada_id']." AND descuento=".$row['descuento'];
        list( $incluidos ) = $database->get_row( $query );

        $query = "SELECT count(producto_id) as total from producto where temporada_id=".$row['temporada_id']." AND descuento<>".$row['descuento'];
        list( $excluidos ) = $database->get_row( $query );
        echo " <tr><td>&nbsp;&nbsp;&nbsp;
                <a href='/index.php?data=promociones&tid=".$row['temporada_id']."&i=1'>Incluidos</a></td><td style='text-align:left'>".$incluidos."</td>";
        echo " <td>";
            echo "<form action='/functions/crud_promociones.php' method=post>";
            echo "<input type='hidden' name='data' value='$data' />";
            echo "<input type='hidden' name='func' value='a' />";
            echo "<input type='hidden' name='i' value='1' />";
            echo "<input type='hidden' name='temporada_id' value='".$row['temporada_id']."' />";
            echo "<input type=\"submit\" value='Aplicar' />";
            echo "</form>";
            echo "</td></tr>";
        echo " <tr><td>&nbsp;&nbsp;&nbsp;
                <a href='/index.php?data=promociones&tid=".$row['temporada_id']."&i=0'>excluidos</a></td><td style='text-align:left'>".$excluidos."</td>
                <td>";
            echo "<form action='/functions/crud_promociones.php' method=post>";
            echo "<input type='hidden' name='data' value='$data' />";
            echo "<input type='hidden' name='func' value='a' />";
            echo "<input type='hidden' name='i' value='0' />";
            echo "<input type='hidden' name='temporada_id' value='".$row['temporada_id']."' />";
            echo "<input type=\"submit\" value='Aplicar' />";
            echo "</form>";
            echo "</td></tr>";

        }
?>

                                  </tbody>
						 </table>


                    </div>

                    </div>
<?php
    $query = "SELECT temporada from temporada where temporada_id=".$tid;
    list( $temporada ) = $database->get_row( $query );
    if ($_GET['i']) $seccion="<span class='label green label-inverse'>Incluidos</span>";
        else $seccion="<span class='label red label-inverse'>Excluidos</span>"
?>
                    <div class="box span8">
                     <div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Temporada > <?php echo strtoupper($temporada)." ".$seccion?>
                         </h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>



<?php


?>

						<table class="table table-condensed">
							  <thead>
								  <tr>
									  <th  colspan=2 style="text-align:center"><?php echo $categoria .">".$subcategoria?> </th>
								  </tr>
							  </thead>
							  <tbody>

                              <?php catalogo($tid,$_GET['i'])?>
                                  </tbody>
						 </table>











                    </div>











    </div>  <!---main condensed  ----->







	