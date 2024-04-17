<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="mikemike3662@gmail.com">
    <meta name="description" content="inventory web app">
    <title>inventory app</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet"/>
    <link rel="icon" href="../IMAGES/title.jpg" type="image/x-icon">
    <link rel="preload" href="../JAVASCRIPT/inventoryIndex.js" as="script">
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
                <form action="../ACTIONS/wholesalerSignup.php" method="post">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" id="txtWholesaleName" required name="wholesalerName" placeholder="umoja supermarket" class="form-control" />
                            <label class="form-label" for="txtWholesaleName">Wholesale name</label>
                        </div>
                        </div>
                        <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" id="txtWholesalerPhone" required name="wholesalerPhone" placeholder="07123456789" class="form-control" />
                            <label class="form-label" for="txtWholesalerPhone">Phone No</label>
                        </div>
                        </div>
                    </div>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="txtWholesalerEmail" required name="wholesalerEmail" placeholder="xyz@gmail.com" class="form-control" />
                        <label class="form-label" for="txtWholesalerEmail">Email address</label>
                    </div>

                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="wholesalerPassword" class="form-control" />
                        <label class="form-label" for="wholesalerPassword">Password</label>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-center mb-4">
                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                        <label class="form-check-label" for="form2Example33">
                        Subscribe to our newsletter
                        </label>
                    </div>

                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block mb-4">Sign up</button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>or sign up with:</p>
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