<?php
session_start();
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
    <link rel="stylesheet" href="../CSS/supplierSignup.css">
</head>
<body>
    <header>
        <article id="headerArt">
            <section>
                <h1><u><abbr title="INVENTORY MANAGEMENT SYSTEM">I.M.S</abbr> REGISTRATION.</u></h1>
            </section>
        </article>
    </header>
    <main>
        <article>
            <section id = "formSec">
                <form action="../ACTIONS/wholesalerSignup.php" method="post" enctype="multipart/form-data">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="txtWholesaleName" required name="wholesalerName" class="form-control" />
                            <label class="form-label" for="txtWholesaleName">Wholesale name</label>
                        </div>
                        </div>
                        <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <input type="number" id="txtWholesalerPhone" required name="wholesalerPhone" class="form-control" data-mdb-showcounter="true" maxlength="10" />
                            <label class="form-label" for="txtWholesalerPhone">Phone No</label>
                        </div>
                        </div>
                    </div>
                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="txtWholesalerEmail" required name="wholesalerEmail" class="form-control" />
                        <label class="form-label" for="txtWholesalerEmail">Email address</label>
                    </div>
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="wholesalerPassword" class="form-control" name="wholesalerPassword" required />
                        <label class="form-label" for="wholesalerPassword">Password</label>
                    </div>
                    <div id="wholesalerLogo" class="form-text">
                        Wholesale logo/profile picture.
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="file" id="wholesalerLogo" class="form-control" name="wholesalerLogo" required />
                    </div>
                    <!-- Checkbox -->
                    <!-- <div class="form-check d-flex justify-content-center mb-4">
                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                        <label class="form-check-label" for="form2Example33">
                        <span style="color:black;">Subscribe to our newsletter</span>
                        </label>
                    </div> -->
                    <!-- 2 column grid layout -->
                    <div class="row mb-4">
                        <div class="col-md-6 d-flex justify-content-center">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                            <label class="form-check-label" for="form2Example33">
                            <span style="color:black;">Subscribe to our newsletter</span>
                            </label>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <!-- Simple link -->
                            <a href="wholesalerLogin.php">Login here.</a>
                        </div>
                    </div>
                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block mb-4">Sign up</button>
                    <!-- Register buttons -->
                    <div class="text-center">
                        <p><span style="color:black;">or sign up with:</span></p>
                        <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                        </button>
                        <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-google"></i>
                        </button>
                        <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                        </button>
                        <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-github"></i>
                        </button>
                    </div>
                    </form>
            </section>
        </article>
    </main>
    <footer>
        <article>
            <section id="footerSec">
               <center>Copyright &copy; 2024. &reg; All Rights Reserved.</center>
            </section>
        </article>
    </footer>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    <script>
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = '../CSS/supplierSignup.css';
        document.head.appendChild(link);
    </script>
    <script src="../JAVASCRIPT/inventoryIndex.js" defer="true"></script>
</body>
</html>