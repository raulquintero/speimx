
<?php
	if(!$_GET['fi'])
		$fecha_inicio=date("m/01/Y"); else $fecha_inicio=$_GET['fi'];
	if(!$_GET['ff'])
		$fecha_final=date("m/d/Y");else $fecha_final=$_GET['ff'];
?>

<?php
 $query = "SELECT sum(cantidad) as total from movimiento
 where fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59' AND (movimiento.tipomov_id=1 OR movimiento.tipomov_id=13 or movimiento.tipomov_id=14)";
		list( $total ) = $database->get_row( $query );
$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=2 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $devoluciones ) = $database->get_row( $query );

$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=14 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $ventas_contado ) = $database->get_row( $query );
$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=3 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $ventas_credito ) = $database->get_row( $query );
$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=1 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $abonos ) = $database->get_row( $query );
$query = "SELECT sum(cantidad) as total from movimiento
	where movimiento.tipomov_id=13 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $enganche ) = $database->get_row( $query );

 $query = "SELECT sum(total) as total from pedido
	where fecha_orden>='".fechaustomysql($fecha_inicio)."' AND fecha_orden<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $pedidos_andrea ) = $database->get_row( $query );

$query = "SELECT sum(cantidad) as total from pedido_movimiento
	where pedido_movimiento.tipomov_id=14 AND fecha>='".fechaustomysql($fecha_inicio)."' AND fecha<='".fechaustomysql($fecha_final)." 23:59:59'";
		list( $anticipos_andrea ) = $database->get_row( $query );

