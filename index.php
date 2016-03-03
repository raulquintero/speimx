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

$nid=$_SESSION['nid'];
$code = isset($_GET['code']) ? $_GET['code'] : '';
//$code = isset($code) ? $code : ' ';
$producto_id = isset($_GET['producto_id']) ? $_GET['producto_id'] : '';
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : ' ';
//$filtro = isset($filtro) ?  : ' ';
$location = isset($_GET['location']) ? $_GET['location'] : '';
$subcat = isset($_GET['subcat']) ? $_GET['subcat'] : '';

$total_contado = isset($total_contado) ? $total_contado : '0.00';
$promociones = isset($promociones) ? $promociones : '';
$promo = isset($promo) ? $promo : '';

$type = isset($_GET['type']) ? $_GET['type'] : '';
//$code=strtoupper(htmlspecialchars($_GET["code"]));

if ($code=="SERVICIO") header ("location: /index.php?data=pos&op=servicio");


$cuantos=strlen($code);



switch ($cuantos) {
    case 16:  //clientes
            $location="Location: /index.php?data=clientes&op=verificar&cid=$code";
        break;
    case 14:  // ticket
            $location="Location: /index.php?data=pos&sku=$code";
        break;
    case 12: //  cupon

	    break;
	case 8: // producto sku
        switch($type){
            case "item":  //agregar al carrito  de compra
	 	        $query = "SELECT color.color,producto.producto_id,producto,proveedor,precio_compra,precio_contado,precio_credito,
     		        precio_promocion,descuento, marca,producto.codigo,inventariodet.codigo as codigo_inventario,producto.talla_id,talladet.talladet,unidad,estilo,subcategoria,producto.temporada_id
                    FROM producto,proveedor,marca,talla,
    		        unidad,subcategoria,color,inventariodet,talladet WHERE producto.proveedor_id=proveedor.proveedor_id AND producto.marca_id=marca.marca_id
	    	        AND producto.talla_id=talla.talla_id AND producto.unidad_id=unidad.unidad_id AND producto.subcategoria_id=subcategoria.subcategoria_id
		            AND producto.producto_id=color.producto_id AND color.color_id=inventariodet.color_id AND inventariodet.talladet_id=talladet.talladet_id
		            AND inventariodet.codigo='$code'";
		        list( $color,$producto_id,$producto,$proveedor,$precio_compra,$precio_contado,$precio_credito,$precio_promocion,$descuento,
			        $marca,$codigo,$codigo_inventario ,$talla_id, $talla,$unidad,$estilo,$subcategoria,$temporada_id ) = $database->get_row( $query );
		        $producto=htmlspecialchars($producto);
	   	        if ($producto_id)
                    $location="Location: /functions/cart.php?func=add_item&prid=$producto_id&producto=$producto&marca=$marca&codigo=$codigo&codigo_inventario=$codigo_inventario&talla=$talla&color=$color&precio_compra=$precio_compra&precio_credito=$precio_credito&precio_contado=$precio_contado&precio_promocion=$precio_promocion&descuento=$descuento&iva=$iva&temporada_id=$temporada_id";
                break;
			case 'dev': //agregar al carrito de devoluciones
					//$fid_dev=$_SESSION['fid_dev'];
					$query="SELECT saldo from cliente,factura where cliente.cliente_id=factura.cliente_id AND factura.factura_id=".$_SESSION['fid_dev']." limit 1";
					list( $dev_saldo  ) = $database->get_row( $query );
					$_SESSION['dev_saldo']=$dev_saldo;
					$fdid=get_fiddev($code);
					$location="Location: /functions/cart_dev.php?facturadet_id=$facturadet_id&func=add_dev_item&facturadet_id=$fdid";
			    break;
			case 'checarprecio':  //checar precio
				$location="Location: /index.php?data=pos&op=checarprecio&code=$code";
				// $location="Location: /functions/cart.php?func=sel_cliente&cid=$code";
				break;
        }

    break;

	default:
	# code...
	break;
}

