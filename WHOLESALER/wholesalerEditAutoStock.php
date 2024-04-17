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
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
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
                <form method="post" action="../ACTIONS/wholesalerEditAutoStock.php">
                    <fieldset>
                        <legend></legend>
                        <!-- Accent-colored raised button with ripple -->
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                            Button
                        </button>

                    </fieldset>
                </form>
            </article>
        </article>
    </main>
    <?php require("../FOOTER/wholesalerFooter.php"); ?>
        <article>
                <section id="sessionIdSec"><?php echo $wholesalerLoginId; ?></section>
        </article>
    <script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = '../CSS/inventoryIndex.css';
        document.head.appendChild(link);
    </script>
    <script src="../JAVASCRIPT/inventoryIndex.js" defer="true"></script>
</body>
</html>