<?php
require_once('config/config.php');

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



$code=strtoupper(htmlspecialchars($_GET["code"]));

$type=(htmlspecialchars($_GET["type"]));

$cuantos=strlen($code);

echo $code[0];
if ($cuantos==7)
		{
			switch ($code[0]) {
				case 'T':
					$location="Location: /index.php?data=clientes&op=factura&fid=$code";
					break;
				case 'C':
					$location="Location: /functions/cart.php?func=sel_cliente&cid=$code";
					break;
				
				default:
					# code...
					break;
			}
			header($location);


				//  ************ consultar tickets
			if ($code[0]=="T")
			{
				// ************  devoluciones

				$location="Location: /index.php?data=clientes&op=factura&fid=T000006";
				header($location);

			}  
			 if ($code[0]=="T")
			{
				// ************  devoluciones

				$location="Location: /index.php?data=clientes&op=factura&fid=T000006";
				header($location);

			}   

		}


switch ($type) {
	case 'item':
		$cuantos=strlen($code);
		if ($cuantos==8){

		$query = "SELECT color.color,producto.producto_id,producto,proveedor,precio_compra,precio_contado,precio_credito,
		precio_promocion,descuento, marca,producto.codigo,inventariodet.codigo as codigo_inventario,producto.talla_id,talladet.talladet,unidad,estilo,subcategoria FROM producto,proveedor,marca,talla,
		unidad,subcategoria,color,inventariodet,talladet WHERE producto.proveedor_id=proveedor.proveedor_id AND producto.marca_id=marca.marca_id 
		AND producto.talla_id=talla.talla_id AND producto.unidad_id=unidad.unidad_id AND producto.subcategoria_id=subcategoria.subcategoria_id 
		AND producto.producto_id=color.producto_id AND color.color_id=inventariodet.color_id AND inventariodet.talladet_id=talladet.talladet_id
		AND inventariodet.codigo='$code'";

		list( $color,$producto_id,$producto,$proveedor,$precio_compra,$precio_contado,$precio_credito,$precio_promocion,$descuento,
			$marca,$codigo,$codigo_inventario ,$talla_id, $talla,$unidad,$estilo,$subcategoria  ) = $database->get_row( $query );


		 $location="Location: /functions/cart.php?func=add_item&prid=$producto_id&producto=$producto&marca=$marca&codigo=$codigo&codigo_inventario=$codigo_inventario
		&talla=$talla&color=$color&precio_credito=$precio_credito&precio_contado=$precio_contado";
		//if ($codigo_inventario)
		header($location);
		}
		break;
	
	case 'dev':
		# code...
		break;

	default:
		# code...
		break;
}

//exit();




?>

<!DOCTYPE html>
<html lang="es_MX">
<head>
	
	<!-- start: Meta -->
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
	<title>SPEI.MX 1.0.0.1</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->

	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'> -->
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
	<script type="text/javascript">
	function setFocusToTextBox(){
		$('#textcode').focus();
		//document.getElementById('textcode').focus();
	}
	</script>	
</head>

