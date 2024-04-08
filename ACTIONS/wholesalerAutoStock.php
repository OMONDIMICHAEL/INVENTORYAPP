<?php
session_start();
require("../CONNECTIONS/inventoryConnection.php");
require("../FUNCTIONS/wholesalerFunction.php");
if ($conn == null) {
    echo("check your database connection");
} else {
    $productId = $_GET['productId'];

if (isset($_POST['submit'])) {
    $wholesalerDetails = loginDetails($conn);
    $wholesalerName = $wholesalerDetails['wholesalerName'];
    $wholesalerEmail = $wholesalerDetails['wholesalerEmail'];
    $wholesalerPhone = $wholesalerDetails['wholesalerPhone'];
    $orderStatus = "Not Confirmed";
    $productName = filter_var($_POST['productName'], FILTER_SANITIZE_STRING);
    $remainingStock = filter_var($_POST['remainingStock'], FILTER_SANITIZE_STRING);
    $quantityToReorder = filter_var($_POST['quantityToReorder'], FILTER_SANITIZE_STRING);
    $supplierName = filter_var($_POST['supplierName'], FILTER_SANITIZE_STRING);
    $reorderDescription = filter_var($_POST['reorderDescription'], FILTER_SANITIZE_STRING);
    $lookWholesalerProductId = $conn->prepare("SELECT * FROM inventory.wholesalerProduct WHERE wholesalerProduct.productId = :productId AND wholesalerProduct.productName = :productName AND wholesalerProduct.wholesalerName = :wholesalerName");
    $lookWholesalerProductId->bindParam(':wholesalerName', $wholesalerName);
    $lookWholesalerProductId->bindParam(':productName', $productName);
    $lookWholesalerProductId->bindParam(':productId', $productId);
    $lookWholesalerProductId->execute();
    $lookWholesalerProductId->rowCount();
    foreach ($lookWholesalerProductId->fetchAll(PDO::FETCH_ASSOC) as $fetchedWholesalerProductAuto)
    $autoOrderId = $fetchedWholesalerProductAuto['orderId'];
    $enableReorder = $conn->prepare("INSERT INTO inventory.wholesalerAutoStock(orderId,productId,productName,remainingStock,quantityToReorder,reorderDescription,supplierName,wholesalerName) VALUES(:orderId,:productId,:productName,:remainingStock,:quantityToReorder,:reorderDescription,:supplierName,:wholesalerName)");
    $enableReorder->bindParam(':orderId',$autoOrderId, PDO::PARAM_INT);
    $enableReorder->bindParam(':productId',$productId, PDO::PARAM_INT);
    $enableReorder->bindParam(':productName',$productName, PDO::PARAM_STR);
    $enableReorder->bindParam(':remainingStock',$remainingStock, PDO::PARAM_INT);
    $enableReorder->bindParam(':quantityToReorder',$quantityToReorder, PDO::PARAM_INT);
    $enableReorder->bindParam(':reorderDescription',$reorderDescription, PDO::PARAM_STR);
    $enableReorder->bindParam(':supplierName',$supplierName, PDO::PARAM_STR);
    $enableReorder->bindParam(':wholesalerName',$wholesalerName, PDO::PARAM_STR);
    $enableReorder->execute();
    ?>
    <script>
        alert("Successfully enabled an auto re-order to <?php echo $supplierName; ?>")
        location="../WHOLESALER/inventoryIndex.php"
    </script>
    <?php
    die;
}
}
?>