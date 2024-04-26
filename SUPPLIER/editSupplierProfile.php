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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet"/>
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
                        <article id="mainArt2">
                            <section id="mainArtSec2">
                                <?php
                                $supplierNo = $_GET['supplierNo'];
                                $checkSupplierProfile = $conn->prepare("SELECT * FROM inventory.suppliersRegistered WHERE suppliersRegistered.supplierNo = :supplierNo");
                                $checkSupplierProfile->bindParam(':supplierNo', $supplierNo, PDO::PARAM_INT);
                                $checkSupplierProfile->execute();
                                foreach($checkSupplierProfile->fetchAll(PDO::FETCH_ASSOC) as $supplierProfileDetails)
                                ?>
                                <form action="../ACTIONS/editSupplierProfile.php?supplierNo=<?php echo $supplierNo ?>" method="post" enctype="multipart/form-data">
                                    <div class="card mb-3">
                                        <div id="supplierName" class="form-text mt-3">
                                            Name.
                                        </div>
                                        <div class="form-outline  mb-3" data-mdb-input-init>
                                            <input type="text" id="supplierName" class="form-control" aria-describedby="supplierName" name="supplierName" required value="<?php echo $supplierProfileDetails['supplierName']; ?>" />
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div id="supplierEmail" class="form-text mt-3">
                                            Email.
                                        </div>
                                        <div class="form-outline  mb-3" data-mdb-input-init>
                                            <input type="email" id="supplierEmail" class="form-control" aria-describedby="supplierEmail" name="supplierEmail" required value="<?php echo $supplierProfileDetails['supplierEmail']; ?>" />
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div id="supplierPhone" class="form-text mt-3">
                                            Phone.
                                        </div>
                                        <div class="form-outline  mb-3" data-mdb-input-init>
                                            <input type="text" id="supplierPhone" class="form-control" aria-describedby="supplierPhone" name="supplierPhone" required value="<?php echo $supplierProfileDetails['supplierPhone']; ?>" />
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div id="supplierPassword" class="form-text mt-3">
                                            Password.
                                        </div>
                                        <div class="form-outline  mb-3" data-mdb-input-init>
                                            <input type="text" id="supplierPassword" class="form-control" aria-describedby="supplierPassword" name="supplierPassword" required value="<?php echo $supplierProfileDetails['supplierPassword']; ?>" />
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div id="paymentMethods" class="form-text mt-3">
                                            Payment methods.
                                        </div>
                                        <div class="form-outline  mb-3" data-mdb-input-init>
                                            <input type="text" id="paymentMethods" class="form-control" aria-describedby="paymentMethods" name="paymentMethods" required value="<?php echo $supplierProfileDetails['paymentMethods']; ?>" />
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div id="paymentTerms" class="form-text mt-3">
                                            Terms of payment.
                                        </div>
                                        <div class="form-outline  mb-3" data-mdb-input-init>
                                            <input type="text" id="paymentTerms" class="form-control" aria-describedby="paymentTerms" name="paymentTerms" required value="<?php echo $supplierProfileDetails['paymentTerms']; ?>" />
                                        </div>
                                    </div>
                                    <!-- <div class="card mb-3">
                                        <div id="wholesalerLogoo" class="form-text">
                                            Logo.
                                        </div>
                                        <div class="form-outline" data-mdb-input-init>
                                            <input type="file" id="wholesalerLogoo" class="form-control" aria-describedby="wholesalerLogo" name="wholesalerLogo" required />
                                        </div>
                                    </div> -->

                                    <button type="submit" name="submit" style="float:right;" class="btn btn-danger" data-mdb-ripple-init>SAVE UPDATE!</button>
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