if ($location)
header($location);



//if ($cuantos==7 )
		{
			switch ($code[0]) {
				case 'T': //ticket devolucion
					//$_SESSION['cart_dev']="";
					//$_SESSION['cart_temp']="";
					getfactura_temp($code);
					$fid_dev=$_SESSION['fid_dev'];

					$location="Location: /index.php?data=clientes&op=factura&fid=$fid_dev";
					//exit();
					break;
				case 'C':
					 $location="Location: /index.php?data=clientes&op=verificar&cid=$code";
					// $location="Location: /functions/cart.php?func=sel_cliente&cid=$code";
					break;
				case 'V':
					$location="Location: /index.php?data=pos&op=vale&vale=$code";
					break;
				default:
					# code...
					break;
			}
			header($location);
		}

/*
if ($cuantos==8)
		{
			switch ($type) {
				case 'dev':
					//$fid_dev=$_SESSION['fid_dev'];
					$query="SELECT saldo from cliente,factura where cliente.cliente_id=factura.cliente_id AND factura.factura_id=".$_SESSION['fid_dev']." limit 1";
					list( $dev_saldo  ) = $database->get_row( $query );
					$_SESSION['dev_saldo']=$dev_saldo;
					$fdid=get_fiddev($code);
					$location="Location: /functions/cart_dev.php?facturadet_id=$facturadet_id&func=add_dev_item&facturadet_id=$fdid";
					break;
				case 'checarprecio':
					 $location="Location: /index.php?data=productos&op=checarprecio&code=$code";
					// $location="Location: /functions/cart.php?func=sel_cliente&cid=$code";
					break;

				default:
					# code...
					break;
			}



			header($location);
		}
*/

//exit();
/*
switch ($type) {
	case 'item':
		$cuantos=strlen($code);
		if ($cuantos==8){

		$query = "SELECT color.color,producto.producto_id,producto,proveedor,precio_compra,precio_contado,precio_credito,
		precio_promocion,descuento, marca,producto.codigo,inventariodet.codigo as codigo_inventario,producto.talla_id,talladet.talladet,unidad,estilo,subcategoria
        FROM producto,proveedor,marca,talla,
		unidad,subcategoria,color,inventariodet,talladet WHERE producto.proveedor_id=proveedor.proveedor_id AND producto.marca_id=marca.marca_id
		AND producto.talla_id=talla.talla_id AND producto.unidad_id=unidad.unidad_id AND producto.subcategoria_id=subcategoria.subcategoria_id
		AND producto.producto_id=color.producto_id AND color.color_id=inventariodet.color_id AND inventariodet.talladet_id=talladet.talladet_id
		AND inventariodet.codigo='$code'";

		list( $color,$producto_id,$producto,$proveedor,$precio_compra,$precio_contado,$precio_credito,$precio_promocion,$descuento,
			$marca,$codigo,$codigo_inventario ,$talla_id, $talla,$unidad,$estilo,$subcategoria  ) = $database->get_row( $query );
		$producto=htmlspecialchars($producto);

	    	 $location="Location: /functions/cart.php?func=add_item&prid=$producto_id&producto=$producto&marca=$marca&codigo=$codigo&codigo_inventario=$codigo_inventario&talla=$talla&color=$color&precio_compra=$precio_compra&precio_credito=$precio_credito&precio_contado=$precio_contado&precio_promocion=$precio_promocion&descuento=$descuento&iva=$iva";
		//if ($codigo_inventario)

	   	if ($producto_id) 		header($location);
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
*/



?>

<!DOCTYPE html>
<html lang="es_MX">
<head>

	<!-- start: Meta -->
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>SPEI.MX 1.0.0.1</title>
	<meta name="description" content="SPEIMX - POS Software">
	<meta name="author" content="Raul Quintero">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->

	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->

	<!-- start: CSS -->

	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
   	<link id="base-style" href="css/style_local.css" rel="stylesheet">
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
	function setFocusToCantidad(){
		$('#cantidad').focus();
		//document.getElementById('textcode').focus();
	}
 window.onkeyup = compruebaTecla;
