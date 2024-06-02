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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
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
                    <article id="bodyArt">
                        <div class="btn-group">
                            <button type="button" id="mySalesBtn" class="btn btn-primary">MY SALES</button>
                            <button type="button" id="makeOrderBtn" class="btn btn-primary">ORDER PRODUCT</button>
                            <button type="button" id="myOrdersBtn" class="btn btn-primary">MY ORDERS</button>
                        </div>
                        <section id="mySalesSec">
                            <span style="color:red;">still under construction</span><br>
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
                                            <div class='card'>
                                                "?>
                                                <div class="container-fluid">
                                                    <a href="wholesalerProductToOrder.php?productId=<?php echo $gottenProduct['productId'];?>">
                                                        <img src="<?php echo $gottenProduct['productImagePath']; ?>" class='img-fluid' alt='<?php echo $gottenProduct['productImagePath']; ?>' style="max-height:200px;"/>
                                                    </a>
                                                </div>
                                                    <?php echo "
                                                <div class='card-body'>
                                                    <span class='card-text' id='secGridItemSpan'></span> ".$gottenProduct['productName']."<br>
                                                    <span class='card-text' id='secGridItemSpan'>ksh</span> ".$gottenProduct['productSellingPrice']."<br>
                                                    <span card='card-title' id='secGridEnableReorderSpan'>"?><a class='btn btn-link' data-mdb-ripple-init data-mdb-ripple-color='dark' href="wholesalerProductToOrder.php?productId=<?php echo $gottenProduct['productId'];?>">EXPLORE.</a><?php echo "</span>
                                                </div>
                                            </div>
                                        ";
                                    }
                                ?>
                            
                            </section>
                        </section>
                        <div id="myOrdersSec" class="table-responsive">
                            <table id="myOrdersTbl" class="table table-striped table-hover">
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
                                $orders = $conn->prepare("SELECT * FROM inventory.wholesalerOrder WHERE wholesalerOrder.wholesalerName = :wholesalerName ORDER BY wholesalerOrder.oderDate ASC");
                                $orders->bindParam(':wholesalerName', $wholesalerDetails['wholesalerName']);
                                $orders->execute();
                                $orders->rowCount();
                                foreach ($orders->fetchAll(PDO::FETCH_ASSOC) as $gottenOrder) {
                                    $productSellingPrice = filter_var($gottenOrder['productSellingPrice'], FILTER_VALIDATE_INT);
                                    $ordering = $gottenOrder['quantityOrdering'];
                                        echo"
                                            <tbody class='table-group-divider table-divider-color'>
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
                        </div>
                    </article>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    <script src="../JAVASCRIPT/inventoryIndex.js" defer="true"></script>
</body>
</html>