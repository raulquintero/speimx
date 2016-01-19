Cobrar Servicio
<br><br>
<form class="form-horizontal" action="?data=pos&op=cortedecaja">
				<fieldset>

								<input type="hidden" name="data" value="pos" >
								<input type="hidden" name="op" value="cortedecaja">
								<input type="hidden" name="f" value="<?php echo $_GET['f']?>">

                    		<div class="control-group ">
								<label class="control-label" for="nombre">Producto o Servicio</label>
								<div class="controls">
								  <input class="input-xlarge" id="nombre" name="nombre" type="text" value="">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" >Precio</label>
								<div class="controls">
								  <input class="input-xlarge" id="apellidopaterno" name="apellidop" type="text" value="">
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" >Color</label>
								<div class="controls">
								  <input class="input-xlarge" id="apellidopaterno" name="apellidop" type="text" value="N/A">
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" >Talla</label>
								<div class="controls">
								  <input class="input-xlarge" id="apellidopaterno" name="apellidop" type="text" value="N/A">
								</div>
							  </div>
							  
							 
					 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Agregar</button>
							  </div>
							</fieldset>
			</form>