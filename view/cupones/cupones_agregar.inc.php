<?php
$relative_path=isset($relative_path) ? $relative_path : "";
$relative_path="/../..";
$realpath=getcwd();

require_once $realpath.'/../../config/config.php';
$database = new DB();

foreach( $_POST as $key => $value )
{
    $_POST[$key] = $database->filter( $value );
}

foreach( $_GET as $key => $value )
{
    $_GET[$key] = $database->filter( $value );
}
$case=isset($_GET['case']) ? $_GET['case'] : "";
$cuid=isset($_GET['cuid']) ? $_GET['cuid'] : "";
$f=isset($_GET['f']) ? $_GET['f'] : "";
$fecha_ini=$fecha_fin="";
 $database = new DB();

if ($cuid){
     $query="select * from cupon where cupon_id=$cuid limit 1";
 	list( $cupon_id,$cupon,$fecha_ini,$fecha_fin,$cantidad,$cupontipo_id  ) = $database->get_row( $query );
}
else
    $fecha_ini=$fecha_fin=date("Y/m/d");

?>
	<form class="form-horizontal" action="/functions/crud_cupones.php">
							<fieldset>

<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">x</button>
			<h3><?php echo strtoupper($f)?> Cupon</h3>
		</div>
		<div class="modal-body">

								<input type="hidden" name="data" value="<?php echo $_GET['data']?>" >
								<input type="hidden" name="op" value="<?php echo $_GET['op']?>">
                                <input type="hidden" name="cuid" value="<?php echo $_GET['cuid']?>">

								<?php
								if ($f=="agregar")
									echo "<input type=\"hidden\" name=\"func\" value=\"c\">";
									else
									echo "<input type=\"hidden\" name=\"func\" value=\"u\">";
								?>




								<div class="control-group">
								<label class="control-label">Activo</label>
								 <div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox1" name="activo"  value="1"  <?php if (!$editar) echo " checked"?>>
								  </label>
								 </div>
								</div>



							  <div class="control-group ">
								<label class="control-label" for="cupon">Nombre Cupon</label>
								<div class="controls">
								  <input class="input-xlarge" id="cupon" name="cupon" type="text" value="<?php echo $cupon?>">
								</div>
							  </div>

							<div class="control-group">
							  <label class="control-label" for="fecha_ini">Fecha Inicio (m/d/A)</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="fecha_ini" name="fecha_ini" value="<?php echo fechamysqltous($fecha_ini)?>">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="fecha_fin">Fecha Fin (m/d/A)</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="fecha_fin" name="fecha_fin" value="<?php echo fechamysqltous($fecha_fin)?>">
							  </div>
							</div>


							  <div class="control-group ">
								<label class="control-label" for="cantidad">Cantidad</label>
								<div class="controls">
								  <input class="input-xlarge" id="cantidad" name="cantidad" type="text" value="<?php echo $cantidad?>">
								</div>
							  </div>

							<!--<div class="control-group">
								<label class="control-label">Sexo</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="sexo_id" id="sexo" value="0" checked="">
									Femenino
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="sexo_id" id="sexo" value="1">
									Masculino
								  </label>
								</div>
							  </div>
                              -->

                              <?php combobox("cupontipo",$cupontipo_id)?>





		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<button type="submit" class="btn btn-primary">Grabar</button>


            </div>
							</fieldset>
						  </form>