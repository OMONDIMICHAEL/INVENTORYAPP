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
                        <div class="container-fluid text-center text-md-start mt-5">
                            <div class="" id="supplierProductSecGridddd">
                                <?php
                                $productId = $_GET['productId'];
                                    $getsupplierProductDetails = $conn->prepare("SELECT * FROM inventory.supplierProduct WHERE supplierProduct.supplierName = :supplierName AND supplierProduct.productId = :productId");
                                    $getsupplierProductDetails->bindParam(':supplierName', $supplierName);
                                    $getsupplierProductDetails->bindParam(':productId', $productId);
                                    $getsupplierProductDetails->execute();
                                    $getsupplierProductDetails->rowCount();
                                    ?>
                                    <section id="productDetailSec">
                                        <?php
                                        foreach ($getsupplierProductDetails->fetchAll(PDO::FETCH_ASSOC) as $supplierProductDetailsFound)
                                            echo "
                                                <div class='card'>
                                                    <div class='bg-image hover-overlay' data-mdb-ripple-init id='supplierProductImageDetails' data-mdb-ripple-color='light'>
                                                        "?>
                                                        <img src="<?php echo $supplierProductDetailsFound['productImagePath']; ?>" alt="<?php echo $supplierProductDetailsFound['productImage']; ?>" class="img-fluid"/>
                                                        <?php echo "
                                                        <a href='#!'>
                                                            <div class='mask' style='background-color: rgba(251, 251, 251, 0.15);'></div>
                                                        </a>
                                                    </div>
                                                    <div class='card-body'>
                                                        <span id='secGridOrderSpan'>"?><a href="supplierSalesAndOrder.php">ADD STOCK.</a>
                                                        <?php echo "
                                                        </span><br>
                                                        <span id='secGridItemSpan'>ID:</span> ".$supplierProductDetailsFound['productId']."<br>
                                                        <span id='secGridItemSpan'>Product:</span> ".$supplierProductDetailsFound['productName']."<br>
                                                        <span id='secGridItemSpan'>Quantity Available:</span> ".$supplierProductDetailsFound['productQuantity']."<br>
                                                        <span id='secGridItemSpan'>Description:</span> ".$supplierProductDetailsFound['productDescription']."<br>
                                                        <span id='secGridItemSpan'>Selling Price:</span> ".$supplierProductDetailsFound['productSellingPrice']."<br>
                                                        <span id='secGridItemSpan'>Price Description:</span> ".$supplierProductDetailsFound['sellingPriceDescription']."<br>
                                                        <span id='secGridItemSpan'>Product Terms:</span> ".$supplierProductDetailsFound['productTerms']."<br>
                                                        <span id='secGridItemSpan'>Supplier:</span> ".$supplierProductDetailsFound['supplierName']."
                                                    </div>
                                                </div>
                                            ";?>
                                    </section><?php
                                ?>
                            </div>
                        </div>
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
