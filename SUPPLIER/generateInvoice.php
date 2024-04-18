<?php
session_start();
require("../CONNECTIONS/inventoryConnection.php");
require("../FUNCTIONS/supplierFunction.php");
if (!isset($_SESSION['supplierId'])) {
    session_destroy();
    session_unset();
    ?>
    <script>
        location.href = "supplierLogin.php";
    </script>
    <?php
    $conn = null;
}
$supplierDetails = loginDetails($conn);
$loginId = $supplierDetails['supplierId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="mikemike3662@gmail.com">
    <meta name="description" content="inventory web app">
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet"/>
    <link rel="icon" href="../IMAGES/title.jpg" type="image/x-icon">
    <link rel="preload" href="../JAVASCRIPT/inventoryIndex.js" as="script">
    <title>Inventory App</title>
</head>
<body>
    <?php require("../HEADER/supplierHeader.php"); ?>
    <main>
        <article id="mainArt">
            <article id="mainArt1">
                <section id="mainArtSec1">
                    <button class="sidebarBtn" id="supplierInventoryTrackingBtn">
                        <img src="../IMAGES/inventoryTracking.jpg" alt="sidebar image" class="sidebarImage" loading="lazy"><br>
                        Inventory tracking.
                    </button>
                    <button class="sidebarBtn" id="salesAndOrderBtn">
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
                    <button id="downloadInvoiceBtn" type="button">DOWNLOAD.</button>
    <?php
            $orderId = $_GET['orderId'];
            $confirmSaleDetails = $conn->prepare("SELECT * FROM inventory.wholesalerOrder WHERE wholesalerOrder.orderId = :orderId");
            $confirmSaleDetails->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $confirmSaleDetails->execute();
            $confirmSaleDetails->rowCount();
            // $Id = 0;
            foreach ($confirmSaleDetails->fetchAll(PDO::FETCH_ASSOC) as $saleGotten);
            
            $productId = $saleGotten['productId'];
            // $Id += $productId;
            $productSellingPrice = filter_var($saleGotten['productSellingPrice'], FILTER_VALIDATE_INT);
            $productQuantity = $saleGotten['quantityOrdering'];
            $productInvoiceCost = ($productSellingPrice * $productQuantity);
            $orderStatus = $saleGotten['orderStatus'];
            $wholesalerName = $saleGotten['wholesalerName'];
    ?>
                    <table id="supplierInvoice">
                        <caption>
                            <p style="font-size:34px;font-weight:bold;" colspan="5">
                                <center>PRODUCT ID#<span style="color:red;"><?php echo $prodId; ?></span></center>
                            </p>
                        </caption>
                        <thead>
                            <tr style="background-color:grey;color:blue;">
                                <th rowspan="3" colspan="2">
                                    Compony Name:<br>
                                    <?php echo $saleGotten['supplierName'] ?><br>
                                    Compony Contact:<br>
                                    <?php echo $supplierDetails['supplierEmail'] ?><br>
                                    <?php echo $supplierDetails['supplierPhone'] ?>
                                </th>
                            </tr>
                            <tr style="background-color:tomato;color:snow;">
                                <th colspan="2" rowspan="2">
                                    Invoice Date.<br><?php echo date("Y-m-d") ?>
                                </th>
                            </tr>
                            <tr style="background-color:grey;color:blue;">
                                <th colspan="2" rowspan="1">
                                    Customer Name:<br>
                                    <?php echo $saleGotten['wholesalerName'] ?>.<br>
                                    Customer Contact:<br>
                                    <?php echo $saleGotten['wholesalerEmail'] ?><br>
                                    <?php echo $saleGotten['wholesalerPhone'] ?>
                                </th>
                            </tr>
                            <tr><th colspan="6"><hr id="tableHr"></th></tr>
                            <tr>
                                <th style="font-size:34px;font-weight:bold;" colspan="6">
                                    <center>INVOICE#<span style="color:red;"><?php
                                    // $invoiceId = mt_rand(100000,10000000);
                                    // $iv = $saleGotten['0'];e
                                    // var_dump($saleGotten);
                                    // print_r($saleGotten);
                                    // echo $saleGotten["oderDate"];
                                    // echo $iv;
                                    // echo $saleGotten['orderId'] ?></span></center>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="6"><hr id="tableHr"></th>
                            </tr>
                            <tr style="background-color:grey;color:blue;">
                                <th>ID.</th>
                                <th>Product.</th>
                                <th>Description.</th>
                                <th>Quantity.</th>a
                                <th>Cost.</th>
                                <th>Supply Date.</th>
                            </tr>
                <?php
                    $conf = "Confirmed";
                    $supplierName = $supplierDetails['supplierName'];
                    $confirmSaleDetails2 = $conn->prepare("SELECT * FROM inventory.wholesalerOrder WHERE wholesalerOrder.orderStatus = :orderStatus and wholesalerOrder.supplierName = :supplierName and wholesalerOrder.wholesalerName = :wholesalerName");
                    $confirmSaleDetails2->bindParam(':orderStatus', $conf, PDO::PARAM_STR);
                    $confirmSaleDetails2->bindParam(':supplierName', $supplierName, PDO::PARAM_STR);
                    $confirmSaleDetails2->bindParam(':wholesalerName', $wholesalerName, PDO::PARAM_STR);
                    $confirmSaleDetails2->execute();
                    $confirmSaleDetails2->rowCount();
                    $sum = 0;
                    $prod = "";
                    foreach ($confirmSaleDetails2->fetchAll(PDO::FETCH_ASSOC) as $saleGotten2){
                        $productSellingPrice = filter_var($saleGotten2['productSellingPrice'], FILTER_VALIDATE_INT);
                        $prodId = filter_var($saleGotten2['productId'], FILTER_SANITIZE_STRING);
                        $ordering = $saleGotten2['quantityOrdering'];
                        $productPrice = $productSellingPrice * $ordering;
                        $prod .= $prodId . "/";
                        $sum += $productPrice;
                        // session::put('prodd', '$prod');
                        echo "
                            <tr>
                            <th>".$saleGotten2['productId']."</th>
                            <th>".$saleGotten2['productName']."</th>
                            <th>".$saleGotten2['quantityDescription']."</th>
                            <th>".$saleGotten2['quantityOrdering']."</th>
                            <th>". $productPrice ."</th>
                            <th>".$saleGotten2['oderDate']."</th>
                            </tr>
                        ";
                    }
                ?>
                            <tr><th colspan="6"><hr id="tableHr"></th></tr>
                            <tr>
                                <td colspan="4">
                                    Total:<?php echo $prod; ?>
                                </td>
                                <th>
                                    <?php
                                        echo $sum;
                                    ?>
                                </th>
                            </tr>
                            <tr><th colspan="6"><hr id="tableHr"></th></tr>
                            <tr>
                                <th colspan="3" rowspan="2">
                                    <?php
                                        echo $supplierDetails['paymentTerms'];
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3" rowspan="2">
                                <?php
                                    echo $supplierDetails['paymentMethods'];
                                    ?>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </section>
            </article>
        </article>
    </main>
    <?php require("../FOOTER/supplierFooter.php"); ?>
        <article>
                <section id="sessionIdSec"><?php echo $loginId; ?></section>
        </article>
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