function compruebaTecla(){
    var e = window.event;
    var tecla = (document.all) ? e.keyCode : e.which;
    if(tecla == 27){
        this.document.location.href = "/index.php";
        	/*$('#textcode').focus(); */
    }
    if(tecla == 113){
        showClientes(20);
        $('#clientesModal').modal('show') ;
    	// $('#text').focus();

        	/*$('#textcode').focus(); */
    }


}
	</script>
</head>

<body onload='setFocusToTextBox()'>
<?php
if($_SESSION['host']=="speimx.dev" || $_SESSION['host']=="speimx.dev:82" )
	echo "<table width=100%><tr bgcolor=yellow><td>".$_SESSION['host'].".- Version  Desarrollo. $realpath</td></tr></table>";


 ?>
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


                    	<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white th-list"></i>
							</a>
							<ul class="dropdown-menu notifications">




                    			<li class="dropdown-menu-title">
 									<span>Shortcuts</span>
									<!--a href="#refresh"><i class="icon-repeat"></i></a-->
								</li>

                              	<li>
                                    <a href="/index.php?data=pos">
										<span class="icon green"><i class="icon-barcode"></i></span>
										<span class="message">Pos</span>
										<span class="time">1 min</span>
                                    </a>
                                </li>
								<li>
                                    <a href="/index.php?data=productos&op=checarprecio">
										<span class="icon green"><i class="icon-barcode"></i></span>
										<span class="message">checar Precio</span>
										<span class="time">1 min</span>
                                    </a>
                                </li>

                            	<li>
                                    <a href="/index.php?data=pos&op=servicio">
										<span class="icon yellow"><i class="icon-user"></i></span>
										<span class="message">Venta Miscelaneos</span>
										<span class="time">1 min</span>
                                    </a>
                                </li>
								<li>
                                    <a href="https://www.pagoexpress.com.mx/wpimmex/Login.aspx" target="tel">
										<span class="icon blue"><i class="icon-bullhorn"></i></span>
										<span class="message">Recargas TELCEL</span>
										<span class="time">7 min</span>
                                    </a>
                                </li>
								<li>
                                    <a href="/index.php?data=pos&op=andrea">
										<span class="icon red"><i class="icon-comment-alt"></i></span>
										<span class="message">Pedido ANDREA</span>
										<span class="time">8 min</span>
                                    </a>
                                </li>
								<li class="warning">
                                    <a href="#">
										<span class="icon red"><i class="icon-comment-alt"></i></span>
										<span class="message">Pedido CKLASS</span>
										<span class="time">16 min</span>
                                    </a>
                                </li>

								<li>
                                    <a href="?data=pos&op=cortedecaja">
										<span class="icon blue"><i class="icon-user"></i></span>
										<span class="message">Corte de Caja</span>
										<span class="time">yesterday</span>
                                    </a>
                                </li>
                                <!--li class="dropdown-menu-sub-footer">
                            		<a>View all notifications</a>
								</li-->
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
										    	3 hours
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

								<?php
									$query = "SELECT abono,limite FROM abono where activado=1 ORDER BY limite ASC";

									$results = $database->get_results( $query );
									foreach ($results as $row )
									{

										echo "<li>
                                    		<a href=\"#\">
											<span class=\"header\">
												<span class=\"title\">".dinero($row['limite'])."</span>
												<span class=\"percent\">".dinero($row['abono'])."</span>
											</span>
                                    		</a>
                                		</li>";
									}

								?>



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

			<div id="sidebar-left" class="span2 hidden-print ">
				<div class="nav nav-collapse  sidebar-nav <?php if ($nid>=6) echo "hidden-desktop"?>">
					<ul class="nav nav-tabs nav-stacked main-menu">