<body onload='setFocusToTextBox()'>
	<?php //echo "session:".$_SESSION['user_login_session'];?>
		<!-- start: Header -->
	<div class="navbar hidden-print">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<span class="brand" >SPEI.MX 1.0.0.1 [Sucursal: <?php echo $_SESSION['sucursal'] ?>]</span>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white warning-sign"></i>
							</a>
							<ul class="dropdown-menu notifications">
								<li class="dropdown-menu-title">
 									<span>You have 11 notifications</span>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>	
                            	<li>
                                    <a href="#">
										<span class="icon blue"><i class="icon-user"></i></span>
										<span class="message">New user registration</span>
										<span class="time">1 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon green"><i class="icon-comment-alt"></i></span>
										<span class="message">New comment</span>
										<span class="time">7 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon green"><i class="icon-comment-alt"></i></span>
										<span class="message">New comment</span>
										<span class="time">8 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon green"><i class="icon-comment-alt"></i></span>
										<span class="message">New comment</span>
										<span class="time">16 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon blue"><i class="icon-user"></i></span>
										<span class="message">New user registration</span>
										<span class="time">36 min</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon yellow"><i class="icon-shopping-cart"></i></span>
										<span class="message">2 items sold</span>
										<span class="time">1 hour</span> 
                                    </a>
                                </li>
								<li class="warning">
                                    <a href="#">
										<span class="icon red"><i class="icon-user"></i></span>
										<span class="message">User deleted account</span>
										<span class="time">2 hour</span> 
                                    </a>
                                </li>
								<li class="warning">
                                    <a href="#">
										<span class="icon red"><i class="icon-shopping-cart"></i></span>
										<span class="message">New comment</span>
										<span class="time">6 hour</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon green"><i class="icon-comment-alt"></i></span>
										<span class="message">New comment</span>
										<span class="time">yesterday</span> 
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="icon blue"><i class="icon-user"></i></span>
										<span class="message">New user registration</span>
										<span class="time">yesterday</span> 
                                    </a>
                                </li>
                                <li class="dropdown-menu-sub-footer">
                            		<a>View all notifications</a>
								</li>	
							</ul>
						</li>
						<!-- END: Notifications Dropdown -->

						<!-- start: Message Dropdown -->
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white envelope"></i>
							</a>
							<ul class="dropdown-menu messages">
								<li class="dropdown-menu-title">
 									<span>You have 9 messages</span>
									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>	
                            	<li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	6 min
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	56 min
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	3 hours
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	yesterday
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="avatar"><img src="img/avatar.jpg" alt="Avatar"></span>
										<span class="header">
											<span class="from">
										    	Dennis Ji
										     </span>
											<span class="time">
										    	Jul 25, 2012
										    </span>
										</span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>  
                                    </a>
                                </li>
								<li>
                            		<a class="dropdown-menu-sub-footer">View all messages</a>
								</li>	
							</ul>
						</li>
						<!-- end: Message Dropdown -->
						<!-- <li>
							<a class="btn" href="#">
								<i class="halflings-icon white wrench"></i>
							</a>
						</li> -->
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> <?php echo $_SESSION['administrador'];?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Account Settings</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="authmain.php?module=login&action=1"><i class="halflings-icon off"></i> Logout</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
				

						<!-- start: Notifications Dropdown -->
						<li class="dropdown ">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white tasks"></i>
							</a>
							<ul class="dropdown-menu tasks">
								<li class="dropdown-menu-title">
 									<span>Planes de Pagos</span>

									<a href="#refresh"><i class="icon-repeat"></i></a>
								</li>
								<li>
                                    <a href="#">
										<span class="header">
											<span class="title">Hasta</span>
											<span class="percent">Abono</span>
										</span>
                                    </a>
                                </li>
                               
                                <li>
                                    <a href="#">
										<span class="header">
											<span class="title">1500.00</span>
											<span class="percent">100.00</span> 
										</span>
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="header">
											<span class="title">2000.00</span>
											<span class="percent">150.00</span> 
										</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="header">
											<span class="title">2500.00</span>
											<span class="percent">200.00</span> 
										</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
										<span class="header">
											<span class="title">3000.00</span>
											<span class="percent">250.00</span> 
										</span>
                                    </a>
                                </li>
								<li>
                                    <a href="#">
										<span class="header">
											<span class="title">5000.00</span>
											<span class="percent">350.00</span> 
										</span>
                                    </a>
                                </li>

								<li>
                            		<a class="dropdown-menu-sub-footer">Ver todos los planes</a>
								</li>	
							</ul>
						</li>
						<!-- end: Notifications Dropdown -->


					</ul>
				


				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	



		<div class="container-fluid-full">
		<div class="row-fluid ">
				

			<!-- start: Main Menu -->

			<div id="sidebar-left" class="span2 hidden-print">
				<div class="nav nav-collapse  sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="index.html"><i class="icon-bar-chart hidden-print"></i><span class="hidden-tablet hidden-print"> Dashboard</span></a></li>	
						<li><a href="index.php?data=mensajes"   ><i class="icon-envelope hidden-print"></i><span class="hidden-tablet hidden-print"> Messages</span></a></li>
						<li><a href="index.php?data=pos"        ><i class="icon-shopping-cart hidden-print" ></i><span class="hidden-tablet hidden-print"> PoS</span></a></li>

						<li>
							<a class="dropmenu" href="#"><i class="icon-chevron-right hidden-print"></i><span class="hidden-tablet hidden-print"> Sistema </span><span class="label label-important"> 2 </span></a>
							<ul>
								
								<li><a href="index.php?data=clientes&op=devoluciones"><i class="icon-book"    ></i><span class="hidden-tablet"> Devoluciones</span></a></li>
								<li><a href="index.php?data=cobronomina"><i class="icon-book"    ></i><span class="hidden-tablet"> Cobro x Nomina</span></a></li>
								<li><a href="index.php?data=catalogo"><i class="icon-barcode"></i><span class="hidden-tablet"> Catalogo</span></a></li>
							</ul>
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-chevron-right hidden-print">   </i><span class="hidden-tablet hidden-print"> Captura </span><span class="label label-important"> 4 </span></a>
							<ul>
								<li><a href="index.php?data=clientes"><i class="icon-group"></i><span class="hidden-tablet"> Clientes</span></a></li>
								<li><a href="index.php?data=empresas"><i class="icon-road"></i><span class="hidden-tablet"> Empresas Nomina</span></a></li>
								<li><a href="index.php?data=proveedores"><i class="icon-road"></i><span class="hidden-tablet"> Proveedores</span></a></li>
								<li><a href="index.php?data=productos"><i class="icon-barcode"></i><span class="hidden-tablet"> Productos</span></a></li>
								<li><a href="index.php?data=tallas"><i class="icon-barcode"></i><span class="hidden-tablet"> Tallas</span></a></li>
							</ul>
						</li>

						<li><a href="index.php?data=agenda"><i class="icon-calendar hidden-print"></i><span class="hidden-tablet hidden-print"> Agenda</span></a></li>
					</ul>
				</div>
			</div>

			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			<!-- start: Content-->
			




			<!-- start: Content -->
			<div id="content" class="span10 ">
			
