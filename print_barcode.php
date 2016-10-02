<html>
<head>
<style>
/*body { text-align:center; }*/
body { text-align: center; } /*  td   */
h4 { margin:5px; padding:0; }

@media print
  {
   .container { width: auto !important; }
   .container h4, .container p, .container input
   .pagination { display: none; }
   /*.labels { text-align:center;font-size:10pt;page-break-after:always;padding:1px; }*/
   .labels { text-align:center;font-size:10pt;always;padding:1px; }

  }

</style>
</head>
<?php
// $query="SELECT producto from producto where producto_id='".$_GET['prid']."'";
// list( $producto) = $database->get_row( $query );
$producto=isset($_GET['producto']) ? $_GET['producto'] : '';
$talla=isset($_GET['talla']) ? $_GET['talla'] : '';
$color=isset($_GET['color']) ? $_GET['color'] : '';
?>    

<body>
<div class="container">
    <h4><?php echo $producto."<br>Talla: ".$talla." - ".$color ?></h4>
  <div class="labels">
    <img widthe=260 src="./barcode128.php?upc=<?php echo $_GET['upc']?>" alt="<?php echo $_GET['upc']?>" />
  </div>
	

</body>
</html
