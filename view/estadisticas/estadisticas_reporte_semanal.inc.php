<?php
// cotizaciones.inc.php
echo "Reporte Semanal<br><br>";

 if (!$statusc) $statusc=4;

if ($statusc==0)  {$bgcolor="0055aa";$fc="white";$title=" Abonos";}

if ($statusc==2)  {$bgcolor="00aa55";$fc="white";$title=" Devoluciones";}

if ($statusc==3)  {$bgcolor="dddddd";$fc="black";$title=" Ventas";}

if ($cms)  {$bgcolor="ffcc01";$fc="black";$title=" Comisiones";}


     echo "<table cellpadding=0 cellspacing=0 width=100% style='border:1px solid black'>";
echo "<tr><td height=30 background=../imagenes/back_bar_black.png align=center><font color=white>$title</td></tr>";
echo "<tr><td>&nbsp;";
echo "<a href=./pm.php?mn=9&sec=pm_edocuenta&cms=1><img src=../imagenes/nuevas.png height=20 border=0>Comisiones</a> ";
echo "| <a href=./pm.php?mn=9&sec=pm_edocuenta><img src=../imagenes/nuevas.png height=20 border=0>Abonos</a> ";
echo "| <a href=./pm.php?mn=9&sec=pm_edocuenta&statusc=2><img src=../imagenes/procesar.png height=20 border=0>Devoluciones</a> ";
echo "| <a href=./pm.php?mn=9&sec=pm_edocuenta&statusc=3><img height=20 src=../imagenes/pendiente.png border=0>Ventas Credito</a> ";
echo "| <a href=./pm.php?mn=9&sec=pm_edocuenta&statusc=4><img height=20 src=../imagenes/pendiente.png border=0>Ventas Contado</a> ";
echo "| <a href=./pm.php?mn=9&sec=pm_edocuenta&statusc=5><img height=20 src=../imagenes/pendiente.png border=0>Comisiones 2</a> ";

echo "</td></tr></table><br>";

echo "<table width=100%><tr><td valign=top>"; //////////main




//echo "<a href='./consola.php?mn=8&sec=movimientos&statusc=$statusc&yr=2010'>2010</a> | 2011";
echo "<table width=100% bgcolor=".$bgcolor."><tr><td align=center><font color=".$fc.">".$title."</td></tr></table>";
      $mont=12;
if (!$yr)
    {
      $yr=(date("Y")-2);
      $mo=date("m");
      }

echo "<table border=0>";
echo "<tr bgcolor=lightblue><td align=center width=10>No.</td>
<td width=10 align=center>$yr</td><td></tD><td width=10 align=center>".($yr+1)."</td><td></tD><td width=10 align=center>".($yr+2)."</td>
	</tr>";


switch ($statusc){
	case 1:$condicion=" tipomov_id=1 " ;break;
	case 2:$condicion=" tipomov_id=2 " ;break;
	case 3:$condicion=" tipomov_id=3 "; ;break;
	case 4:$condicion=" tipomov_id=14 "; break;
	case 5:$condicion=" (tipomov_id=1 or tipomov_id=14) " ;break;
	}
