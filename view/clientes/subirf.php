<?php


if( $_POST['f']=="a"){
$target_path = "../../fotos/";
    //obtenemos la extension del archivo
    $nombre = substr(strrchr($_FILES['uploadedfile']['name'], "."), 1);
    $nombre = $_POST['type']."_f.jpg";
      echo "Nombre: " . $_FILES['uploadedfile']['name'] . "<br>";
      echo "Nombre: " . $nombre . "<br>";
	  echo "Tipo: " . $_FILES['uploadedfile']['type'] . "<br>";
	  echo "Tamaño: " . ($_FILES["uploadedfile"]["size"] / 1024) . " kB<br>";
	  echo "Carpeta temporal: " . $_FILES['uploadedfile']['tmp_name'];
$target_path = $target_path . basename( $nombre);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
    {
          header("location: /index.php?data=clientes&op=subirfoto&cid=".$_POST['type']);
        //echo "El archivo ". basename( $_FILES['uploadedfile']['name']). " ha sido subido";
    }
    else
    {
    echo "Ha ocurrido un error, trate de nuevo!";
    }
}



/*
echo"subiir fotos<br><Br>";

if ($_FILES['archivo']["error"] > 0)
	  {
	  echo "Error: " . $_FILES['archivo']['error'] . "<br>";
	  }
	else
	  {
	  echo "Nombre: " . $_FILES['archivo']['name'] . "<br>";
	  echo "Tipo: " . $_FILES['archivo']['type'] . "<br>";
	  echo "Tamaño: " . ($_FILES["archivo"]["size"] / 1024) . " kB<br>";
	  echo "Carpeta temporal: " . $_FILES['archivo']['tmp_name'];
	  //ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos
	move_uploaded_file($_FILES['archivo']['tmp_name'],	"/var/www/html/fotos/foto.jpg");
	echo "<br><img src='/fotos/'".$_FILES['archivo']['name'].">";
}

*/
?>