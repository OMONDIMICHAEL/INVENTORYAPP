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
                    <button class="supplierBtns" id="mySalesBtn">MY SALES.</button>
                    <button class="supplierBtns" id="makeOrderBtn">ORDER PRODUCT.</button>
                    <button class="supplierBtns" id="myOrdersBtn">MY ORDERS.</button>
                </section>
                <section id="mySalesSec">
                    sales.
                </section>
                <section id="makeOrderSec">
                    <section id="searchSec">
                        <form action="searchSupplierProduct.php" method="post">
                            <section class="container">
                                <input type="text" name="searchOrder" placeholder="search here.." required>
                                <section class="search" ></section>
                            </section>
                        </form>
                    </section>
                    <section id="makeOrderSecGrid">
                        <?php
                        $orders = $conn->prepare("SELECT * FROM inventory.supplierProduct");
                        $orders->execute();
                        $orders->rowCount();
                            foreach ($orders->fetchAll(PDO::FETCH_ASSOC) as $gottenProduct) {
                                echo"
                                    <section id='makeOrderSecGridItems'>
                                        <span id='secGridOrderSpan'>"?><a href="orderProduct.php?productId=<?php echo $gottenProduct['productId'];?>">ORDER.</a><?php echo "</span><br>
                                        <span id='secGridItemSpan'>ID:</span> ".$gottenProduct['productId']."<br>
                                        <span id='secGridItemSpan'>Product:</span> ".$gottenProduct['productName']."<br>
                                        <span id='secGridItemSpan'>Quantity Available:</span> ".$gottenProduct['productQuantity']."<br>
                                        <span id='secGridItemSpan'>Description:</span> ".$gottenProduct['productDescription']."<br>
                                        <span id='secGridItemSpan'>Selling Price:</span> ".$gottenProduct['productSellingPrice']."<br>
                                        <span id='secGridItemSpan'>Price Description:</span> ".$gottenProduct['sellingPriceDescription']."<br>
                                        <span id='secGridItemSpan'>Product Terms:</span> ".$gottenProduct['productTerms']."<br>
                                        <span id='secGridItemSpan'>Supplier:</span> ".$gottenProduct['supplierName']."
                                    </section>
                                ";
                            }
                        ?>
                    
                    </section>
                </section>
                <section id="myOrdersSec">
                    <table id="myOrdersTbl" border="2">
                        <caption>CHECK YOUR ORDER STATUS.</caption>
                        <thead>
                            <tr>
                                <th>Order ID.</th>
                                <th>Product ID.</th>
                                <th>Product.</th>
                                <th>Quantity.</th>
                                <th>Price.</th>
                                <th>Date Ordered.</th>
                                <th>Supplier.</th>
                                <th>Status.</th>
                            </tr>
                        </thead>
                        <?php
                        $orders = $conn->prepare("SELECT * FROM inventory.wholesalerOrder WHERE wholesalerOrder.wholesalerName = :wholesalerName");
                        $orders->bindParam(':wholesalerName', $wholesalerDetails['wholesalerName']);
                        $orders->execute();
                        $orders->rowCount();
                        foreach ($orders->fetchAll(PDO::FETCH_ASSOC) as $gottenOrder) {
                            $productSellingPrice = filter_var($gottenOrder['productSellingPrice'], FILTER_VALIDATE_INT);
                            $ordering = $gottenOrder['quantityOrdering'];
                                echo"
                                    <tbody>
                                        <tr>
                                            <td>".$gottenOrder['orderId']."</td>
                                            <td>".$gottenOrder['productId']."</td>
                                            <td>".$gottenOrder['productName']."</td>
                                            <td>".$gottenOrder['quantityOrdering']."</td>
                                            <td>".$productSellingPrice*$ordering."</td>
                                            <td>".$gottenOrder['oderDate']."</td>
                                            <td>".$gottenOrder['supplierName']."</td>
                                            <td>".$gottenOrder['orderStatus']."</td>
                                        </tr>
                                    </tbody>
                                ";
                            }
                        ?>
                    </table>
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