for ($mo=1;$mo<=$mont;$mo++){


        $query3="select sum(cantidad) as total from movimiento
            where $condicion AND fecha>='$yr-$mo-01' AND fecha<='$yr-$mo-31 11:59:59' ";
  list( $abonos) = $database->get_row( $query3 );
                       $yea=$yr+1;
        $query3="select sum(cantidad) as total from movimiento
            where $condicion AND fecha>='$yea-$mo-01' AND fecha<='$yea-$mo-31 11:59:59' ";
  list( $devoluciones) = $database->get_row( $query3 );
                       $yea=$yr+2;
        $query3="select sum(cantidad) as total from movimiento
            where $condicion AND fecha>='$yea-$mo-01' AND fecha<='$yea-$mo-31 23:59:59' ";
  list( $ventas) = $database->get_row( $query3 );
if ($cms) {$abonos=$abonos*($comision/100);$devoluciones=$devoluciones*($comision/100);$ventas=$ventas*($comision/100);}
echo "<tr><td >&nbsp;$mo</td><td align=right><font size=-1>
		<a href=./pm.php?mn=9&sec=pm_edocuenta&cms=$cms&statusc=$statusc&year=".($yea-2)."&month=$mo>$".number_format($abonos, 2, '.', '')."</a></td>";
echo "<td >&nbsp;</td><td align=right><font size=-1>
		<a href=./pm.php?mn=9&sec=pm_edocuenta&cms=$cms&statusc=$statusc&year=".($yea-1)."&month=$mo>$".number_format($devoluciones, 2, '.', '')."</a></td>";
echo "<td >&nbsp;</td><td align=right><font size=-1>
		<a href=./pm.php?mn=9&sec=pm_edocuenta&cms=$cms&statusc=$statusc&year=$yea&month=$mo>$".number_format($ventas, 2, '.', '')."</a></td></tr>";
//echo "<tr><td>&nbsp;</td></tr>";

$gtotal1+=$abonos;
$gtotal2+=$devoluciones;
$gtotal3+=$ventas;
}
if ($cms==1) {$gtotal1=$gtotal1*$comision/10;$gtotal2=$gtotal2*$comision/10;$gtotal3=$gtotal3*($comision/10);}
echo "<tr><td></td><td align=right style='border-top:2px solid black'>".number_format($gtotal1, 2, '.', '')."</td>
    <td></td><td align=right style='border-top:2px solid black'> ".number_format($gtotal2, 2, '.', '')."</td>
    <td></td><td align=right style='border-top:2px solid black'> ".number_format($gtotal3, 2, '.', '')."</td>
    </tr>";
echo "</table>";



  echo "</td><td> &nbsp;&nbsp;&nbsp;</td><td valign=top style='border:1px solid black'>";
////////////////////////////////////////////////////////detalle mes
	echo "&nbsp;&nbsp;Resumen por Semanas";	

if (!$month)
	{$show_month=date('m');$show_year=date('Y');}
	else {$show_month=$month;$show_year=$year;}
echo "<center>";
echo numerotomes($show_month)." [".$show_year."]";
echo "</center>";
if (!$month || !$year){ $year=date("Y");$month=date("m");}

	
	$semana = date('W', mktime(0,0,0,$month,1,$year));
	$dia = date('w', mktime(0,0,0,$month,1,$year))."<br><br>";
	if ($dia<3 ) {
		$date_py=$month."/1/".$year;
		$date_begin= date("m/d/Y",strtotime("last sunday",strtotime($date_py) ));
		$date_end= date("m/d/Y",strtotime("next week",strtotime($date_begin) ));
		}
	if ($dia>=3)
		{
		$date_py=$month."/1/".$year;
                $date_begin= date("m/d/Y",strtotime("next sunday",strtotime($date_py) ));
                $date_end= date("m/d/Y",strtotime("next week",strtotime($date_begin) ));
		}
	if ($dia==0)
                {
                $date_begin=$month."/1/".$year;
                //echo $date_begin= date("m-d-Y",strtotime("next sunday",strtotime($date_py) ));
                $date_end= date("m/d/Y",strtotime("next week",strtotime($date_begin) ));
                }



echo "<table border=0 width=650>";
echo "<tr bgcolor=lightblue><td width=100></td><td align=center>Do</td>
        <td>Lu</td><td>Ma</td><td align=center >Mi</td><td >Ju</td><td>Vi</td><td>Sa</td><td width=100 align=right>Total</td></tr>";



