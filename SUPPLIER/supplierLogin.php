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
                <h1><u><abbr title="INVENTORY MANAGEMENT SYSTEM">I.M.S</abbr> LOGIN.</u></h1>
            </section>
        </article>
    </header>
    <main>
        <article>
            <section id = "formSec">
                <!-- Pills navs -->
                <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-login" data-mdb-pill-init href="#pills-login" role="tab"  aria-controls="pills-login" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-register" data-mdb-pill-init href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                    </li>
                </ul>
                <!-- Pills navs -->
                <!-- Pills content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                        <form action="../ACTIONS/supplierLogin.php" method="post">
                            <div class="text-center mb-3">
                                <p><span style="color:black;">Sign in with:</span></p>
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
                            <p class="text-center"><span style="color:black;">or:</span></p>
                            <!-- Email input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="loginName" required name="supplierEmail" class="form-control" />
                                <label class="form-label" for="loginName" autocomplete="on" autofocus >Email or Username</label>
                            </div>

                            <!-- Password input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="loginPassword" class="form-control" required name="supplierPassword"/>
                                <label class="form-label" for="loginPassword">Password</label>
                            </div>
                            <!-- 2 column grid layout -->
                            <div class="row mb-4">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check mb-3 mb-md-0">
                                        <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked/>
                                        <label class="form-check-label" for="loginCheck"> <span style="color:black;">Remember me</span> </label>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center">
                                <!-- Simple link -->
                                <a href="#!">Forgot password?</a>
                                </div>
                            </div>
                            <!-- Submit button -->
                            <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                            <!-- Register buttons -->
                            <!-- <div class="text-center">
                                <p>Not a member? <a href="#!">Register</a></p>
                            </div> -->
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                        <form action="../ACTIONS/supplierSignup.php" method="post" enctype="multipart/form-data">
                            <div class="text-center mb-3">
                                <p><span style="color:black;">Sign up with:</span></p>
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

                            <p class="text-center">or:</p>
                            <!-- Name input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="registerName" class="form-control" name="supplierName" required />
                                <label class="form-label" for="registerName">SupplierName</label>
                            </div>
                            <!-- Username input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="number" id="registerUsername" class="form-control" name="supplierPhone" data-mdb-showcounter="true" maxlength="10" required />
                                <label class="form-label" for="registerUsername">Phone</label>
                                <div class="form-helper"></div>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="registerEmail" class="form-control" name="supplierEmail" required />
                                <label class="form-label" for="registerEmail">Email</label>
                            </div>
                            <div data-mdb-input-init class="form-outline">
                                <textarea id="paymentMethods" class="form-control mb-4" name="paymentMethods" required ></textarea>
                                <label class="form-label" for="paymentMethods">Your prefered payment methods</label>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <textarea id="paymentTerms" class="form-control" name="paymentTerms" required ></textarea>
                                <label class="form-label" for="paymentTerms">Your business terms and conditions</label>
                            </div>
                            <!-- Password input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="registerPassword" class="form-control" name="supplierPassword" required />
                                <label class="form-label" for="registerPassword">Password</label>
                            </div>

                            <!-- Repeat Password input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="registerRepeatPassword" class="form-control" name="supplierConfirmPassword" required />
                                <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                            </div>
                            <div id="supplierLogo" class="form-text">
                                Supply logo/profile picture.
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="file" id="supplierLogo" class="form-control" name="supplierLogo" required />
                            </div>
                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-center mb-4">
                                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked  aria-describedby="registerCheckHelpText" />
                                <label class="form-check-label" for="registerCheck">
                                <span style="color:black;">I have read and agree to the terms</span>
                                </label>
                            </div>
                            <!-- Submit button -->
                            <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block mb-3">Register</button>
                        </form>
                    </div>
                </div>
                <!-- Pills content -->
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
    <script>
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = '../CSS/supplierSignup.css';
        document.head.appendChild(link);
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
      <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="../JAVASCRIPT/inventoryIndex.js" defer="true"></script>
</body>
</html>