<!-- <object type="text/html" data="/view/appliances/appliances_switch.php" width="800" border=1 height="400"> </object> -->

<!-- <iframe width="800" height="200" scrolling="no" frameborder="0" src="/view/appliances/appliances_switch.php" target="_top"> </iframe>
<br> -->

							
<?php

$q=isset($_GET['q']) ? $_GET['q'] : "";

switch($q){
	case "off": $salida = shell_exec('./wemo 192.168.1.4 OFF'); break;
	case "on": $salida = shell_exec('./wemo 192.168.1.4 ON'); break;
	case "status": $salida = shell_exec('./wemo 192.168.1.4 GETSTATE'); break;
}

//if (!$q) header("Location: /index.php?data=appliances");
$switch1="Letrero 1";
$salida=3;
$salida = shell_exec('./wemo 192.168.1.4 GETSTATE'); 
$salida= str_replace("\n", "", $salida);

if ($salida=="OFF"){
		echo "LETRERO 1 is OFF<br><br>";
		echo "<a href='/index.php?data=appliances&q=on'
				class=\"quick-button span2\">
				<i class=\"icon-off\"></i>
				<p> $switch1 </p>
				</a>";
}

if ($salida=="ON" || $salida==1){
    	echo "LETRERO 1 is ON<br><br>";
    	echo "<a href='/index.php?data=appliances&q=off'
				class=\"quick-button span2 yellow\">
				<i class=\"icon-off\"></i>
				<p> $switch1 </p>
				</a>";
}
echo "<br><br><br><br><br><br><br>";

//if ($salida=="OFF")
{
		echo "LETRERO 2 is OFF<br><br>";
		echo "<a 
				class=\"quick-button span2\">
				<i class=\"icon-off\"></i>
				<p> Letrero 2 </p>
				</a>";
}




//echo "$salida -- $status -- $cuantos";

?>


<br><br><br><br><br><br>


								<div class="header-top-first clearfix">
									<ul class="social-links circle small clearfix hidden-xs">
										<li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="icon-twitter"></i></a></li>
										<li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="icon-linkedin"></i></a></li>
										<li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="icon-google-plus"></i></a></li>
										<li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="icon-facebook"></i></a></li>
										<li class="pinterest"><a target="_blank" href="http://www.pinterest.com"><i class="icon-pinterest"></i></a></li>
									</ul>
									<div class="social-links hidden-lg hidden-md hidden-sm circle small">
										<div class="btn-group dropdown">
											<ul class="dropdown-menu dropdown-animation">
												<li><i class="icon-off"></i></li>
												<li class="icon-skype"><a target="_blank" href="http://www.skype.com"><i class="icon-skype"></i></a></li>
												<li class="icon-linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="icon-linkedin"></i></a></li>
												<li class="icon-googleplus"><a target="_blank" href="http://plus.google.com"><i class="icon-google-plus"></i></a></li>
												<li class="icon-youtube"><a target="_blank" href="http://www.youtube.com"><i class="icon-youtube-play"></i></a></li>
												<li class="icon-flickr"><a target="_blank" href="http://www.flickr.com"><i class="icon-flickr"></i></a></li>
												<li class="icon-facebook"><a target="_blank" href="http://www.facebook.com"><i class="icon-facebook"></i></a></li>
												<li class="icon-pinterest"><a target="_blank" href="http://www.pinterest.com"><i class="icon-pinterest"></i></a></li>
											</ul>
										</div>
									</div>
									<ul class="list-inline hidden-sm hidden-xs">
										<li><i class="icon-map-marker pr-5 pl-10"></i>One Infinity Loop Av, Tk 123456</li>
										<li><i class="icon-phone pr-5 pl-10"></i>+12 123 123 123</li>
										<li><i class="icon-envelope pr-5 pl-10"></i> theproject@mail.com</li>
									</ul>
								</div>
								<!-- header-top-first end -->
