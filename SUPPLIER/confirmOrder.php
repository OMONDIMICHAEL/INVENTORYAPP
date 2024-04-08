<?php
require("../CONNECTIONS/inventoryConnection.php");
if ($conn != null) {
$orderId=$_GET['orderId'];
$supplierConfirmed = "Confirmed";
$confirmOrder = $conn->prepare("UPDATE inventory.wholesalerOrder SET wholesalerOrder.orderStatus = :supplierConfirmed WHERE wholesalerOrder.orderId = :orderId");
$confirmOrder->bindParam(':supplierConfirmed', $supplierConfirmed, PDO::PARAM_STR);
$confirmOrder->bindParam(':orderId', $orderId, PDO::PARAM_INT);
$confirmOrder->execute();
?>
<script>
    alert("Order ID <?php echo $orderId ?> Confirmed!!");
    location.href = "supplierSalesAndOrder.php";
</script>
<?php
}else {
    echo "check your connection";
}