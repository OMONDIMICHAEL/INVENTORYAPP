<?php
require("../CONNECTIONS/inventoryConnection.php");
if ($conn != null) {
    try {
        $orderId=$_GET['orderId'];
        $supplierConfirmed = "Confirmed";
        $checkIfConfirmed = $conn->prepare("SELECT * FROM inventory.wholesalerOrder WHERE wholesalerOrder.orderId = :orderId AND wholesalerOrder.orderStatus = :Confirmed");
        $checkIfConfirmed->bindParam(':orderId', $orderId,PDO::PARAM_INT);
        $checkIfConfirmed->bindParam(':Confirmed', $supplierConfirmed,PDO::PARAM_STR);
        $checkIfConfirmed->execute();
        if ($checkIfConfirmed->rowCount()>0) {
            ?>
                <script>
                    alert("Failed! The order is only confirmed once");
                    location="supplierSalesAndOrder.php";
                </script>
            <?php
            die();
        }
        $conn-> beginTransaction();
        $confirmOrderDetails = $conn->prepare("SELECT * FROM inventory.wholesalerOrder WHERE wholesalerOrder.orderId = :orderId");
        $confirmOrderDetails->bindParam(':orderId',$orderId, PDO::PARAM_INT);
        $confirmOrderDetails->execute();
        foreach ($confirmOrderDetails->fetchAll(PDO::FETCH_ASSOC) as $confirmDetails)
        $productId = $confirmDetails['productId'];
        $productName = $confirmDetails['productName'];
        $quantityOrdering = $confirmDetails['quantityOrdering'];
        $quantityDescription = $confirmDetails['quantityDescription'];
        $wholesalerName = $confirmDetails['wholesalerName'];
        $supplierName = $confirmDetails['supplierName'];
        $wholesalerEmail = $confirmDetails['wholesalerEmail'];
        $wholesalerPhone = $confirmDetails['wholesalerPhone'];
        $productSellingPrice = $confirmDetails['productSellingPrice'];
        $addSupplierSale = $conn->prepare("INSERT INTO inventory.supplierSale (orderId, productId,productName,quantityOrdering,quantityDescription,wholesalerName,supplierName,wholesalerEmail,wholesalerPhone,productSellingPrice) VALUES (:orderId,:productId,:productName,:quantityOrdering,:quantityDescription,:wholesalerName,:supplierName,:wholesalerEmail,:wholesalerPhone,:productSellingPrice)");
        $addSupplierSale->bindParam(':orderId',$orderId, PDO::PARAM_INT);
        $addSupplierSale->bindParam(':productId',$productId, PDO::PARAM_INT);
        $addSupplierSale->bindParam(':productName',$productName, PDO::PARAM_STR);
        $addSupplierSale->bindParam(':quantityOrdering',$quantityOrdering, PDO::PARAM_INT);
        $addSupplierSale->bindParam(':quantityDescription',$quantityDescription, PDO::PARAM_STR);
        $addSupplierSale->bindParam(':wholesalerName',$wholesalerName, PDO::PARAM_STR);
        $addSupplierSale->bindParam(':supplierName',$supplierName, PDO::PARAM_STR);
        $addSupplierSale->bindParam(':wholesalerEmail',$wholesalerEmail, PDO::PARAM_STR);
        $addSupplierSale->bindParam(':wholesalerPhone',$wholesalerPhone, PDO::PARAM_STR);
        $addSupplierSale->bindParam(':productSellingPrice',$productSellingPrice, PDO::PARAM_STR);
        $addSupplierSale->execute();
        $confirmOrder = $conn->prepare("UPDATE inventory.wholesalerOrder SET wholesalerOrder.orderStatus = :supplierConfirmed WHERE wholesalerOrder.orderId = :orderId");
        $confirmOrder->bindParam(':supplierConfirmed', $supplierConfirmed, PDO::PARAM_STR);
        $confirmOrder->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $confirmOrder->execute();
        $conn->commit();
        ?>
        <script>
            alert("Order ID <?php echo $orderId ?> Confirmed!!");
            location.href = "supplierSalesAndOrder.php";
        </script>
        <?php
    } catch (PDOException $ex) {
            // echo "Error: " . $ex->getMessage() . PHP_EOL;
            $conn->rollBack();
                ?>
                    <script>
                        alert("Failed! Try again");
                        location.href = "supplierSalesAndOrder.php";
                    </script>
                <?php
        }
}else {
        echo "check your connection";
    }
?>