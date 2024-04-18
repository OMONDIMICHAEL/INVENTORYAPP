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
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet"/>
    <link rel="icon" href="../IMAGES/title.jpg" type="image/x-icon">
    <link rel="preload" href="../JAVASCRIPT/inventoryIndex.js" as="script">
    <title>Inventory App</title>
</head>
<body>
    <?php require("../HEADER/wholesalerHeader.php"); ?>
    <main>
        <article id="mainArt">
            <article id="mainArt1">
                <section id="mainArtSec1">
                    <button class="btn btn-info" data-mdb-ripple-init id="inventoryTrackingBtn">
                        Inventory tracking.
                    </button>
                    <button class="btn btn-info" data-mdb-ripple-init id="wholesalerSalesAndOrderBtn">
                        Sales and Order Management.
                    </button>
                    <button class="btn btn-info" data-mdb-ripple-init id="reportingAndAnalyticsBtn">
                        Reporting and Analytics.
                    </button>
                    <button class="btn btn-info" data-mdb-ripple-init id="accountingSystemBtn">
                        Accounting System.
                    </button>
                </section>
            </article>
            <article id="mainArt2">
                <section id="mainArtSec2">
                    <button id="mySalesBtn" class="btn btn-primary" data-mdb-ripple-init>MY SALES.</button>
                    <button id="makeOrderBtn" class="btn btn-primary" data-mdb-ripple-init>ORDER PRODUCT.</button>
                    <button id="myOrdersBtn" class="btn btn-primary" data-mdb-ripple-init>MY ORDERS.</button>
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
                                        <span class='btn btn-link' data-mdb-ripple-init data-mdb-ripple-color='dark' id='secGridOrderSpan'>"?><a href="orderProduct.php?productId=<?php echo $gottenProduct['productId'];?>">ORDER.</a><?php echo "</span><br>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
      <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="../JAVASCRIPT/inventoryIndex.js" defer="true"></script>
</body>
</html>