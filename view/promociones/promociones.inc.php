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
        <td style='text-align:left'>".dinero($row['descuento'])."% [Editar]
        <td style='text-align:left'>".$total_items."</td></tr>";


        $query = "SELECT count(producto_id) as total from producto where temporada_id=".$row['temporada_id']." AND descuento=".$row['descuento'];
        list( $incluidos ) = $database->get_row( $query );

        $query = "SELECT count(producto_id) as total from producto where temporada_id=".$row['temporada_id']." AND descuento<>".$row['descuento'];
        list( $excluidos ) = $database->get_row( $query );
        echo " <tr><td>&nbsp;&nbsp;&nbsp;
                <a href='/index.php?data=promociones&tid=".$row['temporada_id']."&i=1'>Incluidos</a></td><td style='text-align:left'>".$incluidos."</td></tr>";
        echo " <tr><td>&nbsp;&nbsp;&nbsp;
                <a href='/index.php?data=promociones&tid=".$row['temporada_id']."&i=0'>excluidos</a></td><td style='text-align:left'>".$excluidos."</td>
                <td><input type='button' value='Aplicar'/></td></tr>";

        }
?>

                                  </tbody>
						 </table>


                    </div>

                    </div>

                    <div class="box span8">
                     <div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Temporada > Regular <span style='color:green'>[Incluidos]</span> </h2>
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







	<div class="row-fluid condensed">





				<div class="box span8">
                    <div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Transacciones</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div><!--/span-->

                    <div class="box-content">
						<table class="table table-condensed">
							  <thead>
                                <tr><th bgcolor="#cccccc" colspan=5>Ingresos Netos</th></tr>

							  </thead>
							  <tbody>

                                    <?php

                                    	//$fecha_inicio=fechaustomysql($fecha_inicio);
                                    	//$fecha_final =fechamysqltous($fecha_final);
                                    mostrar_transacciones($fecha_inicio,$fecha_final,$user);?>
							  	<?php echo $user;?>



  				</tbody>
						 </table>

					</div>

			<div class="box span4 hidden-print">
                    <div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Nota de Venta</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div><!--/span-->

                    <div class="box-content">
						<table class="table table-condensed">
							  <thead>
                                <tr><th bgcolor="#cccccc" colspan=5>Preview</th></tr>

							  </thead>
							  <tbody>

                                    <?php

                                    	//$fecha_inicio=fechaustomysql($fecha_inicio);
                                    	//$fecha_final =fechaustomysql($fecha_final);
                                   // mostrar_transacciones($fecha_inicio,$fecha_final,$user);?>
							  	<?php if ($_GET['fid']) getticket($_GET['fid']);?>



  				</tbody>
						 </table>

					</div>
			</div><!--/row-->
		</div>
		</div>