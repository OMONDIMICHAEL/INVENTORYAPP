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
<div id="loader"></div>
<div id="content" style="display: none;"> <!-- Hidden initially -->
    <!-- Your HTML content goes here -->
    <header>
        <article id="headerArt">
            <section>
                <h1><u><abbr title="CUSTOMIZED INVENTORY MANAGEMENT SYSTEM">C.I.M.S</abbr> LOGIN.</u></h1>
            </section>
        </article>
    </header>
    <main>
        <article>
            <section id = "formSec">
                <form action="../ACTIONS/wholesalerLogin.php" method="post">
                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" required name="wholesalerEmail" id="txtEmail" class="form-control" />
                        <label class="form-label" for="txtEmail">wholesaler Email:</label>
                    </div>
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="txtPassword" required name="wholesalerPassword" class="form-control" />
                        <label class="form-label" for="txtPassword">wholesaler Password</label>
                    </div>
                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example34" checked />
                            <label class="form-check-label" for="form2Example34"> <span style="color:black;">Remember me</span> </label>
                        </div>
                        </div>
                        <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                        </div>
                    </div>
                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                    <!-- Register buttons -->
                    <div class="text-center">
                        <p><span style="color:black;">Not a member?</span> <a href="wholesalerSignup.php">Register</a></p>
                        <p><span style="color:black;">or sign up with:</span></p>
                        <button  data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                        </button>
                        <button  data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-google"></i>
                        </button>
                        <button  data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                        </button>
                        <button  data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
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
    </footer></div>
    <script>
  // Show loading spinner when the page starts loading
  document.onreadystatechange = function () {
    if (document.readyState === "loading") {
      document.getElementById("loader").style.display = "block";
    }
  };

  // Hide loading spinner and show content when the page finishes loading
  window.onload = function () {
    document.getElementById("loader").style.display = "none";
    document.getElementById("content").style.display = "block";
  };
</script>
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