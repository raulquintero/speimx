<?php

require_once 'cupones.src.php';
 ?>
<ul>
<a href="/index.php?data=cupones&op=generados&activo=0"><button class="btn-danger"><i class="halflings-icon inbox white "></i>&nbsp;Ver Sin Activar</button></a>
<a href="/index.php?data=cupones&op=generados&activo=1"><button class="btn-success"><i class="halflings-icon inbox white "></i>&nbsp;Ver Activados</button></a>

</ul>

<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Campa&ntilde;as</h2>
						<div class="box-icon">
							<a onclick="showData('myModal','view/cupones/cupones_agregar.inc.php','f=agregar')" class="btn-setting"><i class="halflings-icon plus"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div id="cupones" class="box-content">

                        <?php showCupones();?>

                    </div>
</div>

<?php




?>