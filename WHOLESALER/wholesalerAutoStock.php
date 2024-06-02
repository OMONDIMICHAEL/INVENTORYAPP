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
                        <article id="mainArt2">
                            <section id="mainArtSec2">
                                <?php
                                $productId = $_GET['productId'];
                                $checkIfInAutoStock = $conn->prepare("SELECT * FROM inventory.wholesalerAutoStock WHERE productId = :productId");
                                $checkIfInAutoStock->bindParam(':productId', $productId, PDO::PARAM_INT);
                                $checkIfInAutoStock->execute();
                                if ($checkIfInAutoStock->rowCount() > 0) {
                                    ?>
                                    <script>
                                        alert("Error! You already registered this product for auto ordering. Edit the registration or go back to main menu.");
                                        location = "wholesalerEditAutoStock.php?productId=<?php echo $productId ?>";
                                    </script>
                                    <?php
                                    die();
                                }
                                $checkProductDetails = $conn->prepare("SELECT * FROM inventory.supplierProduct WHERE supplierProduct.productId = :productId");
                                $checkProductDetails->bindParam(':productId', $productId, PDO::PARAM_INT);
                                $checkProductDetails->execute();
                                foreach($checkProductDetails->fetchAll(PDO::FETCH_ASSOC) as $productDetails)
                                ?>
                                <form action="../ACTIONS/wholesalerAutoStock.php?productId=<?php echo $productId ?>" method="post">
                                    <div id="productName" class="form-text">
                                        Product Name.
                                    </div>
                                    <div class="form-outline mb-3" data-mdb-input-init>
                                        <input class="form-control" id="productName" type="text" placeholder="Readonly input"
                                            aria-label="readonly input example" readonly name="productName" value="<?php echo $productDetails['productName'] ?>"/>
                                    </div>
                                    <div id="remainingStock" class="form-text">
                                        Minimum stock quantity to enable re-ordering.
                                    </div>
                                    <div class="form-outline mb-3" data-mdb-input-init>
                                        <input type="number" name="remainingStock" class="form-control" id="remainingStock" aria-describedby="remainingStock" />
                                    </div>
                                    <div id="quantityToReorder" class="form-text">
                                        Quantity to Re-order on low stock.
                                    </div>
                                    <div class="form-outline" data-mdb-input-init>
                                        <input type="number" id="quantityToReorder" class="form-control" aria-describedby="quantityToReorder" name="quantityToReorder" required />
                                        <label class="form-label" for="quantityToReorder">Describe here...</label>
                                    </div>
                                    <div id="reOrderDescription" class="form-text">
                                        Re-order Description.
                                    </div>
                                    <div class="form-outline" data-mdb-input-init>
                                        <input type="text" id="reOrderDescription" class="form-control" aria-describedby="reOrderDescription" name="reorderDescription" required />
                                        <label class="form-label" for="reOrderDescription">Describe here...</label>
                                    </div>
                                    <div id="supplierName" class="form-text">
                                        Supplier Name.
                                    </div>
                                    <div class="form-outline mb-3" data-mdb-input-init>
                                        <input class="form-control" id="supplierName" type="text" placeholder="Readonly input"
                                            aria-label="readonly input example" readonly name="supplierName" value="<?php echo $productDetails['supplierName'] ?>"/>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success" data-mdb-ripple-init>ENABLE AUTO-REORDER.</button>
                                </form>
                            </section>
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