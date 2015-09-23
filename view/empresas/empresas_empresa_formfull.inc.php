<?php

?>

				<div class="alert alert-info">
							<strong>Datos Credito</strong>
				</div>

							   <div class="control-group ">
								<label class="control-label" for="credito">Credito</label>
								<div class="controls">
								  <input class="input-xlarge " id="credito" name="credito" type="text" value="<?php echo $credito?>">
								</div>
							  </div>

							  <div class="control-group ">
								<label class="control-label" for="total_ultimo">Total Financiado</label>
								<div class="controls">
								  <input class="input-xlarge" id="total_ultimo" name="total_ultimo" type="text" value="<?php echo $total_ultimo?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" >Inicio Plazo (m/d/A)</label>
								<div class="controls">
								  <input class="input-xlarge datepicker" id="fecha_total-inicio" name="fecha_total_inicio" type="text" value="<?php echo fechamysqltous($fecha_total_inicio)?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" >Fin Plazo (m/d/A)</label>
								<div class="controls">
								  <input class="input-xlarge datepicker" id="fecha_total_ultimo" name="fecha_total_ultimo" type="text" value="<?php echo fechamysqltous($fecha_total_ultimo)?>">
								</div>
							  </div>

							   <div class="control-group ">
								<label class="control-label" for="saldo">Saldo</label>
								<div class="controls">
								  <input class="input-xlarge " id="saldo" name="saldo" type="text" value="<?php echo $saldo?>">
								</div>
							  </div>

							  <div class="control-group ">
								<label class="control-label" for="abono">Abono</label>
								<div class="controls">
								  <input class="input-xlarge" id="abono" name="abono" type="text" value="<?php echo $abono?>">
								</div>
							  </div>
							 

