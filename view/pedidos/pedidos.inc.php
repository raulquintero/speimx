<?php
require_once "pedidos.src.php";
?>


<div class="row-fluid ">
<?php
show_pedidos();

?>
</div>

<?php echo "<a href=\"#\" onclick=\"showData('pedidos','view/pedidos/pedidos.php','?var=1')\" class=\"btn-setting\">click aqui</a>"; ?>
<div id="pedidos"></div>