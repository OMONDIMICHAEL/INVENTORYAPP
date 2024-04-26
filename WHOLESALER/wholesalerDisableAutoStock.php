<?php
require("../CONNECTIONS/inventoryConnection.php");
if ($conn != null) {
$productId=$_GET['productId'];
$checkIfEnrolledInAutoStock = $conn->prepare("SELECT * FROM inventory.wholesalerAutoStock WHERE wholesalerAutoStock.productId = :productId");
$checkIfEnrolledInAutoStock->bindParam(':productId',$productId, PDO::PARAM_INT);
$checkIfEnrolledInAutoStock->execute();
if ($checkIfEnrolledInAutoStock->rowCount() <= 0) {
    ?>
    <script>
        alert("Error! Can't disable this product because it is not enabled to auto-stock");
        location = "inventoryIndex.php";
        die();
    </script>
    <?php
}
$disableAutoStock = $conn->prepare("DELETE FROM inventory.wholesalerAutoStock WHERE wholesalerAutoStock.productId = :productId");
$disableAutoStock->bindParam(':productId', $productId, PDO::PARAM_INT);
$disableAutoStock->execute();
?>
<script>
    alert("Successfully disabled product of id: <?php echo $productId ?>, for auto re-order!!");
    location.href = "inventoryIndex.php";
</script>
<?php
}else {
    echo "check your connection";
}