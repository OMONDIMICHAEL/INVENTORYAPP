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
        // $orderStatus = "Not Confirmed";
        // $productName = filter_var($_POST['productName'], FILTER_SANITIZE_STRING);
        $remainingStock = filter_var($_POST['remainingStock'], FILTER_SANITIZE_STRING);
        $quantityToReorder = filter_var($_POST['quantityToReorder'], FILTER_SANITIZE_STRING);
        $supplierName = filter_var($_POST['supplierName'], FILTER_SANITIZE_STRING);
        $reorderDescription = filter_var($_POST['reorderDescription'], FILTER_SANITIZE_STRING);
        // $lookWholesalerProductId = $conn->prepare("SELECT * FROM inventory.wholesalerProduct WHERE wholesalerProduct.productId = :productId AND wholesalerProduct.productName = :productName AND wholesalerProduct.wholesalerName = :wholesalerName");
        // $lookWholesalerProductId->bindParam(':wholesalerName', $wholesalerName);
        // $lookWholesalerProductId->bindParam(':productName', $productName);
        // $lookWholesalerProductId->bindParam(':productId', $productId);
        // $lookWholesalerProductId->execute();
        // $lookWholesalerProductId->rowCount();
        // foreach ($lookWholesalerProductId->fetchAll(PDO::FETCH_ASSOC) as $fetchedWholesalerProductAuto)
        // $autoOrderId = $fetchedWholesalerProductAuto['orderId'];
        $updateReorder = $conn->prepare("UPDATE inventory.wholesalerAutoStock SET wholesalerAutoStock.remainingStock = :remainingStock, wholesalerAutoStock.quantityToReorder = :quantityToReorder, wholesalerAutoStock.reorderDescription = :reorderDescription WHERE wholesalerAutoStock.productId = :productId AND wholesalerAutoStock.wholesalerName = :wholesalerName");
        // $updateReorder->bindParam(':orderId',$autoOrderId, PDO::PARAM_INT);
        $updateReorder->bindParam(':productId',$productId, PDO::PARAM_INT);
        // $updateReorder->bindParam(':productName',$productName, PDO::PARAM_STR);
        $updateReorder->bindParam(':remainingStock',$remainingStock, PDO::PARAM_INT);
        $updateReorder->bindParam(':quantityToReorder',$quantityToReorder, PDO::PARAM_INT);
        $updateReorder->bindParam(':reorderDescription',$reorderDescription, PDO::PARAM_STR);
        // $updateReorder->bindParam(':supplierName',$supplierName, PDO::PARAM_STR);
        $updateReorder->bindParam(':wholesalerName',$wholesalerName, PDO::PARAM_STR);
        $updateReorder->execute();
        ?>
        <script>
            alert("Successfully Edited your auto re-order to <?php echo $supplierName; ?>")
            location="../WHOLESALER/inventoryIndex.php"
        </script>
        <?php
        die;
    }
}
?>