<?php
	$data=(htmlspecialchars($_GET["data"]));
	$op=(htmlspecialchars($_GET["op"]));
	$lnk=(htmlspecialchars($_GET["data"])).".inc.php";
?>
						
			<ul class="breadcrumb hidden-print">
				<li>
					<i class="icon-home "></i>
					<a href="index.html" >Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a  href="/index.php?data=<?php echo $data?>"><?php echo ucfirst($data)?></a></li>
				
			</ul>

			<div class="row-fluid ">
				




				<?php

				if (!htmlspecialchars($_GET["data"])) $data="pos";
				if (!htmlspecialchars($_GET["op"])) $op="";
					else $op="_".$op;
				
				$lnk="view/".$data.$op.".inc.php";
					include "view/".$data."/".$data.$op.".inc.php";
					
// 					echo $lnk;

// 					echo "<br><br>";          // ********DEBUG**********
// foreach ($_SESSION as $k => $v) { echo "<br>[$k] => $v \n";}

//  echo  "<br>";
// print_r($_SESSION['cart']);



?>






		


			</div><!--/row-->
	</div><!--/.fluid-container-->
	






			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
<!-- 		
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
	 -->
	<div class="clearfix"></div>
	
	<footer class="hidden-print">

		<p>
			<span style="text-align:left;float:left" class="hidden-print">&copy; 2010 Tienda de Ropa Alberto's</span>
			
		</p>

	</footer>
	
	<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
	
		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->
	
<script>
function mostrar_carta(carta) {
    window.open(carta);
}
</script>

</body>
</html>
