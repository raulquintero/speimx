<?php
$isid=isset($_POST['isid']) ? $_POST['isid'] : "";
$data=isset($_POST['data']) ? $_POST['data'] : "";
$op=isset($_POST['op']) ? $_POST['op'] : "";
$code=isset($_POST['code']) ? $_POST['code'] : "";


if( $_POST['f']=="a"){
$target_path = "../../productos/";
    //obtenemos la extension del archivo
    $nombre = substr(strrchr($_FILES['uploadedfile']['name'], "."), 1);
    $nombre = $_POST['nombre_archivo'];
      echo "Nombre: " . $_FILES['uploadedfile']['name'] . "<br>";
      echo "Nombre: " . $nombre . "<br>";
	  echo "Tipo: " . $_FILES['uploadedfile']['type'] . "<br>";
	  echo "Tamaño: " . ($_FILES["uploadedfile"]["size"] / 1024) . " kB<br>";
	  echo "Carpeta temporal: " . $_FILES['uploadedfile']['tmp_name'];
$target_path = $target_path . basename( $nombre);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
    {
          if($isid)
          $location="location: /index.php?data=$data&op=$op&isid=$isid&code=$code";
          else  
          $location="location: /index.php?data=productos&op=inventario&err=1&prid=".$_POST['prid']."&coid=".$_POST['color'];
        //echo "El archivo ". basename( $_FILES['uploadedfile']['name']). " ha sido subido";
    }
    else
    {
    echo "Ha ocurrido un error, trate de nuevo!";
    }
}

header($location);
?>