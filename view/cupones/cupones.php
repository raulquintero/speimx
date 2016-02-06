<html>
<head>




	<script type="text/javascript">

	function setFocusToCantidad(){
		//$('#cantidad').focus();
		document.getElementById('cantidad').focus();
	}
	</script>
</head>

<body onload='setFocusToCantidad()'>




<?php

$relative_path=isset($relative_path) ? $relative_path : "";
$relative_path="/../..";
$realpath=getcwd();

require_once $realpath.'/../../config/config.php';
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
$case=isset($_GET['case']) ? $_GET['case'] : "";
 $database = new DB();





$cuid=isset($_GET['cuid']) ? $_GET['cuid'] : "";
$f=isset($_GET['f']) ? $_GET['f'] : "";
$fecha_ini=$fecha_fin=date("Y/m/d");
$cupon=isset($_GET['cupon']) ? $_GET['cupon'] : "";
$monto=isset($_GET['monto']) ? $_GET['monto'] : "";






if ($f=="generar")
{

?>
	<form class="form-horizontal" action="/functions/crud_cupones.php">
							<fieldset>

<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">x</button>
			<h3><?php echo strtoupper($f)?> CUPON [<?php echo $cupon?>]</h3>
		</div>
		<div class="modal-body">

								<input type="hidden" name="data" value="cupones" >
								<input type="hidden" name="op" value="detalles">
                                <input type="hidden" name="cuid" value="<?php echo $_GET['cuid']?>">

                               <input type="hidden" name="func" value="g">

							  <div class="control-group ">
								<label class="control-label" for="cupon">Bueno por $</label>
								<div class="controls">
								  <input class="input-xlarge" id="cupon" name="cupon" type="text" value="<?php echo dinero($monto)?>" disabled>
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
								<label class="control-label" for="cuantos">Cantidad</label>
								<div class="controls">
								  <input class="input-xlarge" id="cuantos" name="cuantos" type="text" value="<?php echo $cantidad?>">
								</div>
							  </div>


                              <?php //combobox("cupontipo",$cupontipo_id)?>





		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<button type="submit" class="btn btn-primary">Generar</button>


            </div>
							</fieldset>
						  </form>




<?php
}
?>



</body>
</html>
