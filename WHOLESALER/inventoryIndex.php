<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
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
$wholesalerLogo = $wholesalerDetails['wholesalerLogo'];
$wholesalerLogoPath = $wholesalerDetails['wholesalerLogoPath'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="CIMS: Manage your inventory, find customers online, Buy products online">
    <meta name="description" content="CIMS is an inventory management system. Use it for tracking your inventory aas a wholesaler or retailer and finding customers too.It automate tasks for you like making an order for a wholesaler to the retailer if his/her products fall below a preset value. It also generates an invoice for the retailer. Customers can buy buy from different wholesalers and wholesalers can buy from different customers suppliers. It analyses the market trend for users too and calculates profit or loss, all in one place.">
    <meta name="keywords" content="cims,inventory,inventory management,inventory management system,inventory management application,retail online,wholesale online,inventory management website,cims login">
    <meta property="og:description" content="An inventory management system that automates your daily tasks">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta property="og:title" content="CIMS">
    <meta property="og:image" content="../IMAGES/title.jpg">
    <meta property="og:url" content="https://cims.auto.com">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet"/>
    <link rel="preload" href="../JAVASCRIPT/inventoryIndex.js" as="script">
    <title>CIMS</title>
    <link rel="stylesheet" href="../CSS/inventoryIndex.css">
</head>
<body>
    <?php require("../HEADER/wholesalerHeader.php"); ?>
    <main>
        <!-- Section: Links  -->
        <article class="">
            <div class="container-fluid text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- side bar grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-1">
                    <?php require("../SIDEBAR/wholesalerSideBar.php"); ?>
                </div>
                <!-- side bar grid column -->
                <!-- body grid column -->
                <div class="col-md-8 col-lg-8 col-xl-8 mx-auto mb-4" id="bodyGridDiv">
                        <div class="container-fluid text-center text-md-start mt-5">
                            <div class="" id="supplierProductSecGrid">
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

                                                }
                                            }
                                        }
                                        
                                    }

                                                    // function sendMail($wholesalerEmail,$wholesalerName,$autoSupplierNameInArr,$autoProductDetailsArr,$autoProductDetailsArrIndex,$autoProductNameInArr){
                                                    //     $mail = new PHPMailer(true);
                                                    //     try{
                                                    //         $mail->isSMTP();
                                                    //         $mail->Host = 'smtp.gmail.com';
                                                    //         $mail->SMTPAuth = true;
                                                    //         $mail->Username = 'mikemike3662@gmail.com';
                                                    //         $mail->Password = 'qwanwcfbdsudeatf';
                                                    //         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                                    //         $mail->Port = 465;
                                                    //         $mail->setFrom('mikemike3662@gmail.com', 'IMS APP');
                                                    //         $mail->addAddress($wholesalerEmail, $wholesalerName);
                                                    //         $mail->addReplyTo('mikemike3662@gmail.com', 'IMS APPLICATION');
                                                    //         $mail->isHTML(true);
                                                    //         $mail->Subject = 'LOW STOCK ALERT.';
                                                    //         $mail->Body = "<p>$autoProductNameInArr IS LOW and an order has been made for you by IMS as was provided by <b>YOU</b>. Pay <b>$autoSupplierNameInArr</b> to complete the order.</p>";
                                                            // dont uncomment below
                                                            // $body = "<p>The following products are very low</p><ul>";
                                                            // foreach ($autoProductDetailsArr[3] as $autoProductDetailsArrIndex => $autoProductNameInArr) {
                                                            //     $body .= "<li>$autoProductNameInArr<br></li>";
                                                            // }
                                                            // $mail->Body = $body;
                                                            // dont uncomment above
                                                            // $mail->AltBody = 'An order has been made for you on your product. Visit your IMS application and pay the wholesaler to complete the process.';
                                                            // $mail->send();
                                                        // } catch (Exception $e) {
                                                                // echo "mail err: {$mail->ErrorInfo}";
                                                            // }
                                                    // }
                                    // if ($updateWholesalerProduct) {
                                        // sendMail($wholesalerEmail,$wholesalerName,$autoSupplierNameInArr,$autoProductDetailsArr[3],$autoProductDetailsArrIndex,$autoProductNameInArr);
                                    // }
                                    $getWholesalerProducts = $conn->prepare("SELECT * FROM inventory.wholesalerProduct WHERE wholesalerProduct.wholesalerName = :wholesalerName");
                                    $getWholesalerProducts->bindParam(':wholesalerName', $wholesalerName);
                                    $getWholesalerProducts->execute();
                                    $getWholesalerProducts->rowCount();
                                    foreach ($getWholesalerProducts->fetchAll(PDO::FETCH_ASSOC) as $wholesalerProducts) {
                                        echo "
                                            <div class='card'>
                                                <div class='bg-image hover-overlay' data-mdb-ripple-init id='wholesalerProductImage' data-mdb-ripple-color='light'>
                                                    "?>
                                                    <img src="<?php echo $wholesalerProducts['productImagePath']; ?>" alt="<?php echo $wholesalerProductDetailsFound['productImage']; ?>" class="img-fluid"/>
                                                    <?php echo "
                                                    <a href='wholesalerProductDetails.php?productId="?><?php echo $wholesalerProducts['productId'];?><?php echo "'>
                                                        <div class='mask' style='background-color: rgba(251, 251, 251, 0.15);'></div>
                                                    </a>
                                                </div>
                                                <div class='card-body'>
                                                    <span class='card-text' id='secGridItemSpan'></span> ".$wholesalerProducts['productName']."<br>
                                                    <span class='card-text' id='secGridItemSpan'>Available:</span> ".$wholesalerProducts['quantityOrdering']."<br>
                                                    <span class='card-title' id='secGridEnableReorderSpan'>"?><a href="wholesalerProductDetails.php?productId=<?php echo $wholesalerProducts['productId'];?>">EXPLORE.</a><?php echo "</span>
                                                </div>
                                            </div>
                                        ";
                                    }
                                ?>
                            </div>
                        </div>
                </div>
                <!-- body grid column -->
                <!-- right bar grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <?php require("../RIGHTBAR/wholesalerRightBar.php"); ?>
                </div>
                <!-- right bar grid column -->
            </div>
            <!-- Grid row -->
            </div>
        </article>
    </main>
    <?php require("../FOOTER/wholesalerFooter.php"); ?>
    <script>
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = '../CSS/inventoryIndex.css';
        document.head.appendChild(link);
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
      <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="../JAVASCRIPT/inventoryIndex.js" defer="true"></script>
</body>
</html>
