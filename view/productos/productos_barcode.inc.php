
<style>
body { text-align:center; }
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


<div class="container">
  <input class=\"input-small\" id=\"".$row['inventariodet_id']."\" name=\"".$row['inventariodet_id']."\" type=\"text\" value="6">
	<div class="labels">
	<h3>Tomtto</h3>
		<img width=130 src="barcode.php?text=<?php echo $_GET['sku']?>" alt="<?php echo $_GET['sku']?>" />
	</div>
	<div class="labels">
	<h3>Tomtto</h3>
		<img width=130 src="barcode.php?text=<?php echo $_GET['sku']?>" alt="<?php echo $_GET['sku']?>" />
	</div>
	<div class="labels">
	<h3>Tomtto</h3>
		<img width=130 src="barcode.php?text=<?php echo $_GET['sku']?>" alt="<?php echo $_GET['sku']?>" />
	</div>
	<div class="labels">
	<h3>Tomtto</h3>
		<img width=130 src="barcode.php?text=<?php echo $_GET['sku']?>" alt="<?php echo $_GET['sku']?>" />
	</div>
</div>