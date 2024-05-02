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
                            <?php
                            $productId = $_GET['productId'];
                            $currentAutoStockDetails = $conn->prepare("SELECT * FROM inventory.wholesalerAutoStock WHERE wholesalerAutoStock.productId = :productId AND wholesalerAutoStock.wholesalerName = :wholesalerName");
                            $currentAutoStockDetails->bindParam(':productId', $productId, PDO::PARAM_INT);
                            $currentAutoStockDetails->bindParam(':wholesalerName', $wholesalerName, PDO::PARAM_STR);
                            $currentAutoStockDetails->execute();
                            foreach ($currentAutoStockDetails->fetchAll(PDO::FETCH_ASSOC) as $foundAutoStockDetails)
                            ?>
                            <form method="post" action="../ACTIONS/wholesalerEditAutoStock.php?productId=<?php echo $productId; ?>">
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row mb-4">
                                    <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="text" id="productName" name="productName" class="form-control" aria-label="read only input" readonly value="<?php echo $foundAutoStockDetails['productName'] ?>" />
                                        <label class="form-label" for="productName">Product name</label>
                                    </div>
                                    </div>
                                    <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="number" id="remainingStock" name="remainingStock" class="form-control" required value="<?php echo $foundAutoStockDetails['remainingStock'] ?>" />
                                        <label class="form-label" for="remainingStock">Minimum amount of stock to remain</label>
                                    </div>
                                    </div>
                                </div>

                                <!-- Text input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="number" id="quantityToReorder" name="quantityToReorder" class="form-control" required value="<?php echo $foundAutoStockDetails['quantityToReorder']; ?>" />
                                    <label class="form-label" for="quantityToReorder">Quantity to re-order</label>
                                </div>

                                <!-- Text input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="reorderDescription" name="reorderDescription" class="form-control" required value="<?php echo $foundAutoStockDetails['reorderDescription']; ?>" />
                                    <label class="form-label" for="reorderDescription">Quantity description like 60 bags</label>
                                </div>

                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="supplierName" name="supplierName" class="form-control" aria-label="read only input" readonly value="<?php echo $foundAutoStockDetails['supplierName']; ?>" />
                                    <label class="form-label" for="supplierName">Supplier name</label>
                                </div>

                                <!-- Number input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="wholesalerName" class="form-control" name="wholesalerName" aria-label="readonly input" readonly value="<?php echo $foundAutoStockDetails['wholesalerName'] ?>" />
                                    <label class="form-label" for="wholesalerName">Wholesaler name</label>
                                </div>
                                <!-- Submit button -->
                                <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block mb-4">EDIT YOUR AUTO-ORDER!</button>
                            </form>
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