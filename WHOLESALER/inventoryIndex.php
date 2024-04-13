<?php
session_start();
require("../CONNECTIONS/inventoryConnection.php");
require("../FUNCTIONS/wholesalerFunction.php");
if (!isset($_SESSION['wholesalerId'])) {
    session_destroy();
    session_unset();
    ?>
    <script>
        location.href = "wholesalerLogin.php";
    </script>
    <?php
    $conn = null;
}
$wholesalerDetails = loginDetails($conn);
$wholesalerLoginId = $wholesalerDetails['wholesalerId'];
$wholesalerName = $wholesalerDetails['wholesalerName'];
$wholesalerEmail = $wholesalerDetails['wholesalerEmail'];
$wholesalerPhone = $wholesalerDetails['wholesalerPhone'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="mikemike3662@gmail.com">
    <meta name="description" content="inventory web app">
    <title>Inventory App</title>
</head>
<link rel="icon" href="../IMAGES/title.jpg" type="image/x-icon">
    <link rel="preload" href="../JAVASCRIPT/inventoryIndex.js" as="script">
<body>
    <?php require("../HEADER/wholesalerHeader.php"); ?>
    <main>
        <article id="mainArt">
            <article id="mainArt1">
                <section id="mainArtSec1">
                    <button class="sidebarBtn" id="inventoryTrackingBtn">
                        <img src="../IMAGES/inventoryTracking.jpg" alt="sidebar image" class="sidebarImage" loading="lazy"><br>
                        Inventory tracking.
                    </button>
                    <button class="sidebarBtn" id="wholesalerSalesAndOrderBtn">
                        <img src="../IMAGES/salesAndOrder.jpg" alt="sidebar image" class="sidebarImage" loading="lazy"><br>
                        Sales and Order Management.
                    </button>
                    <button class="sidebarBtn" id="reportingAndAnalyticsBtn">
                        <img src="../IMAGES/reportingAndAnalytics.jpg" alt="sidebar image" class="sidebarImage" loading="lazy"><br>
                        Reporting and Analytics.
                    </button>
                    <button class="sidebarBtn" id="accountingSystemBtn">
                        <img src="../IMAGES/accountingSystem.jpg" alt="sidebar image" class="sidebarImage" loading="lazy"><br>
                        Accounting System.
                    </button>
                </section>
            </article>
            <article id="mainArt2">
                <section id="mainArtSec2">
                    <section id="supplierProductTitle">
                        <center>AVAILABLE STOCK ITEMS.</center>
                    </section>
                    <section id="supplierProductSecGrid">
                        <?php
                            // check for product details in wholesalerProduct and store in arrays
                            $orderStatus = "Not Confirmed";
                            $checkProductIds = $conn->prepare("SELECT * FROM inventory.wholesalerProduct WHERE wholesalerProduct.wholesalerName = :wholesalerName");
                            $checkProductIds->bindParam(':wholesalerName', $wholesalerName);
                            $checkProductIds->execute();
                            $wholesalerNumVals = array();
                            $orderIdVals = array();
                            $productIdVals = array();
                            $productNameVals = array();
                            $currentWholesalerStockAmountVals = array();
                            $quantityDescriptionVals = array();
                            $oderDateVals = array();
                            $supplierNameVals = array();
                            $orderStatusVals = array();
                            $productSellingPriceVals = array();
                            while ($fetchedProductDetails = $checkProductIds->fetch(PDO::FETCH_ASSOC)) {
                                $wholesalerNumVals[] = ($fetchedProductDetails['wholesalerNum']);
                                $orderIdVals[] = intval($fetchedProductDetails['orderId']);
                                $productIdVals[] = intval($fetchedProductDetails['productId']);
                                $productNameVals[] = ($fetchedProductDetails['productName']);
                                $currentWholesalerStockAmountVals[] = intval($fetchedProductDetails['quantityOrdering']);
                                $quantityDescriptionVals[] = ($fetchedProductDetails['quantityDescription']);
                                $oderDateVals[] = ($fetchedProductDetails['oderDate']);
                                $supplierNameVals[] = ($fetchedProductDetails['supplierName']);
                                $orderStatusVals[] = ($fetchedProductDetails['orderStatus']);
                                $productSellingPriceVals[] = intval($fetchedProductDetails['productSellingPrice']);
                            }
                            $productDetailsArr = array_merge([$wholesalerNumVals],[$orderIdVals],[$productIdVals],[$productNameVals],[$currentWholesalerStockAmountVals],[$quantityDescriptionVals],[$oderDateVals],[$supplierNameVals],[$orderStatusVals],[$productSellingPriceVals]);
                            foreach ($productDetailsArr[0] as $productDetailsArrindex => $wholesalerNumInArr) {
                                $orderIdInArr = $productDetailsArr[1][$productDetailsArrindex];
                                $productIdInArr = $productDetailsArr[2][$productDetailsArrindex];
                                $productNameInArr = $productDetailsArr[3][$productDetailsArrindex];
                                $currentWholesalerStockAmountInArr = $productDetailsArr[4][$productDetailsArrindex];
                                $quantityDescriptionInArr = $productDetailsArr[5][$productDetailsArrindex];
                                $oderDateInArr = $productDetailsArr[6][$productDetailsArrindex];
                                $supplierNameInArr = $productDetailsArr[7][$productDetailsArrindex];
                                $orderStatusInArr = $productDetailsArr[8][$productDetailsArrindex];
                                $productSellingPriceInArr = $productDetailsArr[9][$productDetailsArrindex];
                                // get auto stock rules
                                $getWholesalerAutoStockInfo = $conn->prepare("SELECT * FROM inventory.wholesalerAutoStock WHERE wholesalerAutoStock.productId = :productId AND wholesalerAutoStock.wholesalerName = :wholesalerName AND wholesalerAutoStock.productName = :productName");
                                $getWholesalerAutoStockInfo->bindParam(':wholesalerName', $wholesalerName, PDO::PARAM_STR);
                                $getWholesalerAutoStockInfo->bindParam(':productId', $productIdInArr, PDO::PARAM_INT);
                                $getWholesalerAutoStockInfo->bindParam(':productName', $productNameInArr, PDO::PARAM_STR);
                                $getWholesalerAutoStockInfo->execute();
                                $getWholesalerAutoStockInfo->rowCount();
                                $autoReorderNum = array();
                                $autoOrderId = array();
                                $autoProductId = array();
                                $autoProductName = array();
                                $autoRemainingStock = array();
                                $autoQuantityToReorder = array();
                                $autoReorderDescription = array();
                                $autoSupplierName = array();
                                while ($wholesalerAutos = $getWholesalerAutoStockInfo->fetch(PDO::FETCH_ASSOC)){
                                    $autoReorderNum[] = ($wholesalerAutos['reOrderNum']);
                                    $autoProductId[] = ($wholesalerAutos['productId']);
                                    $autoRemainingStock[] = ($wholesalerAutos['remainingStock']);
                                    $autoProductName[] = $wholesalerAutos['productName'];
                                    $autoQuantityToReorder[] = ($wholesalerAutos['quantityToReorder']);
                                    $autoReorderDescription[] = $wholesalerAutos['reorderDescription'];
                                    $autoSupplierName[] = $wholesalerAutos['supplierName'];
                                    $autoOrderId[] = ($wholesalerAutos['orderId']);
                                }
                                $autoProductDetailsArr = array_merge([$autoReorderNum],[$autoOrderId],[$autoProductId],[$autoProductName],[$autoRemainingStock],[$autoQuantityToReorder],[$autoReorderDescription],[$autoSupplierName]);
                                foreach ($autoProductDetailsArr[0] as $autoProductDetailsArrIndex => $autoReorderNumInArr){
                                    $autoOrderIdInArr = $autoProductDetailsArr[1][$autoProductDetailsArrIndex];
                                    $autoProductIdInArr = $autoProductDetailsArr[2][$autoProductDetailsArrIndex];
                                    $autoProductNameInArr = $autoProductDetailsArr[3][$autoProductDetailsArrIndex];
                                    $autoRemainingStockInArr = $autoProductDetailsArr[4][$autoProductDetailsArrIndex];
                                    $autoQuantityToReorderInArr = $autoProductDetailsArr[5][$autoProductDetailsArrIndex];
                                    $autoReorderDescriptionInArr = $autoProductDetailsArr[6][$autoProductDetailsArrIndex];
                                    $autoSupplierNameInArr = $autoProductDetailsArr[7][$autoProductDetailsArrIndex];
                                    $updateSupplierProducts = $conn->prepare("SELECT * FROM inventory.supplierProduct WHERE supplierProduct.productId = :productId");
                                    $updateSupplierProducts->bindParam(':productId', $autoProductIdInArr, PDO::PARAM_INT);
                                    $updateSupplierProducts->execute();
                                    $supplierProductNum = array();
                                    $supplierProductId = array();
                                    $supplierProductName = array();
                                    $supplierProductQuantity = array();
                                    $supplierProductDescription = array();
                                    $supplierProductSellingPrice = array();
                                    $supplierProductSellingPriceDescription = array();
                                    $supplierProductDate = array();
                                    $supplierProductTerms = array();
                                    $supplierProductSupplierName = array();
                                    while ($fetchedSupplierProduct = $updateSupplierProducts->fetch(PDO::FETCH_ASSOC)) {
                                        $supplierProductNum[] = ($fetchedSupplierProduct['productNum']);
                                        $supplierProductId[] = ($fetchedSupplierProduct['productId']);
                                        $supplierProductName[] = ($fetchedSupplierProduct['productName']);
                                        $supplierProductQuantity[] = ($fetchedSupplierProduct['productQuantity']);
                                        $supplierProductDescription[] = ($fetchedSupplierProduct['productDescription']);
                                        $supplierProductSellingPrice[] = ($fetchedSupplierProduct['productSellingPrice']);
                                        $supplierProductSellingPriceDescription[] = ($fetchedSupplierProduct['sellingPriceDescription']);
                                        $supplierProductDate[] = ($fetchedSupplierProduct['productDate']);
                                        $supplierProductTerms[] = ($fetchedSupplierProduct['productTerms']);
                                        $supplierProductSupplierName[] = ($fetchedSupplierProduct['supplierName']);
                                    }
                                    $supplierProductDetailsArr = array_merge([$supplierProductNum],[$supplierProductId],[$supplierProductName],[$supplierProductQuantity],[$supplierProductDescription],[$supplierProductSellingPrice],[$supplierProductSellingPriceDescription],[$supplierProductDate],[$supplierProductTerms],[$supplierProductSupplierName]);
                                    foreach ($supplierProductDetailsArr[0] as $supplierProductDetailsArrIndex => $supplierProductNumInArr){
                                        $supplierProductIdInArr = $supplierProductDetailsArr[1][$supplierProductDetailsArrIndex];
                                        $supplierProductNameInArr = $supplierProductDetailsArr[2][$supplierProductDetailsArrIndex];
                                        $supplierProductQuantityInArr = $supplierProductDetailsArr[3][$supplierProductDetailsArrIndex];
                                        $supplierProductDescriptionInArr = $supplierProductDetailsArr[4][$supplierProductDetailsArrIndex];
                                        $supplierProductSellingPriceInArr = $supplierProductDetailsArr[5][$supplierProductDetailsArrIndex];
                                        $supplierProductSellingPriceDescriptionInArr = $supplierProductDetailsArr[6][$supplierProductDetailsArrIndex];
                                        $supplierProductDateInArr = $supplierProductDetailsArr[7][$supplierProductDetailsArrIndex];
                                        $supplierProductSupplierNameInArr = $supplierProductDetailsArr[8][$supplierProductDetailsArrIndex];
                                        $supplierRemainingQuantity = $supplierProductQuantityInArr - $autoQuantityToReorderInArr;
                                        if ($currentWholesalerStockAmountInArr < $autoRemainingStockInArr) {
                                            $updateSupplierProduct = $conn->prepare("UPDATE inventory.supplierProduct SET supplierProduct.productQuantity = :productQuantity WHERE supplierProduct.productNum = :productNum");
                                            $updateSupplierProduct->bindParam(':productQuantity', $supplierRemainingQuantity, PDO::PARAM_INT);
                                            $updateSupplierProduct->bindParam(':productNum', $supplierProductNumInArr, PDO::PARAM_INT);
                                            $updateSupplierProduct->execute();
                                            $makeWholesalerOder = $conn->prepare("INSERT INTO inventory.wholesalerOrder(orderId,productId,productName,quantityOrdering,quantityDescription,wholesalerName,supplierName,orderStatus,wholesalerEmail,wholesalerPhone,productSellingPrice) VALUES(:orderId,:productId,:productName,:quantityOrdering,:quantityDescription,:wholesalerName,:supplierName,:orderStatus,:wholesalerEmail,:wholesalerPhone,:productSellingPrice)");
                                            $makeWholesalerOder->bindParam(':orderId',$autoOrderIdInArr);
                                            $makeWholesalerOder->bindParam(':productId',$autoProductIdInArr);
                                            $makeWholesalerOder->bindParam(':productName',$autoProductNameInArr);
                                            $makeWholesalerOder->bindParam(':quantityOrdering',$autoQuantityToReorderInArr);
                                            $makeWholesalerOder->bindParam(':quantityDescription',$autoReorderDescriptionInArr);
                                            $makeWholesalerOder->bindParam(':wholesalerName',$wholesalerName);
                                            $makeWholesalerOder->bindParam(':supplierName',$autoSupplierNameInArr);
                                            $makeWholesalerOder->bindParam(':orderStatus',$orderStatus);
                                            $makeWholesalerOder->bindParam(':wholesalerEmail',$wholesalerEmail, PDO::PARAM_STR);
                                            $makeWholesalerOder->bindParam(':wholesalerPhone',$wholesalerPhone, PDO::PARAM_STR);
                                            $makeWholesalerOder->bindParam(':productSellingPrice',$supplierProductSellingPriceInArr);
                                            $makeWholesalerOder->execute();
                                            $newWholesalerProductQuantity = $currentWholesalerStockAmountInArr + $autoQuantityToReorderInArr;
                                            $updateWholesalerProduct = $conn->prepare("UPDATE inventory.wholesalerProduct SET wholesalerProduct.quantityOrdering = :newWholesalerProductQuantity WHERE wholesalerProduct.wholesalerNum = :wholesalerNum");
                                            $updateWholesalerProduct->bindParam(':newWholesalerProductQuantity',$newWholesalerProductQuantity);
                                            $updateWholesalerProduct->bindParam(':wholesalerNum',$wholesalerNumInArr);
                                            $updateWholesalerProduct->execute();
                                            $emailto = "mikemike3662@gmail.com";
                                            $mailSubject = "low stock,an order has been made, pay to confirm";
                                            $mailMessage = "pay the compony to complete the order";
                                            $mailHeader = "FROM:mikemike3662@yahoo.com";
                                            // mail($emailto,$mailSubject,$mailMessage,$mailHeader);
                                        }
                                    }
                                }
                                
                            }
                            $getWholesalerProducts = $conn->prepare("SELECT * FROM inventory.wholesalerProduct WHERE wholesalerProduct.wholesalerName = :wholesalerName");
                            $getWholesalerProducts->bindParam(':wholesalerName', $wholesalerName);
                            $getWholesalerProducts->execute();
                            $getWholesalerProducts->rowCount();
                            foreach ($getWholesalerProducts->fetchAll(PDO::FETCH_ASSOC) as $wholesalerProducts) {
                                echo"
                                    <section id='supplierProductSecGridItems'>
                                        <span id='secGridEnableReorderSpan'>"?><a href="wholesalerAutoStock.php?productId=<?php echo $wholesalerProducts['productId'];?>">AUTO STOCK.</a><?php echo "</span><br>
                                        <span id='secGridItemSpan'>ID:</span> ".$wholesalerProducts['productId']."<br>
                                        <span id='secGridItemSpan'>Product:</span> ".$wholesalerProducts['productName']."<br>
                                        <span id='secGridItemSpan'>Quantity Available:</span> ".$wholesalerProducts['quantityOrdering']."<br>
                                        <span id='secGridItemSpan'>Description:</span> ".$wholesalerProducts['quantityDescription']."<br>
                                        <span id='secGridItemSpan'>Selling Price:</span> ".$wholesalerProducts['productSellingPrice']."<br>
                                        <span id='secGridItemSpan'>Price Description:</span> ".$wholesalerProducts['productSellingPrice']."<br>
                                        <span id='secGridItemSpan'>Product Terms:</span> ".$wholesalerProducts['productSellingPrice']."<br>
                                        <span id='secGridItemSpan'>Supplier:</span> ".$wholesalerProducts['supplierName']."<br>
                                        <span id='secGridDisableReorderSpan'>"?><a href="wholesalerDisableAutoStock.php?productId=<?php echo $wholesalerProducts['productId'];?>">DISABLE AUTO STOCK.</a><?php echo "</span><br>
                                    </section>
                                ";
                            }
                            // if($productIdInArr > 0){
                            //     ?>
                            //     <script>
                            //         document.getElementById("secGridDisableReorderSpan").style.display = "block";
                            //         // document.getElementById("secGridDisableReorderSpan").innerHTML = $autoProductIdInArr;
                            //     </script>
                            //     <?php
                            // }
                        ?>
                    </section>
                </section>
            </article>
        </article>
    </main>
    <?php require("../FOOTER/wholesalerFooter.php"); ?>
        <article>
                <section id="sessionIdSec"><?php echo $wholesalerLoginId; ?></section>
        </article>
    <script>
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = '../CSS/inventoryIndex.css';
        document.head.appendChild(link);
    </script>
    <script src="../JAVASCRIPT/inventoryIndex.js" defer="true"></script>
</body>
</html>
