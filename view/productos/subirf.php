<?php


if( $_POST['f']=="a"){
$target_path = "../../productos/";
    //obtenemos la extension del archivo
    $nombre = substr(strrchr($_FILES['uploadedfile']['name'], "."), 1);
    $nombre = $_POST['prid'].$_POST['color_id']."_p.jpg";
      echo "Nombre: " . $_FILES['uploadedfile']['name'] . "<br>";
      echo "Nombre: " . $nombre . "<br>";
	  echo "Tipo: " . $_FILES['uploadedfile']['type'] . "<br>";
	  echo "Tamaño: " . ($_FILES["uploadedfile"]["size"] / 1024) . " kB<br>";
	  echo "Carpeta temporal: " . $_FILES['uploadedfile']['tmp_name'];
$target_path = $target_path . basename( $nombre);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
    {
          header("location: /index.php?data=productos&op=inventario&prid=".$_POST['prid']."&coid=".$_POST['color_id']);
        //echo "El archivo ". basename( $_FILES['uploadedfile']['name']). " ha sido subido";
    }
    else
    {
    echo "Ha ocurrido un error, trate de nuevo!";
    }
}

?>