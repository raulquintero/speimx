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
$prid=$_GET['q'];


?>


		<div class="row-fluid">
				<div class="box  span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Seleccione un cliente</h2>
						<div class="box-icon">

							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href='<?php echo "/index.php?data=clientes&op=detalles&cid=$cid"?>' ><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>PA</th>
							  </tr>
						  </thead>
						  <tbody>


<?php
	 $query = "SELECT nombre,apellidop,apellidom,cliente_id,tipocredito_id from cliente";
	 $subs = $database->get_results( $query );

					foreach( $subs as $sub )
						{
						$fullname=$sub['apellidop']." ".$sub['apellidom']." ".$sub['nombre'];
						$cid=$sub['cliente_id'];
						$tcid=$sub['tipocredito_id'];	
                         echo "<tr><td><a 
                         href='/functions/cart.php?func=sel_cliente&cid=$cid&tipocredito_id=$tcid'>".strtoupper($fullname)."</a></td><td class='center'	>0</td></tr>";  
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