for ($j=0;$j<5;$j++)
 {



//echo "<table border=1 width=650>";
echo "<tr bgcolor=lightblue><td width=100>$date_begin </td>";


  list($t_mes,$t_dia,$t_anio) = explode('/', $date_begin);
   $fecha_temp=array($t_anio,$t_mes,$t_dia);
	
	$fecha_temp=implode('/',$fecha_temp);
for ($di=0;$di<7;$di++){
$siguiente_dia= date('d', strtotime('+'.$di.' days', strtotime($fecha_temp)));

echo "<td align=center><font size=-1>$siguiente_dia </td>";
}



//        $query3="select nombre,apellidop, apellidom,movimiento.usuario_id,movimiento_id,movimiento.fecha,cantidad,movimiento.admin_id 
//	from movimiento,usuario";

	 $query3="select sum(cantidad) as cantidad from movimiento ";
        if ($statusc){
         $query3.=" AND tipomov_id=14 "; //.$statusc;
                   }
         $query3.=" AND movimiento.fecha>='".date_db_cmp($date_begin)."' AND movimiento.fecha<'".date_db_cmp($date_end)."' 
	   Order by movimiento.fecha ASC";

        $result3=mysql_query($query3);
	$row3=mysql_fetch_array($result3);

        $num_results3=mysql_num_rows($result3);
	 if (($semana+$j)>51) $semana=1-$j;
	echo "<tr>";
        echo "<td align=center bgcolor=cccccc><font size=-2 color=blue>$date_begin ".($semana+$j)."</a></td>";


///////////////////////////date begin per week

$total=0;
$date_single=$date_begin;
       for ($m=0;$m<7;$m++)
        {

	$query4="select sum(cantidad) as cantidad from movimiento";
        if ($statusc){
         $query4.=" AND tipomov_id=".$statusc;
                   }
          $query4.=" AND movimiento.fecha='".date_db_cmp($date_single)."' ";

        $result4=mysql_query($query4);
        $row4=mysql_fetch_array($result4);
  list( $cantidad) = $database->get_row( $query3 );


	    $num1=strval($row3['precio']);
    	$num2=strval($row3['precio']*$porcentaje/100);
	    $num=$num1-$num2;

	 if (!$swdet){
		if ($row4['cantidad']<=0) 
	{$fsi="-1";$bgcolor_cantidad="#DAE8EB";$text_color="black";} else {$fsi="-1";$bgcolor_cantidad="#7B9DBA";
			$text_color="white";}
	echo "<td align=right width=60 bgcolor='$bgcolor_cantidad'><font color=$text_color size=$fsi>
		<a href=pm.php?mn=9&sec=$sec&cms=$cms&statusc=$statusc&year=$year&month=$month&fecha_det=$date_single ><b>".number_format($cantidad, 2, '.', '')."</a> </td>";
                  }
	$total+=$row4['cantidad'];
      $date_single= date("m/d/Y",strtotime("next day",strtotime($date_single) ));

	   }

	

echo "<td align=right bgcolor=dddddd><font size=-1>$ ".$total." $date_end</td>";
$gtotals+=$total;
//echo "</table>";

$date_begin= date("m/d/Y",strtotime("+1 week",strtotime($date_begin) ));
$date_end= date("m/d/Y",strtotime("+1 week",strtotime($date_begin) ));
echo "</tr>";
	}




echo "</table>";


//////////////////////



echo "</td></tr>";


$query4="select sum(cantidad) as cantidad from movimiento,usuario
        where  movimiento.usuario_id=usuario.usuario_id AND usuario.cliente_id=$cliente_id";
        if ($statusc){
         $query4.=" AND tipomov_id=".$statusc;
                   }
          $query4.=" AND movimiento.fecha<'$year/$month/1' AND movimiento.fecha>='$year/01/01' ";

        $result4=mysql_query($query4);
	$row4=mysql_fetch_array($result4);
	$promedio=($row4['cantidad']/($semana-1));
echo "<tr><td colspan=2> </td><td align=right >Promedio por semana a superar: $".number_format($promedio, 2, '.', '')." ---  Total:$ $gtotals</td></tr>";


echo "<tr><td></td><td></td><td>";


//////////////////////////////////////////////////listado diario

echo "<table width=100% bgcolor=gray><tr><td>Listado</td></tr></table>";

echo "</td></tr><tr><td></td><td></td><td>";
	echo "<table width=100% >";
	$ndia=fechatonumerodia(date_db_cmp($fecha_det))	;
  $query4="select concat (apellidop,' ',apellidom,' ',nombre) as nombres,diacobro_id from usuario
        where   usuario.cliente_id=$cliente_id AND total<>0 AND activo=1  ";
        //AND movimiento.fecha='".date_db_cmp($fecha_det)."' ";
        
         //	$query4.=" AND tipomov_id=".$statusc;
                   
            $query4.=" AND usuario.diacobro_id='".$ndia."' ";
            $query4=" SELECT DISTINCT *
FROM cliente AS c, movimiento AS m
WHERE c.cliente_id = m.cliente_id
AND c.cliente_id NOT IN (
 SELECT cliente_id
 FROM movimiento AS m
 WHERE m.fecha = ".date_db_cmp($fecha_det)."
) and c.saldo>0 group by c.cliente_id";

          echo  $query4=" SELECT DISTINCT concat(nombre,' ',apellidop,' ',apellidom) as nombres,abono
