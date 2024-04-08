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
                <form action="../ACTIONS/supplierSignup.php" method="post">
                    <fieldset><center>
                        <section>
                            Supplier Name:<br>
                            <input type="text" required name="supplierName" placeholder="Bamburi Cement">
                        </section><br>
                        <section>
                            Supplier Email:<br>
                            <input type="email" required name="supplierEmail" placeholder="Bamburi@gmail.com">
                        </section><br>
                        <section>
                            Supplier Phone:<br>
                            <input type="text" required name="supplierPhone" placeholder="07123456789">
                        </section><br>
                        <section>
                            Payment Methods:<br>
                            <textarea required name="paymentMethods"></textarea>
                        </section><br>
                        <section>
                            Payment Terms:<br>
                            <textarea required name="paymentTerms"></textarea>
                        </section><br>
                        <section>
                            <button name="submit" class="submitBtn">REGISTER!</button>
                        </section>
                    </fieldset></center>
                </form>
            </section><br>
            <section id = "registerBtnSec">
                <button id="loginNavBtn"><u>Already have an account? Login.</u></button>
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
    <script src="../JAVASCRIPT/inventoryIndex.js" defer="true"></script>
</body>
</html>