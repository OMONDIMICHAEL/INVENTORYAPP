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
                    <?php
                    $productId = $_GET['productId'];
                    $checkIfInAutoStock = $conn->prepare("SELECT * FROM inventory.wholesalerAutoStock WHERE productId = :productId");
                    $checkIfInAutoStock->bindParam(':productId', $productId, PDO::PARAM_INT);
                    $checkIfInAutoStock->execute();
                    if ($checkIfInAutoStock->rowCount() > 0) {
                        ?>
                        <script>
                            location = "wholesalerEditAutoStock.php?productId=<?php echo $productId ?>";
                            alert("Error! You already registered this product for auto ordering. Edit the registration or go back to main menu.")
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
                        <fieldset>
                            Product Name:<br><input type="text" name= "productName" value = "<?php echo $productDetails['productName'] ?>" required placeholder="bamburi cement"><br><br>
                            Remaining stock quantity to enable re-ordering:<br><input type="number" name= "remainingStock" required placeholder="10"><br><br>
                            Quantity to re-order on low stock:<br><input type="number" name= "quantityToReorder" required placeholder="34"><br><br>
                            Re-order description:<br><input type="text" name= "reorderDescription" required placeholder="bags of cement"><br><br>
                            Supplier:<br><input type="text" class="disable" name= "supplierName" value = "<?php echo $productDetails['supplierName'] ?>" required placeholder="edwardstuck@gmail.com"><br><br>
                            <button type="submit" name="submit" class="submitBtn">ENABLE AUTO-REORDER.</button>
                        </fieldset>
                    </form>
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