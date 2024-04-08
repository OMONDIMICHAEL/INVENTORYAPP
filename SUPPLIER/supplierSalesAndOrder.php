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
                <section>
                    <button class="supplierBtns" id="supplierSalesBtn">SALES.</button>
                    <button class="supplierBtns" id="supplierAddProductBtn">ADD PRODUCT.</button>
                    <button class="supplierBtns" id="confirmOrderBtn">ORDERS AND INVOICE.</button>
                    <button class="supplierBtns" id="myOrdersBtn">MY ORDERS.</button>
                </section>
                <section id="supplierOrderInvoiceSec">
                    <table id="myOrdersTbl" border="2">
                        <caption>GET INVOICES AND CONFIRM ORDERS.</caption>
                        <thead>
                            <tr>
                                <th>Order ID.</th>
                                <th>Product ID.</th>
                                <th>Product Name.</th>
                                <th>Quantity Ordered.</th>
                                <th>Date Ordered.</th>
                                <th>Wholesaler Name.</th>
                                <th>Order Status.</th>
                                <th>Order Invoice.</th>
                            </tr>
                        </thead>
                        <?php
                        $supplierPlacedOrder = $conn->prepare("SELECT * FROM inventory.wholesalerOrder WHERE wholesalerOrder.supplierName = :supplierName");
                        $supplierPlacedOrder->bindParam(':supplierName', $supplierDetails['supplierName']);
                        $supplierPlacedOrder->execute();
                        $supplierPlacedOrder->rowCount();
                            foreach ($supplierPlacedOrder->fetchAll(PDO::FETCH_ASSOC) as $gottenSupplierPlacedOrder) {
                                echo"
                                    <tbody>
                                        <tr>
                                            <td>".$gottenSupplierPlacedOrder['orderId']."</td>
                                            <td>".$gottenSupplierPlacedOrder['productId']."</td>
                                            <td>".$gottenSupplierPlacedOrder['productName']."</td>
                                            <td>".$gottenSupplierPlacedOrder['quantityOrdering']."</td>
                                            <td>".$gottenSupplierPlacedOrder['oderDate']."</td>
                                            <td>".$gottenSupplierPlacedOrder['wholesalerName']."</td>
                                            <td>"?><a href="confirmOrder.php?orderId=<?php echo $gottenSupplierPlacedOrder['orderId'];?>"><?php echo $gottenSupplierPlacedOrder['orderStatus'];?>.</a><?php echo "</td>
                                            <td>"?><a href="generateInvoice.php?orderId=<?php echo $gottenSupplierPlacedOrder['orderId'];?>">INVOICE.</a><?php echo "</td>
                                        </tr>
                                    </tbody>
                                ";
                            }
                        ?>
                    </table>
                </section>
                <section id="addSupplierProductSec">
                    <form action="../ACTIONS/addSupplierProduct.php" method="post">
                        <fieldset>
                            Product Name:<br><input type="text" id="disableTxt" name= "productName" required placeholder="bamburi cement"><br><br>
                            Product Quantity:<br><input type="number" name= "productQuantity" required placeholder="50"><br><br>
                            Product Description:<br><input type="text" name= "productDescription" required placeholder="3pieces/3kg"><br><br>
                            Product Selling Price:<br><input type="number" name= "productSellingPrice" required placeholder="420"><br><br>
                            Selling Price Description:<br><input type="text" name= "sellingPriceDescription" required placeholder="420 per litre"><br><br>
                            Product Terms of Selling:<br><textarea rows="6" cols="25" name="productTerms" required></textarea><br><br>
                            <button type="submit" name="submit" class="submitBtn">ADD PRODUCT.</button>
                        </fieldset>
                    </form>
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