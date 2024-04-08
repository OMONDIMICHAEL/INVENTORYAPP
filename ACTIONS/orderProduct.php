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
$quantityOrdering = filter_var($_POST['quantityOrdering'], FILTER_SANITIZE_STRING);
$quantityDescription = filter_var($_POST['quantityDescription'], FILTER_SANITIZE_STRING);
$supplierName = filter_var($_POST['supplierName'], FILTER_SANITIZE_STRING);
$orderId = mt_rand(10000000,100000000000);

    $products = $conn->prepare("SELECT * FROM inventory.supplierProduct WHERE supplierProduct.productId = :productId");
    $products->bindParam(':productId', $productId, PDO::PARAM_INT);
    $products->execute();
    $products->rowCount();
    foreach ($products->fetchAll(PDO::FETCH_ASSOC) as $gottenProducts)
    $productNum = $gottenProducts['productNum'];
    $productSellingPrice = $gottenProducts['productSellingPrice'];
    $productQuantity = $gottenProducts['productQuantity'];
    $supplierName = $gottenProducts['supplierName'];
    $remainingQuantity = $productQuantity - $quantityOrdering;
    $updateProduct = $conn->prepare("UPDATE inventory.supplierProduct SET supplierProduct.productQuantity = :productQuantity WHERE supplierProduct.productNum = :productNum");
    $updateProduct->bindParam(':productQuantity', $remainingQuantity, PDO::PARAM_STR);
    $updateProduct->bindParam(':productNum', $productNum, PDO::PARAM_STR);
    $updateProduct->execute();

    $addOder = $conn->prepare("INSERT INTO inventory.wholesalerOrder(orderId,productId,productName,quantityOrdering,quantityDescription,wholesalerName,supplierName,OrderStatus,wholesalerEmail,wholesalerPhone,productSellingPrice) VALUES(:orderId,:productId,:productName,:quantityOrdering,:quantityDescription,:wholesalerName,:supplierName,:orderStatus,:wholesalerEmail,:wholesalerPhone,:productSellingPrice)");
    $addOder->bindParam(':orderId',$orderId, PDO::PARAM_INT);
    $addOder->bindParam(':productId',$productId, PDO::PARAM_INT);
    $addOder->bindParam(':productName',$productName, PDO::PARAM_STR);
    $addOder->bindParam(':quantityOrdering',$quantityOrdering, PDO::PARAM_INT);
    $addOder->bindParam(':quantityDescription',$quantityDescription, PDO::PARAM_STR);
    $addOder->bindParam(':wholesalerName',$wholesalerName, PDO::PARAM_STR);
    $addOder->bindParam(':supplierName',$supplierName, PDO::PARAM_STR);
    $addOder->bindParam(':orderStatus',$orderStatus, PDO::PARAM_STR);
    $addOder->bindParam(':wholesalerEmail',$wholesalerEmail, PDO::PARAM_STR);
    $addOder->bindParam(':wholesalerPhone',$wholesalerPhone, PDO::PARAM_STR);
    $addOder->bindParam(':productSellingPrice',$productSellingPrice, PDO::PARAM_INT);
    $addOder->execute();

    $productName = $gottenProducts['productName'];
    $lookWholesalerProducts = $conn->prepare("SELECT * FROM inventory.wholesalerProduct WHERE wholesalerProduct.wholesalerName = :wholesalerName AND wholesalerProduct.productName = :productName");
    $lookWholesalerProducts->bindParam(':wholesalerName', $wholesalerName);
    $lookWholesalerProducts->bindParam(':productName', $productName);
    $lookWholesalerProducts->execute();
    $lookWholesalerProducts->rowCount();
    foreach ($lookWholesalerProducts->fetchAll(PDO::FETCH_ASSOC) as $fetchedWholesalerProduct) //{
        # code...
    // }
        $wholsalerProductRowCount = $lookWholesalerProducts->rowCount();
        if ($wholsalerProductRowCount < 1) {
        $sqlWholesalerProduct = $conn->prepare("INSERT INTO inventory.wholesalerProduct(orderId,productId,productName,quantityOrdering,quantityDescription,wholesalerName,supplierName,OrderStatus,wholesalerEmail,wholesalerPhone,productSellingPrice) VALUES(:orderId,:productId,:productName,:quantityOrdering,:quantityDescription,:wholesalerName,:supplierName,:orderStatus,:wholesalerEmail,:wholesalerPhone,:productSellingPrice)");
        $sqlWholesalerProduct->bindParam(':orderId',$orderId, PDO::PARAM_INT);
        $sqlWholesalerProduct->bindParam(':productId',$productId, PDO::PARAM_INT);
        $sqlWholesalerProduct->bindParam(':productName',$productName, PDO::PARAM_STR);
        $sqlWholesalerProduct->bindParam(':quantityOrdering',$quantityOrdering, PDO::PARAM_INT);
        $sqlWholesalerProduct->bindParam(':quantityDescription',$quantityDescription, PDO::PARAM_STR);
        $sqlWholesalerProduct->bindParam(':wholesalerName',$wholesalerName, PDO::PARAM_STR);
        $sqlWholesalerProduct->bindParam(':supplierName',$supplierName, PDO::PARAM_STR);
        $sqlWholesalerProduct->bindParam(':orderStatus',$orderStatus, PDO::PARAM_STR);
        $sqlWholesalerProduct->bindParam(':wholesalerEmail',$wholesalerEmail, PDO::PARAM_STR);
        $sqlWholesalerProduct->bindParam(':wholesalerPhone',$wholesalerPhone, PDO::PARAM_STR);
        $sqlWholesalerProduct->bindParam(':productSellingPrice',$productSellingPrice, PDO::PARAM_INT);
        $sqlWholesalerProduct->execute();
    } elseif ($wholsalerProductRowCount >= 1) {
        $wholesalerProductQuantity = $fetchedWholesalerProduct['quantityOrdering'];
        $remainingWholesalerQuantity = $wholesalerProductQuantity + $quantityOrdering;
        $updateWholesalerProduct = $conn->prepare("UPDATE inventory.wholesalerProduct SET wholesalerProduct.quantityOrdering = :newQuantity WHERE wholesalerProduct.productName = :productName AND wholesalerProduct.wholesalerName = :wholesalerName");
        $updateWholesalerProduct->bindParam(':newQuantity', $remainingWholesalerQuantity, PDO::PARAM_INT);
        $updateWholesalerProduct->bindParam(':productName', $productName, PDO::PARAM_STR);
        $updateWholesalerProduct->bindParam(':wholesalerName', $wholesalerName, PDO::PARAM_STR);
        $updateWholesalerProduct->execute();
    }
    
    
    ?>
    <script>
        alert("Successfully made an order to <?php echo $supplierName; ?>")
        location="../WHOLESALER/mySalesAndOrder.php"
    </script>
    <?php
    die;
}
}
?>