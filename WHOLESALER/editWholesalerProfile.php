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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet"/>
    <link rel="preload" href="../JAVASCRIPT/inventoryIndex.js" as="script">
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
                                $wholesalerNum = $_GET['wholesalerNum'];
                                $checkWholesalerProfile = $conn->prepare("SELECT * FROM inventory.wholesalersRegistered WHERE wholesalersRegistered.wholesalerNum = :wholesalerNum");
                                $checkWholesalerProfile->bindParam(':wholesalerNum', $wholesalerNum, PDO::PARAM_INT);
                                $checkWholesalerProfile->execute();
                                foreach($checkWholesalerProfile->fetchAll(PDO::FETCH_ASSOC) as $wholesalerProfileDetails)
                                ?>
                                <form action="../ACTIONS/editWholesalerProfile.php?wholesalerNum=<?php echo $wholesalerNum ?>" method="post" enctype="multipart/form-data">
                                    <div class="card mb-3">
                                        <div id="wholesalerName" class="form-text mt-3">
                                            Name.
                                        </div>
                                        <div class="form-outline  mb-3" data-mdb-input-init>
                                            <input type="text" id="wholesalerName" class="form-control" aria-describedby="wholesalerName" name="wholesalerName" required value="<?php echo $wholesalerProfileDetails['wholesalerName']; ?>" />
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div id="wholesalerEmail" class="form-text mt-3">
                                            Email.
                                        </div>
                                        <div class="form-outline  mb-3" data-mdb-input-init>
                                            <input type="email" id="wholesalerEmail" class="form-control" aria-describedby="wholesalerEmail" name="wholesalerEmail" required value="<?php echo $wholesalerProfileDetails['wholesalerEmail']; ?>" />
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div id="wholesalerPhone" class="form-text mt-3">
                                            Phone.
                                        </div>
                                        <div class="form-outline  mb-3" data-mdb-input-init>
                                            <input type="text" id="wholesalerPhone" class="form-control" aria-describedby="wholesalerPhone" name="wholesalerPhone" required value="<?php echo $wholesalerProfileDetails['wholesalerPhone']; ?>" />
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div id="wholesalerPassword" class="form-text mt-3">
                                            Password.
                                        </div>
                                        <div class="form-outline  mb-3" data-mdb-input-init>
                                            <input type="text" id="wholesalerPassword" class="form-control" aria-describedby="wholesalerPassword" name="wholesalerPassword" required value="<?php echo $wholesalerProfileDetails['wholesalerPassword']; ?>" />
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