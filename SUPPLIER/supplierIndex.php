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
                    <section id="supplierProductTitle">
                        <center>AVAILABLE STOCK ITEMS.</center>
                    </section>
                    <section id="supplierProductSecGrid">
                        <?php
                        $getSupplierProducts = $conn->prepare("SELECT * FROM inventory.supplierProduct WHERE supplierProduct.supplierName = :supplierName");
                        $getSupplierProducts->bindParam(':supplierName', $supplierName);
                        $getSupplierProducts->execute();
                        $getSupplierProducts->rowCount();
                            foreach ($getSupplierProducts->fetchAll(PDO::FETCH_ASSOC) as $supplierProducts) {
                                echo"
                                    <section id='supplierProductSecGridItems'>
                                        <span id='secGridOrderSpan'>"?><a href="orderProduct.php?productId=<?php echo $supplierProducts['productId'];?>">ADD STOCK.</a><?php echo "</span><br>
                                        <span id='secGridItemSpan'>ID:</span> ".$supplierProducts['productId']."<br>
                                        <span id='secGridItemSpan'>Product:</span> ".$supplierProducts['productName']."<br>
                                        <span id='secGridItemSpan'>Quantity Available:</span> ".$supplierProducts['productQuantity']."<br>
                                        <span id='secGridItemSpan'>Description:</span> ".$supplierProducts['productDescription']."<br>
                                        <span id='secGridItemSpan'>Selling Price:</span> ".$supplierProducts['productSellingPrice']."<br>
                                        <span id='secGridItemSpan'>Price Description:</span> ".$supplierProducts['sellingPriceDescription']."<br>
                                        <span id='secGridItemSpan'>Product Terms:</span> ".$supplierProducts['productTerms']."<br>
                                        <span id='secGridItemSpan'>Supplier:</span> ".$supplierProducts['supplierName']."
                                    </section>
                                ";
                            }
                        ?>
                    </section>
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
    <script src="../JAVASCRIPT/inventoryIndex.js" defer="true"></script>
</body>
</html>