<?php

						if ($nid<=6) echo "<li><a href=\"index.html\"><i class=\"icon-bar-chart hidden-print\"></i><span class=\"hidden-tablet hidden-print\"> Dashboard</span></a></li>";
						if ($nid<5) echo "<li><a href=\"index.php?data=mensajes\"   ><i class=\"icon-envelope hidden-print\"></i><span class=\"hidden-tablet hidden-print\"> Messages</span></a></li>";
						 //echo "<li><a href=\"index.php?data=pos\"        ><i class=\"icon-shopping-cart hidden-print\" ></i><span class=\"hidden-tablet hidden-print\"> PoS</span></a></li>";
						 //echo "<li><a href=\"index.php?data=productos&op=checarprecio\"><i class=\"icon-barcode hidden-print\"       ></i><span class=\"hidden-tablet hidden-print\"> Checar Precio</span></a></li>";

						//if ($nid<=8) echo "<li><a href=\"index.php?data=clientes&op=devoluciones\"><i class=\"icon-book\"    ></i><span class=\"hidden-tablet\"> Devoluciones</span></a></li>";



						if ($nid<=8) echo "<li><a class=\"dropmenu\" href=\"#\"><i class=\"icon-chevron-right hidden-print\"></i><span class=\"hidden-tablet hidden-print\"> Administracion </span></a>";
						echo "<ul>";
								if ($nid<=6) echo "<li><a href=\"index.php?data=catalogo\"><i class=\"icon-barcode\"></i><span class=\"hidden-tablet\"> Catalogo</span></a></li>";

   						   	if ($nid<=6) echo "<li><a href=\"index.php?data=compras\"><i class=\"icon-book\"    ></i><span class=\"hidden-tablet\"> Compras </span></a></li>";
						   	if ($nid<=6) echo "<li><a href=\"index.php?data=cupones\"><i class=\"icon-book\"    ></i><span class=\"hidden-tablet\"> Cupones </span></a></li>";
						   	if ($nid<=6) echo "<li><a href=\"index.php?data=promociones\"><i class=\"icon-book\"    ></i><span class=\"hidden-tablet\"> Promociones </span></a></li>";
						    echo "<li><a href=\"index.php?data=pedidos\"                  ><i class=\"icon-shopping-cart hidden-print\" ></i><span class=\"hidden-tablet hidden-print\"> Pedidos</span></a></li>";

                        echo "</ul>";


						if ($nid<=8) echo "<li><a class=\"dropmenu\" href=\"#\"><i class=\"icon-chevron-right hidden-print\"></i><span class=\"hidden-tablet hidden-print\"> Nomina </span></a>";
							echo "<ul>";

								if ($nid<=6) echo "<li><a href=\"index.php?data=nomina&op=cobronomina\"><i class=\"icon-book\"    ></i><span class=\"hidden-tablet\"> Cobro x Nomina</span></a></li>";
							echo "</ul>";
						echo "</li>";


						echo "<li>";
							if ($nid<=6) echo "<a class=\"dropmenu\" href=\"#\"><i class=\"icon-chevron-right hidden-print\">   </i><span class=\"hidden-tablet hidden-print\"> Catalogos </span></a>";
							echo "<ul>";

								if ($nid<=6) echo "<li><a href=\"index.php?data=clientes\"><i class=\"icon-group\"></i><span class=\"hidden-tablet\"> Clientes</span></a></li>";
								if ($nid<=6) echo "<li><a href=\"index.php?data=empresas\"><i class=\"icon-road\"></i><span class=\"hidden-tablet\"> Empresas Nomina</span></a></li>";
								if ($nid<=6) echo "<li><a href=\"index.php?data=proveedores\"><i class=\"icon-road\"></i><span class=\"hidden-tablet\"> Proveedores</span></a></li>";
								if ($nid<=6) echo "<li><a href=\"index.php?data=productos\"><i class=\"icon-barcode\"></i><span class=\"hidden-tablet\"> Productos</span></a></li>";
								if ($nid<=6) echo "<li><a href=\"index.php?data=tallas\"><i class=\"icon-barcode\"></i><span class=\"hidden-tablet\"> Tallas</span></a></li>";
								if ($nid<=6) echo "<li><a href=\"index.php?data=temporadas\"><i class=\"icon-barcode\"></i><span class=\"hidden-tablet\"> Temporadas</span></a></li>";
							echo "</ul>";

						if ($nid<=8) echo "<li><a class=\"dropmenu\" href=\"#\"><i class=\"icon-chevron-right hidden-print\"></i><span class=\"hidden-tablet hidden-print\"> Reportes </span></a>";
							echo "<ul>";

								if ($nid<=6) echo "<li><a href=\"index.php?data=estadisticas&op=reportegral\"><i class=\"icon-barcode\"></i><span class=\"hidden-tablet\"> Reporte General</span></a></li>";
								if ($nid<=6) echo "<li><a href=\"index.php?data=estadisticas&op=ventas\"><i class=\"icon-barcode\"></i><span class=\"hidden-tablet\"> Ventas</span></a></li>";
								if ($nid<=6) echo "<li><a href=\"index.php?data=estadisticas&op=existencias\"><i class=\"icon-barcode\"></i><span class=\"hidden-tablet\"> Existencias</span></a></li>";
								if ($nid<=6) echo "<li><a href=\"index.php?data=estadisticas&op=entradas_salidas\"><i class=\"icon-barcode\"></i><span class=\"hidden-tablet\"> Entradas/Salidas</span></a></li>";
							echo "</ul>";
						echo "</li>";
						if ($nid<=8) echo "<li><a class=\"dropmenu\" href=\"#\"><i class=\"icon-chevron-right hidden-print\"></i><span class=\"hidden-tablet hidden-print\"> Sistema </span></a>";
							echo "<ul>";

								if ($nid<=6) echo "<li><a href=\"index.php?data=catalogo\"><i class=\"icon-barcode\"></i><span class=\"hidden-tablet\"> Usuarios</span></a></li>";
								if ($nid<=8) echo "<li><a href=\"index.php?data=mantenimiento&op=db\"><i class=\"icon-book\"    ></i><span class=\"hidden-tablet\"> Base de Datos</span></a></li>";
								if ($nid<=6) echo "<li><a href=\"index.php?data=mantenimiento&op=impuestos\"><i class=\"icon-book\"    ></i><span class=\"hidden-tablet\"> Impuestos</span></a></li>";
								if ($nid<=6) echo "<li><a href=\"index.php?data=inventarios\"><i class=\"icon-barcode\"></i><span class=\"hidden-tablet\"> Inventarios</span></a></li>";
								if ($nid<=6) echo "<li><a href=\"index.php?data=catalogo\"><i class=\"icon-barcode\"></i><span class=\"hidden-tablet\"> Temas</span></a></li>";
								if ($nid<=8) echo "<li><a href=\"index.php?data=appliances\"><i class=\"icon-book\"    ></i><span class=\"hidden-tablet\"> Appliances</span></a></li>";
							echo "</ul>";
						echo "</li>";

						if ($nid<=6) echo "<li><a href=\"index.php?data=agenda\"><i class=\"icon-calendar hidden-print\"></i><span class=\"hidden-tablet hidden-print\"> Agenda</span></a></li>";


