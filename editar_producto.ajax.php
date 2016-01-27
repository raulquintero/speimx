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


<?php

	 //$prid=(htmlspecialchars($_GET["prid"]));





	 if ($prid>0)
	 {
		$query = "SELECT producto_id,proveedor_id,producto,detalle,talla_id,precio_credito,precio_contado,precio_promocion,precio_compra,descuento,
				subcategoria_id,categoria_id,unidad_id,marca_id,estilo,color_id,codigo,stock,up,activo,consultas,inventariable,temporada_id
			 FROM producto WHERE producto_id=$prid";
		list(        $producto_id,$proveedor_id,$producto,$detalle,$talla_id,$precio_credito,$precio_contado,$precio_promocion,$precio_compra,$descuento,
				$subcategoria_id,$categoria_id,$unidad_id,$marca_id,$estilo,$color_id,$codigo,$stock,$up,$activo,$consultas,$inventariable,$temporada_id) = $database->get_row( $query );
		if (!$activo) $checado="";
		if (!$inventariable) $checado_inv="";

		$precio_compra=dinero($precio_compra*1.16);
		$precio_contado=dinero($precio_contado*1.16);
		$precio_credito=dinero($precio_credito*1.16);


		$queryWhere="";
	 }else
	 {
	 	$proveedor_id=$_GET['pid'];
	 	echo $subcategoria_id=$_GET['subcat'];
	 }




?>
					<?php echo error($_GET['eed']);	?>
			<div class="row-fluid">
				<div class="box  span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span><?php echo strtoupper(stripslashes($producto))?> [Edicion Compl.]</h2>
						<div class="box-icon">

							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href='<?php echo "/index.php?data=clientes&op=detalles&cid=$cid"?>' ><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content span6">
                        <!--div class="box-header">
						    <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Producto</h2>
						    <div class="box-icon">
							    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						    </div>
					    </div-->
							<fieldset>

								<input type="hidden" name="data" value="<?php echo $_GET['data']?>" >
								<input type="hidden" name="op" value="<?php echo $_GET['op']?>">
								<input type="hidden" name="f" value="<?php echo $_GET['f']?>">
								<?php echo "<input type=\"hidden\" name=\"func\" value=\"u\">";?>
								<input type="hidden" name="prid" value=<?php echo $prid?> >




						<div class="row-fluid condensed">
									<!--div class="box span11"-->
								<div class="control-group">
								    <div class="controls ">
								        <label class="checkbox inline">Activo
									    <input type="checkbox" id="activo" name="activo"    <?php if ($activo) echo "value=1 checked";?>>
								        </label>
                                        <label class="checkbox inline">OnLine
									    <input type="checkbox" id="up" name="up" <?php if ($up) echo " checked";?>>
								        </label>
								    </div>
								</div>

							    <?php combobox("subcategoria",$subcategoria_id)?>

						        <?php //combobox("talla",$talla_id)?>

                                <?php combobox("temporada",$temporada_id)?>

                        </div>
                    </div>


                   <div class="box-content span5">
					<!--div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Precios</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						</div>
					</div-->


					<div class="box-content">

							  <div class="control-group">
								<label class="control-label" >Precio Compra</label>
								<div class="controls">
								  <input class="input-small" id="precio_compra" name="precio_compra" type="text" value="<?php echo $precio_compra?>"> <?php echo dinero($precio_compra/1.16)?>
								</div>
							  </div>


							<div class="control-group">
							  <label class="control-label" for="precio_contado">Precio Contado</label>
							  <div class="controls">
								<input type="text" class="input-small" id="precio_contado" name="precio_contado" value="<?php echo $precio_contado?>"> <?php echo dinero($precio_contado/1.16)?>
							  </div>
							</div>

							  <div class="control-group">
								<label class="control-label" >Precio Credito</label>
								<div class="controls">
								  <input class="input-small" id="precio_credito" name="precio_credito" type="text" value="<?php echo $precio_credito?>"> <?php echo dinero($precio_credito/1.16)?>
								</div>
							  </div>

                             <div class="control-group">
								<label class="control-label" >Descuento</label>
								<div class="controls">
								  <input class="input-small" id="descuento" name="descuento" type="text" value="<?php echo $descuento?>">%
								</div>
							  </div>

                             <div class="control-group">
								<label class="control-label" >Precio Promocion</label>
								<div class="controls">
								  <input class="input-small" id="precio_promocion" name="precio_promocion" type="text" value="<?php echo $precio_promocion?>">%
								</div>
							  </div>


                        </fieldset>

					</div>
		<!--/div--><!--/span-->






</div><!--/row-->



















































							</fieldset>
						  </form>

					</div>
				</div><!--/span-->

			</div><!--/row-->
