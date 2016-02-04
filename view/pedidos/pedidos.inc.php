<?php
require_once "pedidos.src.php";
echo $realpath."<br>";
?>


<div class="row-fluid ">
<?php
show_pedidos();

?>
</div>

<?php echo "<a href=\"#\" onclick=\"showData('click','view/pedidos/pedidos_example.php','?var=1')\" class=\"btn-setting\">click aqui</a>"; ?>
<div id="click"></div>