?>


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


<?php
	//$data=(htmlspecialchars($_GET["data"]));
    $data = isset($_GET['data']) ? $_GET['data'] :  "pos";
    $op = isset($_GET['op']) ?  "_".$_GET['op'] : '';
	//$op=(htmlspecialchars($_GET["op"]));
	//$lnk=(htmlspecialchars($_GET["data"])).".inc.php";
    $lnk = isset($_GET['lnk']) ? $_GET['lnk'] : '';
?>


			<!-- start: Content -->
			<div id="content" class="span10 ">

			<ul class="breadcrumb hidden-print hidden-phone">
				<!--<li>
					<i class=" fa-icon-tasks"></i>
					<a href="/index.php" >Accesos Rapido</a>
					<i class="icon-angle-right"></i>
				</li>-->
                <li>
                	<i class=" fa-icon-tasks"></i>
					&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php?data=<?php echo $data?>"><span><?php echo strtoupper($data) ?></span></a>&nbsp;
					&nbsp;&nbsp;&nbsp;
                 </li>
				<!--<li><a  href="/index.php?data=<?php echo $data?>"><?php echo ucfirst($data)?></a></li>-->
                <?php
                //if ($data=="pos")
                {?>
                <li><a href="/index.php?data=pos"><button class="btn-primary" ><i class="icon-barcode "></i>&nbsp;POS</button></a></li>
				<li><a href="/index.php?data=pos&op=checarprecio"><button class="btn-primary yellow" ><i class="icon-barcode "></i>&nbsp;Checar Precio</button></a></li>
                <li><a href="/index.php?data=pos&op=servicio"><button class="btn-primary orange"  ><i class="icon-barcode " ></i>&nbsp;Miscelaneos</button></a></li>
                <li><a href="/index.php?data=pos&op=andrea"><button class="btn-danger" ><i class="halflings-icon inbox white "></i>&nbsp;Hacer Pedido</button></a></li>
                <?php } ?>
			</ul>


            <div class="row-fluid">


            <?php

			//	if (!isset($_GET["data"])) $data="pos";
			//	if (!isset($_GET['op'])) $op="";
			  //		else $op="_".$op;

			 	$lnk="view/".$data.$op.".inc.php";
					include "view/".$data."/".$data.$op.".inc.php";


