<?php 

//include '/config/config.php';


function combobox($campo,$var)
{

$database = new DB();

$campo_id=$campo."_id";
  								echo "<div class=\"control-group\">
								<label class=\"control-label\" for=".$campo."_id\">".ucfirst($campo)."</label>
								<div class=\"controls\">
								  <select id=".$campo."_id\" name=\"".$campo."_id\">";

								$query = "SELECT ".$campo."_id,".$campo." FROM  ".$campo." ORDER BY  ".$campo;
								//list( $colonia_casa ) = $database->get_row( $query );	
								$results = $database->get_results( $query );
								foreach( $results as $row )
								{
									if ($row[$campo_id]==$var)  $seleccionado="selected='true' "; else $seleccionado="";
    								echo "<option $seleccionado value='".$row[$campo_id]."' >".ucfirst($row[$campo])."</option>";
    							}

								echo "  </select>
								</div>
							  </div>";


								//$results = $database->get_results( $query );
}



 ?>