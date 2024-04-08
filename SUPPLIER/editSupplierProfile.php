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
                <section id="mainArtSec2">
                    <form action="../ACTIONS/editSupplierProfile.php?supplierNo=<?php echo $supplierDetails['supplierNo'] ?>" method="post">
                        <fieldset>
                            <section>
                                Supplier Name:<br>
                                <input type="text" required name="supplierName" placeholder="Bamburi Cement" value="<?php echo $supplierDetails['supplierName'] ?>">
                            </section><br>
                            <section>
                                Supplier Email:<br>
                                <input type="email" required name="supplierEmail" placeholder="Bamburi@gmail.com" value="<?php echo $supplierDetails['supplierEmail'] ?>">
                            </section><br>
                            <section>
                                Supplier Phone:<br>
                                <input type="text" required name="supplierPhone" placeholder="07123456789" value="<?php echo $supplierDetails['supplierPhone'] ?>">
                            </section><br>
                            <section>
                                Payment Methods:<br>
                                <textarea cols="" rows="6" required name="paymentMethods"><?php echo $supplierDetails['paymentMethods'] ?></textarea>
                            </section><br>
                            <section>
                                Payment Terms:<br>
                                <textarea required rows="6" name="paymentTerms"><?php echo $supplierDetails['paymentTerms'] ?></textarea>
                            </section><br>
                            <section>
                                <button name="submit" class="submitBtn">EDIT PROFILE!</button>
                            </section>
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