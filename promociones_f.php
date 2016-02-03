<?php

require_once ('config/config.php');
$database = new DB();

foreach( $_POST as $key => $value )
{
    $_POST[$key] = $database->filter( $value );
}

foreach( $_GET as $key => $value )
{
    $_GET[$key] = $database->filter( $value );
}
$case=isset($_GET['case']) ? $_GET['case'] : "";
$data=isset($_GET['data']) ? $_GET['data'] : "";

$temporada_id=isset($_GET['temporada_id']) ? $_GET['temporada_id'] : "";
 $database = new DB();


if ($case=="editar_porcentaje")
{
    $query = "SELECT descuento  FROM temporada where temporada_id=$temporada_id ";
    list( $porcentaje ) = $database->get_row( $query );
    echo "<form action='/functions/crud_promociones.php' method=post>";
    echo "<input type='hidden' name='data' value='$data' />";
    echo "<input type='hidden' name='func' value='u' />";
    echo "<input type='hidden' name='temporada_id' value='$temporada_id' />";
    echo "<input class='input-small' type='text' name='porcentaje' value='$porcentaje'>% <input type=\"submit\" value='Grabar' />";
    echo "</form>";

}

?>