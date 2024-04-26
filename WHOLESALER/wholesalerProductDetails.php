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
                            <div class="" id="supplierProductSecGridddd">
                                <?php
                                $productId = $_GET['productId'];
                                    $getWholesalerProductDetails = $conn->prepare("SELECT * FROM inventory.wholesalerProduct WHERE wholesalerProduct.wholesalerName = :wholesalerName AND wholesalerProduct.productId = :productId");
                                    $getWholesalerProductDetails->bindParam(':wholesalerName', $wholesalerName);
                                    $getWholesalerProductDetails->bindParam(':productId', $productId);
                                    $getWholesalerProductDetails->execute();
                                    $getWholesalerProductDetails->rowCount();
                                    ?>
                                    <section id="productDetailSec">
                                        <?php
                                        foreach ($getWholesalerProductDetails->fetchAll(PDO::FETCH_ASSOC) as $wholesalerProductDetailsFound)
                                            echo "
                                                <div class='card'>
                                                    <div class='bg-image hover-overlay' data-mdb-ripple-init id='wholesalerProductImageDetails' data-mdb-ripple-color='light'>
                                                        "?>
                                                        <img src="<?php echo $wholesalerProductDetailsFound['productImagePath']; ?>" alt="<?php echo $wholesalerProductDetailsFound['productImage']; ?>" class="img-fluid"/>
                                                        <?php echo "
                                                        <a href='#!'>
                                                            <div class='mask' style='background-color: rgba(251, 251, 251, 0.15);'></div>
                                                        </a>
                                                    </div>
                                                    <div class='card-body'>
                                                        <span class='card-title' id='secGridEnableReorderSpan'>"?><a href="wholesalerAutoStock.php?productId=<?php echo $wholesalerProductDetailsFound['productId'];?>">AUTO STOCK.</a><?php echo "</span><br>
                                                        <span class='card-text' id='secGridItemSpan'>ID:</span> ".$wholesalerProductDetailsFound['productId']."<br>
                                                        <span class='card-text' id='secGridItemSpan'>Product:</span> ".$wholesalerProductDetailsFound['productName']."<br>
                                                        <span class='card-text' id='secGridItemSpan'>Quantity Available:</span> ".$wholesalerProductDetailsFound['quantityOrdering']."<br>
                                                        <span class='card-text' id='secGridItemSpan'>Description:</span> ".$wholesalerProductDetailsFound['quantityDescription']."<br>
                                                        <span class='card-text' id='secGridItemSpan'>Selling Price:</span> ".$wholesalerProductDetailsFound['productSellingPrice']."<br>
                                                        <span class='card-text' id='secGridItemSpan'>Price Description:</span> ".$wholesalerProductDetailsFound['productSellingPrice']."<br>
                                                        <span class='card-text' id='secGridItemSpan'>Product Terms:</span> ".$wholesalerProductDetailsFound['productSellingPrice']."<br>
                                                        <span class='card-text' id='secGridItemSpan'>Supplier:</span> ".$wholesalerProductDetailsFound['supplierName']."<br>
                                                        <span class='card-text' id='secGridDisableReorderSpan'>"?><a class='btn btn-primary' data-mdb-ripple-init href="wholesalerDisableAutoStock.php?productId=<?php echo $wholesalerProductDetailsFound['productId'];?>">DISABLE AUTO STOCK.</a><?php echo "</span><br>
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