//                  echo "<br><br>";          // ********DEBUG**********
// foreach ($_SESSION as $k => $v) { echo "<br>[$k] => $v \n";}

//  echo  "<br>";
// print_r($_SESSION['cart']);
            ?>

			</div><!--/row-->

            <div id='show_messages'>

            <?php
              if (isset($_GET['eed']))
              switch ($_GET['eed']){
                case 1: alert_hecho("HECHO", "Registro Actualizado");
                        break;
                }
            ?>

             </div>
	</div><!--/.fluid-container-->







			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->


        	<div class="modal hide fade" id="myModal">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3><span class=\"label label-inverse\">Editar Producto</span></h3>
		</div>
       <form class="form-vertical" action="/functions/editar_producto.php">
		<div class="modal-body">



        <div id='txtHint'><ul><b></b></ul></div>




			</div>
           	<div class="modal-footer">
				    <button class="btn" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Grabar Cambios</button>
    		</div>
    </form>
			</div>


	<div class="modal hide fade" id="clientesModal">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3><span class=\"label label-inverse\">Cartera de Clientes</span></h3>
		</div>
   
		<div class="modal-body">

			<div class="alert alert-success">
				Nombre: <input class='input-xlarge focused' type=text name=q onkeypress="return pulsar(event)" id="text" 
							onkeyup='showClientes(this.value)' autofocus>
				</div>

        <div id='clientesHint'><ul><b></b></ul></div>




			</div>
           	<div class="modal-footer">
				    <button class="btn" data-dismiss="modal">Cancel</button>
					<!-- <button type="submit" class="btn btn-primary">Grabar Cambios</button> -->
    		</div>

			</div>


<!--
	<div class="modal hide fade" id="mymodal">
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

        <script src="js/showdata.js"></script>


	<!-- end: JavaScript-->

<script>
function mostrar_carta(carta) {
    window.open(carta);
}



  
function showClientes(str)
{
if (str=="")
  {
  document.getElementById("clientesHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("clientesHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","/show_clientes.ajax.php?q="+str,true);
xmlhttp.send();
}

function pulsar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return (tecla != 13);
}



</script>

</body>
</html>
