Cobrar Servicio
<br><br>
<form class="form-horizontal" action="/functions/cart.php">
				<fieldset>

								<input type="hidden" name="data" value="pos" >

                                <input type="hidden" name="prid" value="339">
                                <input type="hidden" name="codigo_inventario" value="70006139">

                                <input type="hidden" name="iva" value="16">
                                <input type="hidden" name="servicio" value="1">
                                <input type="hidden" name="codigo" value="1040339">
								<input type="hidden" name="func" value="add_item">

                    		<div class="control-group ">
								<label class="control-label" for="producto">Producto o Servicio</label>
								<div class="controls">
								  <input class="input-xlarge" id="producto" name="producto" type="text" value="">
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" >Precio Contado</label>
								<div class="controls">
								  <input class="input-small" id="precio_contado" name="precio_contado" type="text" value="">
								</div>
							  </div>

                              <div class="control-group">
								<label class="control-label" >Precio Credito</label>
								<div class="controls">
								  <input class="input-small" id="precio_credito" name="precio_credito" type="text" value="">
								</div>
							  </div>



							  <div class="control-group">
								<label class="control-label" >Color</label>
								<div class="controls">
								  <input class="input-small" id="color" name="color" type="text" value="N/A">
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" >Talla</label>
								<div class="controls">
								  <input class="input-small" id="talla" name="talla" type="text" value="N/A">
								</div>
							  </div>


					 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Agregar</button>
							  </div>
							</fieldset>
			</form>