FROM usuario AS c, movimiento AS m
WHERE c.usuario_id = m.usuario_id
AND c.usuario_id NOT IN (
 SELECT usuario_id
 FROM movimiento AS m
 WHERE m.fecha = '".date_db_cmp($fecha_det)."' 
) and c.total>0 ANd c.ruta_id=1 AND c.cliente_id=491 and c.diacobro_id=$ndia  group by c.usuario_id";



	$renglones=0;
if ($fecha_det){
        $result4=mysql_query($query4);	
	$renglones=mysql_num_rows($result4);
}

	for ($m=0;$m<$renglones;$m++){
	$row4=mysql_fetch_array($result4);
	echo "<tr>";
            $num1=strval($row3['precio']);
        $num2=strval($row3['precio']*$porcentaje/100);
            $num=$num1-$num2;

         if (!$swdet){
                if ($m%2)
	{$fsi="-1";$bgcolor_cantidad="#DAE8EB";$text_color="black";} else {$fsi="-1";$bgcolor_cantidad="#7B9DBA";
                        $text_color="white";}
        echo "<td width=10>".($m+1)."</td><td bgcolor='$bgcolor_cantidad'><font color=$text_color size=$fsi>
                ".$row4['nombres']." </td>";
	echo "<td align=right width=60 bgcolor='$bgcolor_cantidad'><font color=$text_color size=$fsi>
                <b>".number_format($row4['abono'], 2, '.', '')." </td>";

                  }
        $total2+=$row4['abono'];
      $date_single= date("m/d/Y",strtotime("next day",strtotime($date_single) ));

	echo "<tr>";
	}
echo "<tr><td></td><td></td><td align=right>$total2</td></tr>";
echo "</table>";


//echo "</td></table>";






//echo "</td></tr></table>" ;

//echo "</td></tr>
//<tr><td >Total:$ $gtotal</td></tr>

//</table>";



///////////////////////////////////////////////////listado 2
$total2=0;
echo "<table width=100% bgcolor=gray><tr><td>Listado</td></tr></table>";

echo "</td></tr><tr><td></td><td></td><td>";
	echo "<table width=100% >";
  $query4="select concat (nombre,' ',apellidop,' ',apellidom) as nombres,abono,cantidad from movimiento,usuario
        where  movimiento.usuario_id=usuario.usuario_id AND usuario.cliente_id=$cliente_id";
        
         $query4.=" AND tipomov_id=".$statusc;
                   
          $query4.=" AND movimiento.fecha='".date_db_cmp($fecha_det)."' ";
	$renglones=0;
if ($fecha_det){
        $result4=mysql_query($query4);	
	$renglones=mysql_num_rows($result4);
}

	for ($m=0;$m<$renglones;$m++){
	$row4=mysql_fetch_array($result4);
	echo "<tr>";
            $num1=strval($row3['precio']);
        $num2=strval($row3['precio']*$porcentaje/100);
            $num=$num1-$num2;

         if (!$swdet){
                if ($m%2)
	{$fsi="-1";$bgcolor_cantidad="#DAE8EB";$text_color="black";} else {$fsi="-1";$bgcolor_cantidad="#7B9DBA";
                        $text_color="white";}
        echo "<td width=10>".($m+1)."</td><td bgcolor='$bgcolor_cantidad'><font color=$text_color size=$fsi>
                ".$row4['nombres']." </td>";
	echo "<td align=right width=60 bgcolor='$bgcolor_cantidad'><font color=$text_color size=$fsi>
                <b>".number_format($row4['abono'], 2, '.', '')." </td>";
	echo "<td align=right width=60 bgcolor='$bgcolor_cantidad'><font color=$text_color size=$fsi>
                <b>".number_format($row4['cantidad'], 2, '.', '')." </td>";

                  }
		 $total_abono+=$row4['abono'];
        $total2+=$row4['cantidad'];
      $date_single= date("m/d/Y",strtotime("next day",strtotime($date_single) ));

	echo "<tr>";
	}
echo "<tr><td></td><td></td><td>$total_abono</td><td align=right>$total2</td></tr>";
echo "</table>";


echo "</td></table>";






echo "</td></tr></table>" ;

//echo "</td></tr>
//<tr><td >Total:$ $gtotal</td></tr>

//</table>";



?>
