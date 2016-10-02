<html>
<head>
<style>
/*body { text-align:center; }*/
td { text-align: center; }
h4 { margin:5px; padding:0; }

@media print
  {
   .container { width: auto !important; }
   .container h4, .container p, .container input
   .pagination { display: none; }
   .labels { text-align:center;font-size:10pt;page-break-after:always;padding:1px; }
  }
</style>
</head>
<?php
$query="SELECT producto from producto where producto_id='".$_GET['prid']."'";
list( $producto) = $database->get_row( $query );
?>    

<body>
<div class="container">
	<div class="labels">
	<!-- <h5><?php echo $producto ?></h5> -->
		<img widthe=260 src="./barcode128.php?upc=<?php echo $_GET['upc']?>" alt="<?php echo $_GET['upc']?>" />
	</div>
	
</div>
</body>
</html
