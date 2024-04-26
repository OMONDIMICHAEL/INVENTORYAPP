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
                            <article>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" id="supplierSalesBtn" class="btn btn-success"  data-mdb-ripple-init>SALES</button>
                                    <button type="button" id="supplierAddProductBtn" class="btn btn-success"  data-mdb-ripple-init>ADD PRODUCT</button>
                                    <button type="button" id="confirmOrderBtn" class="btn btn-success"  data-mdb-ripple-init>ORDERS AND INVOICE</button>
                                </div>
                                <section id="supplierSalesSec" class="table-responsive">
                                    <table  class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Product ID.</th>
                                                <th>Product Name.</th>
                                                <th>Quantity Ordered.</th>
                                                <th>Quantity Description</th>
                                                <th>Wholesaler Name.</th>
                                                <th>Wholesaler Email.</th>
                                                <th>Wholesaler Phone.</th>
                                                <th>Selling Price.</th>
                                                <th>Date Sold.</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $supplierSale = $conn->prepare("SELECT * FROM inventory.supplierSale WHERE supplierSale.supplierName = :supplierName");
                                        $supplierSale->bindParam(':supplierName', $supplierDetails['supplierName']);
                                        $supplierSale->execute();
                                        $supplierSale->rowCount();
                                            foreach ($supplierSale->fetchAll(PDO::FETCH_ASSOC) as $gottenSupplierSale) {
                                                echo"
                                                    <tbody>
                                                        <tr>
                                                            <td>".$gottenSupplierSale['productId']."</td>
                                                            <td>".$gottenSupplierSale['productName']."</td>
                                                            <td>".$gottenSupplierSale['quantityOrdered']."</td>
                                                            <td>".$gottenSupplierSale['quantityDescription']."</td>
                                                            <td>".$gottenSupplierSale['wholesalerName']."</td>
                                                            <td>".$gottenSupplierSale['wholesalerEmail']."</td>
                                                            <td>".$gottenSupplierSale['wholesalerPhone']."</td>
                                                            <td>".$gottenSupplierSale['productSellingPrice']."</td>
                                                            <td>".$gottenSupplierSale['saleDate']."</td>
                                                        </tr>
                                                    </tbody>
                                                ";
                                            }
                                        ?>
                                    </table>
                                </section>
                                <section id="supplierOrderInvoiceSec" class="table-responsive">
                                    <table id="myOrdersTbl"  class="table table-striped table-hover">
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
                                <section id="addSupplierProductSec"><br>
                                    <form  action="../ACTIONS/addSupplierProduct.php" method="post" enctype="multipart/form-data">
                                        <div  class="row row-cols-lg-auto g-3 align-items-center">
                                            <div class="col-12">
                                                <label class="visually-visible" for="productName">Product name</label>
                                                <div class="input-group">
                                                  <input type="text" class="form-control" id="productName" name="productName" required placeholder="product name.." />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="visually-visible" for="productQuantity">Product quantity</label>
                                                <div class="input-group">
                                                  <input type="number" class="form-control" id="productQuantity" name="productQuantity" required placeholder="855" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="visually-visible" for="productDescription">Product description</label>
                                                <div class="input-group">
                                                  <input type="text" class="form-control" id="productDescription" name="productDescription" required placeholder="855 kilograms" />
                                                </div>
                                            </div>
                                      </div><br>
                                      <div  class="row row-cols-lg-auto g-3 align-items-center">
                                            <div class="col-12">
                                                <label class="visually-visible" for="productSellingPrice">Product selling price</label>
                                                <div class="input-group">
                                                  <div class="input-group-text">Ksh</div>
                                                  <input type="number" class="form-control" id="productSellingPrice" name="productSellingPrice" required placeholder="2000" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="visually-visible" for="sellingPriceDescription">Selling price description</label>
                                                <div class="input-group">
                                                  <input type="text" class="form-control" id="sellingPriceDescription" name="sellingPriceDescription" required placeholder="2000 per kilogram" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="visually-visible" for="productImage">Product image</label>
                                                <div class="input-group">
                                                  <input type="file" class="form-control" id="productImage" name="productImage" required />
                                                </div>
                                            </div>
                                      </div><br>
                                      <div  class="row row-cols-lg-auto g-3 align-items-center">
                                            <div class="col-12">
                                                <label class="visually-visible" for="productTerms">Product terms</label>
                                                <div class="input-group">
                                                    <textarea class="form-control" id="productTerms" name="productTerms" required placeholder="payment on delivery"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-danger">ADD PRODUCT</button>
                                            </div>
                                      </div>
                                    </form>
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