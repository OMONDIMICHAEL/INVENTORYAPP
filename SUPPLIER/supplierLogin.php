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
                <h1><u><abbr title="INVENTORY MANAGEMENT SYSTEM">I.M.S</abbr> LOGIN.</u></h1>
            </section>
        </article>
    </header>
    <main>
        <article>
            <section id = "formSec">
                <form action="../ACTIONS/supplierLogin.php" method="post"><center>
                    <fieldset>
                        <section>
                            Supplier Email:<br>
                            <input type="email" required name="supplierEmail" placeholder="Bamburi@gmail.com">
                        </section><br>
                        <section>
                            Supplier Phone:<br>
                            <input type="text" required name="supplierPhone" placeholder="7123456789">
                        </section><br>
                        <section>
                            <button name="submit" class="submitBtn">LOGIN!</button>
                        </section>
                    </fieldset></center>
                </form>
            </section><br>
            <section id = "registerBtnSec">
                <button id="registerNavBtn"><u>Don't have an account? Register.</u></button>
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