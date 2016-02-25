<?php
require $realpath.'./config/config.php';
$database = new DB();

foreach( $_POST as $key => $value )
{
    $_POST[$key] = $database->filter( $value );
}

foreach( $_GET as $key => $value )
{
    $_GET[$key] = $database->filter( $value );
}
$q = isset($_GET['q']) ? $_GET['q'] : "";

	 $query = "SELECT nombre,apellidop,apellidom,codigo_cliente,tipocredito_id from cliente 
	 where 
	 CONCAT(nombre,' ',apellidop,' ',apellidom) like '%".$q."%' OR
	 CONCAT(apellidop,' ',apellidom,' ',nombre) like '%".$q."%' AND
	 cliente_id>0 order by apellidop limit 50";
	 if ($q) 
	 	{$subs = $database->get_results( $query );
	 	 $cuantos=count ($subs);}
?>

		<div class="row-fluid">
				<div class="box  span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Seleccione un cliente de <?php echo $cuantos?></h2>
						<div class="box-icon">

							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href='<?php echo "/index.php?data=clientes&op=detalles&cid=$cid"?>' ><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					<table class="table table-striped table-bordered">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>PA</th>
							  </tr>
						  </thead>
						  <tbody>


<?php

					foreach( $subs as $sub )
						{
						$fullname=$sub['apellidop']." ".$sub['apellidom']." ".$sub['nombre'];
						$codigo_cliente=$sub['codigo_cliente'];
						$tcid=$sub['tipocredito_id'];	
                         echo "<tr>
                         <td><a href='/index.php?data=clientes&op=verificar&cid=$codigo_cliente'>".strtoupper($fullname)."</a></td>
                         <td class='center'	>0</td>
                         </tr>";  
                        }
?>
					</tbody>
				</table>					





						
                    </div>

</div><!--/row-->



















































							</fieldset>
						  </form>

					</div>
				</div><!--/span-->

			</div><!--/row-->
