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
$supplierName = $supplierDetails['supplierName'];
$supplierEmail = $supplierDetails['supplierEmail'];
$supplierPhone = $supplierDetails['supplierPhone'];
$supplierLogo = $supplierDetails['supplierLogo'];
$supplierLogoPath = $supplierDetails['supplierLogoPath'];
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
    <link rel="preload" href="../JAVASCRIPT/inventoryIndex.js" as="script">
    <title>CIMS</title>
    <link rel="stylesheet" href="../CSS/inventoryIndex.css">
</head>
<body>
    <?php require("../HEADER/supplierHeader.php"); ?>
    <main>
        <!-- Section: Links  -->
        <article class="">
            <div class="container-fluid text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- side bar grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-1">
                        <?php require("../SIDEBAR/supplierSideBar.php"); ?>
                    </div>
                        <!-- side bar grid column -->
                        <!-- body grid column -->
                        <div class="col-md-8 col-lg-8 col-xl-8 mx-auto mb-4" id="bodyGridDiv">
                            <article id="bodyArt">
                                <section id="downloadInvoiceSec">
                                    <div class="input-group">
                                        <div class="input-group-text"><span class="fas fa-download "></span></div>
                                        <button id="downloadInvoiceBtn" type="button" data-mdb-ripple-init class="btn btn-danger">DOWNLOAD.</button>
                                    </div>
                                    <?php
                                            $orderId = $_GET['orderId'];
                                            $supplierConfirmed = "Not Confirmed";
                                            $checkIfConfirmed = $conn->prepare("SELECT * FROM inventory.wholesalerOrder WHERE wholesalerOrder.orderId = :orderId AND wholesalerOrder.orderStatus = :NotConfirmed");
                                            $checkIfConfirmed->bindParam(':orderId', $orderId,PDO::PARAM_INT);
                                            $checkIfConfirmed->bindParam(':NotConfirmed', $supplierConfirmed,PDO::PARAM_STR);
                                            $checkIfConfirmed->execute();
                                            if ($checkIfConfirmed->rowCount()>0) {
                                                ?>
                                                    <script>
                                                        alert("Failed! Confirm the order first");
                                                        location="supplierSalesAndOrder.php";
                                                    </script>
                                                <?php
                                                die();
                                            }
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
                                    <div class="table-responsive">
                                        <table id="supplierInvoice" class="" style="font-family:Coda, san-serif;">
                                            <caption>
                                                <p style="font-size:34px;font-weight:bold;" colspan="5">
                                                    <center>PRODUCT ID#<span style="color:red;" id="prodIdSpan"><?php //echo $prodId; ?></span></center>
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
                                                        <center>INVOICE:<span style="color:red;"><?php echo $orderId; ?></span></center>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="6"><hr id="tableHr"></th>
                                                </tr>
                                                <tr style="background-color:grey;color:blue;">
                                                    <th>ID.</th>
                                                    <th>Product.</th>
                                                    <th>Description.</th>
                                                    <th>Quantity.</th>
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
                                                    Total:
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
                                            <tr><th colspan="6"><hr id="tableHr"></th></tr>
                                            </thead>
                                        </table>
                                        <script>
                                            document.getElementById('prodIdSpan').innerHTML = '<?php echo $prod; ?>';
                                        </script>
                                    </div>
                                </section>
                            </article>
                        </div>
                        <!-- body grid column -->
                        <!-- right bar grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <?php require("../RIGHTBAR/supplierRightBar.php"); ?>
                    </div>
                    <!-- right bar grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </article>
    </main>
    <?php require("../FOOTER/supplierFooter.php"); ?>
</body>
</html>