?>



                <div class="span3 statbox blue" onTablet="span6" onDesktop="span3">
					<div class="boxchart">4000,3000,2000,3000,5000,2000</div>
					<div class="number"><?php echo round($total)?><i class="icon-arrow-up"></i></div>
					<div class="title">ingresos netos</div>
					<div class="footer">
						<a href="#ingresos"> read full report</a>
					</div>
				</div>
				<div class="span3 statbox blue" onTablet="span6" onDesktop="span3">
					<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
					<div class="number">0<i class="icon-arrow-down"></i></div>
					<div class="title">proveedores</div>
					<div class="footer">
						<a href="#"> read full report</a>
					</div>
				</div>
				<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
					<div class="number">0<i class="icon-arrow-up"></i></div>
					<div class="title">otras deudas</div>
					<div class="footer">
						<a href="#"> read full report</a>
					</div>
				</div>
				<div class="span3 statbox orange noMargin" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
					<div class="number">982<i class="icon-arrow-up"></i></div>
					<div class="title">gasto operativo</div>
					<div class="footer">
						<a href="#"> read full report</a>
					</div>
				</div>

	<div class="row-fluid condensed">
				<div class="box span3 hidden-print">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Corte de Caja</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
                    </div>
					<div class="box-content">

    			    <form class="form-vertical" action="?data=estadisticas&op=reportegral">
	    			    <fieldset>
								<input type="hidden" name="data" value="estadisticas" >
								<input type="hidden" name="op" value="ventas">


								<input type="hidden" name="f" value="<?php echo $_GET['f']?>">

                    <div class="control-group">
							  <label class="control-label" for="date01"><b>Fecha Inicio</b> (m/d/A)</label>
							  <div class="controls">
								<input type="text" class="input-small datepicker" id="fi" name="fi" value="<?php echo $fecha_inicio?>">
								<input type="text" class="input-small datepicker" id="hi" name="hi" value="8:00:00">
							  </div>
					</div>

                    <div class="control-group">
							  <label class="control-label" for="date02"><b>Fecha Fin</b> (m/d/A)</label>
							  <div class="controls">
								<input type="text" class="input-small datepicker" id="ff" name="ff" value="<?php echo $fecha_final?>">
								<input type="text" class="input-small datepicker" id="hf" name="hf" value="<?php echo date("G:i:s")?>">
							  </div>
					</div>

					 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Generar</button>
							  </div>
						</fieldset>
		        	</form>

                    </div>

                    </div>


				<div class="sparkLineStats span4 widget green" onTablet="span5" onDesktop="span4">

                    <ul class="unstyled">
                        <li><span class="sparkLineStats3"></span>
                            Ingresos Netos:
                            <span class="number">$ <?php echo dinero($total)?></span>
                        </li>
                        <li><span class="sparkLineStats4"></span>
                            Ventas Credito:
                            <span class="number">2,19</span>
                        </li>
                        <li><span class="sparkLineStats5"></span>
                            Deuda Ventas Credito:
                            <span class="number">00:02:58</span>
                        </li>
                        <li><span class="sparkLineStats6"></span>
                            Ventas Contado: <span class="number">59,83%</span>
                        </li>
                        <li><span class="sparkLineStats7"></span>
                            Pedidos:
                            <span class="number">70,79%</span>
                        </li>
                        <li><span class="sparkLineStats8"></span>
                            Deuda:
                            <span class="number">29,21%</span>
                        </li>


                    </ul>

					<div class="clearfix"></div>

                </div><!-- End .sparkStats -->



                <div class="span5 widget blue" onTablet="span7" onDesktop="span5">

					<div id="stats-chart2"  style="height:282px" ></div>

				</div>


    </div>  <!---main condensed  ----->

    <!--div class="box span11"-->
    <a name="ingresos"></a>
	<div class="row-fluid condensed">
                     <div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Ingresos </h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
		<div class="box-content">
    			<table class="table table-condensed">
							  <thead>
								  <tr>
									  <th  colspan=2 style="text-align:center">Periodo <?php echo  $fecha_inicio." - ".$fecha_final?> </th>
								  </tr>
							  </thead>
							  <tbody>

                                  <tr><td>Ingresos Netos</td><td style="text-align:right"><?php echo dinero($total)?></td></tr>


                                  <tr><td>Ventas Credito</td><td style="text-align:right"><?php echo dinero($ventas_credito)?></td></tr>
                                  <tr><td>Enganche</td><td style="text-align:right"><?php echo dinero($enganche)?></td></tr>
                                  <tr><td>Ventas Contado</td><td style="text-align:right"><?php echo dinero($ventas_contado)?></td></tr>
                                  <tr><td>Abonos</td><td style="text-align:right"><?php echo dinero($abonos)?></td></tr>
                                  <tr><td>Devoluciones</td><td style="text-align:right"><?php if($devoluciones>0)echo "<font color=red><b> -"; echo dinero($devoluciones)?></td></tr>

                                <tr bgcolor=gray><td style="color:white;border-top:2px solid"><b>Total</b></td><td style="text-align:right;color:white;border-top:2px solid"><b><?php echo dinero($total-$devoluciones)?></b></td></tr>
                                  <tr><td>Pedidos Andrea</td><td style="text-align:right"><?php echo dinero($pedidos_andrea)?></td></tr>
                                  <tr><td>Anticipos</td><td style="text-align:right"><?php echo dinero($anticipos_andrea)?></td></tr>


                              </tbody>
						 </table>
            </div>
    </div> <!-- end seccion  -->





					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Proveedores</h2>

                        <div class="clearfix"></div>
                    </div>
                    <br>


			<div class="row-fluid hideInIE8 circleStats">

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox yellow">
						<div class="header">Nautica</div>
						<span class="percent">percent</span>
						<div class="circleStat">
                    		<input type="text" value="63" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">16000</span>
								<span class="unit">MX</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">23000</span>
								<span class="unit">MX</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox green">
						<div class="header">Franky Max JC</div>
						<span class="percent">percent</span>
						<div class="circleStat">
                    		<input type="text" value="78" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">5000</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">5000</span>
								<span class="unit">GB</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox greenDark">
						<div class="header">Moda para ti</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="100" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2 noMargin" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox pink">
						<div class="header">Oscar</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="83" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GHz</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">3.2</span>
								<span class="unit">GHz</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox orange">
						<div class="header">Memory</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="100" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox greenLight">
						<div class="header">Memory</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="100" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">64</span>
								<span class="unit">GB</span>
							</span>
						</div>
                	</div>
				</div>

			</div>

			<div class="row-fluid">

				<div class="widget blue span5" onTablet="span6" onDesktop="span5">

					<h2><span class="glyphicons globe"><i></i></span> Demographics</h2>

					<hr>

					<div class="content">

						<div class="verticalChart">

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>37%</span>
									</div>

								</div>

								<div class="title">US</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>16%</span>
									</div>

								</div>

								<div class="title">PL</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>12%</span>
									</div>

								</div>

								<div class="title">GB</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>9%</span>
									</div>

								</div>

								<div class="title">DE</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>7%</span>
									</div>

								</div>

								<div class="title">NL</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>6%</span>
									</div>

								</div>

								<div class="title">CA</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>5%</span>
									</div>

								</div>

								<div class="title">FI</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>4%</span>
									</div>

								</div>

								<div class="title">RU</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>3%</span>
									</div>

								</div>

								<div class="title">AU</div>

							</div>

							<div class="singleBar">

								<div class="bar">

									<div class="value">
										<span>1%</span>
									</div>

								</div>

								<div class="title">N/A</div>

							</div>

							<div class="clearfix"></div>

						</div>

					</div>

				</div><!--/span-->

				<div class="widget span3 red" onTablet="span6" onDesktop="span3">

					<h2><span class="glyphicons pie_chart"><i></i></span> Browsers</h2>

					<hr>

					<div class="content">

						<div class="browserStat big">
							<img src="img/browser-chrome-big.png" alt="Chrome">
							<span>34%</span>
						</div>
						<div class="browserStat big">
							<img src="img/browser-firefox-big.png" alt="Firefox">
							<span>34%</span>
						</div>
						<div class="browserStat">
							<img src="img/browser-ie.png" alt="Internet Explorer">
							<span>34%</span>
						</div>
						<div class="browserStat">
							<img src="img/browser-safari.png" alt="Safari">
							<span>34%</span>
						</div>
						<div class="browserStat">
							<img src="img/browser-opera.png" alt="Opera">
							<span>34%</span>
						</div>


					</div>
				</div>

				<div class="widget yellow span4 noMargin" onTablet="span12" onDesktop="span4">
					<h2><span class="glyphicons fire"><i></i></span> Server Load</h2>
					<hr>
					<div class="content">
						 <div id="serverLoad2" style="height:224px;"></div>
					</div>
				</div>

			</div>

			<div class="row-fluid">

				<div class="box black span4" onTablet="span6" onDesktop="span4">
					<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Weekly Stat</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<ul class="dashboard-list metro">
							<li>
								<a href="#">
									<i class="icon-arrow-up green"></i>
									<strong>92</strong>
									New Comments
								</a>
							</li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-down red"></i>
							  <strong>15</strong>
							  New Registrations
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-minus blue"></i>
							  <strong>36</strong>
							  New Articles
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-comment yellow"></i>
							  <strong>45</strong>
							  User reviews
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-up green"></i>
							  <strong>112</strong>
							  New Comments
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-arrow-down red"></i>
							  <strong>31</strong>
							  New Registrations
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-minus blue"></i>
							  <strong>93</strong>
							  New Articles
							</a>
						  </li>
						  <li>
							<a href="#">
							  <i class="icon-comment yellow"></i>
							  <strong>256</strong>
							  User reviews
							</a>
						  </li>
						</ul>
					</div>
				</div><!--/span-->

				<div class="box black span4" onTablet="span6" onDesktop="span4">
					<div class="box-header">
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Last Users</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<ul class="dashboard-list metro">
							<li class="green">
								<a href="#">
									<img class="avatar" alt="Dennis Ji" src="img/avatar.jpg">
								</a>
								<strong>Name:</strong> Dennis Ji<br>
								<strong>Since:</strong> Jul 25, 2012 11:09<br>
								<strong>Status:</strong> Approved
							</li>
							<li class="yellow">
								<a href="#">
									<img class="avatar" alt="Dennis Ji" src="img/avatar.jpg">
								</a>
								<strong>Name:</strong> Dennis Ji<br>
								<strong>Since:</strong> Jul 25, 2012 11:09<br>
								<strong>Status:</strong> Pending
							</li>
							<li class="red">
								<a href="#">
									<img class="avatar" alt="Dennis Ji" src="img/avatar.jpg">
								</a>
								<strong>Name:</strong> Dennis Ji<br>
								<strong>Since:</strong> Jul 25, 2012 11:09<br>
								<strong>Status:</strong> Banned
							</li>
							<li class="blue">
								<a href="#">
									<img class="avatar" alt="Dennis Ji" src="img/avatar.jpg">
								</a>
								<strong>Name:</strong> Dennis Ji<br>
								<strong>Since:</strong> Jul 25, 2012 11:09<br>
								<strong>Status:</strong> Updated
							</li>
						</ul>
					</div>
				</div><!--/span-->

				<div class="box black span4 noMargin" onTablet="span12" onDesktop="span4">
					<div class="box-header">
						<h2><i class="halflings-icon white check"></i><span class="break"></span>To Do List</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div class="todo metro">
							<ul class="todo-list">
								<li class="red">
									<a class="action icon-check-empty" href="#"></a>
									Windows Phone 8 App
									<strong>today</strong>
								</li>
								<li class="red">
									<a class="action icon-check-empty" href="#"></a>
									New frontend layout
									<strong>today</strong>
								</li>
								<li class="yellow">
									<a class="action icon-check-empty" href="#"></a>
									Hire developers
									<strong>tommorow</strong>
								</li>
								<li class="yellow">
									<a class="action icon-check-empty" href="#"></a>
									Windows Phone 8 App
									<strong>tommorow</strong>
								</li>
								<li class="green">
									<a class="action icon-check-empty" href="#"></a>
									New frontend layout
									<strong>this week</strong>
								</li>
								<li class="green">
									<a class="action icon-check-empty" href="#"></a>
									Hire developers
									<strong>this week</strong>
								</li>
								<li class="blue">
									<a class="action icon-check-empty" href="#"></a>
									New frontend layout
									<strong>this month</strong>
								</li>
								<li class="blue">
									<a class="action icon-check-empty" href="#"></a>
									Hire developers
									<strong>this month</strong>
								</li>
							</ul>
						</div>
					</div>
				</div>

			</div>

			<div class="row-fluid">

				<a class="quick-button metro yellow span2">
					<i class="icon-group"></i>
					<p>Users</p>
					<span class="badge">237</span>
				</a>
				<a class="quick-button metro red span2">
					<i class="icon-comments-alt"></i>
					<p>Comments</p>
					<span class="badge">46</span>
				</a>
				<a class="quick-button metro blue span2">
					<i class="icon-shopping-cart"></i>
					<p>Orders</p>
					<span class="badge">13</span>
				</a>
				<a class="quick-button metro green span2">
					<i class="icon-barcode"></i>
					<p>Products</p>
				</a>
				<a class="quick-button metro pink span2">
					<i class="icon-envelope"></i>
					<p>Messages</p>
					<span class="badge">88</span>
				</a>
				<a class="quick-button metro black span2">
					<i class="icon-calendar"></i>
					<p>Calendar</p>
				</a>

				<div class="clearfix"></div>

			</div><!--/row-->



	</div><!--/.fluid-container-->

			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->

	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>

	<div class="clearfix"></div>