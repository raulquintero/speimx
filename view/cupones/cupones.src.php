<?php


function showCupones()
{

$database = new DB();


   echo "
        <table class=\"table table-striped table-bordered bootstrap-datatable datatable\">
            <thead>
			<tr>
                <th>&nbsp;</th>
			  <th>Cupon</th>
			  <th>Cantidad</th>
			  <th>Fecha Inicio</th>
              <th>Fecha Fin</th>
			  <th>Tipo</th>
			  <th>Opciones</th>
			</tr>
			</thead>
			<tbody>";





$query = "SELECT * from cupon,cupontipo
        where cupon.cupontipo_id=cupontipo.cupontipo_id";


	$results = $database->get_results( $query );

	$i=0;
	foreach( $results as $row )
	{

		$i+=1;
		echo "<tr>
			    <td align=right><font >&nbsp;$i&nbsp;</td>
			    <td><a href=\"/index.php?data=cupones&op=generados&bulk=".$row['bulk']."\" ><b>".($row['cupon'])."</b><a>
				    <a class=\"visible-print\" ><b>".strtoupper($row['cupon'])."</b><a>
			    </td>";



		echo "<td align=right> <font >".dinero($row['cantidad'])."&nbsp;&nbsp; </td>";

		echo "<td><font >".fechamysqltous($row['fecha_ini'])."</td>
			<td><font >".fechamysqltous($row['fecha_fin'])."</td>
			<td> <font >".strtoupper($row['cupontipo'])."</td>";
        echo "<td><button class=\"btn-primary btn-setting hidden-print\" onclick=\"showData('myModal',
                        'view/cupones/cupones_agregar.inc.php',
                        'f=editar&cuid=".$row['cupon_id']."')\">Editar</button>

                  <button class=\"btn-info    btn-setting hidden-print\" onclick=\"showData('myModal',
                        'view/cupones/cupones.php',
                        'f=generar&cuid=".$row['cupon_id']."&cupon=".$row['cupon']."&monto=".$row['cantidad']."')\">Generar</button></td>";
		echo "</tr>";


	}




    echo "  </tbody>
        </table>";

}


?>
