<?php
session_start();
require("../CONNECTIONS/inventoryConnection.php");
require("../FUNCTIONS/wholesalerFunction.php");
if ($conn == null) {
    echo("check your database connection");
} else {

    if (isset($_POST['submit'])) {
        $wholesalerEmail = filter_var($_POST['wholesalerEmail'], FILTER_SANITIZE_STRING);
        $wholesalerPhone = filter_var($_POST['wholesalerPhone'], FILTER_SANITIZE_STRING);

        $logwholesaler = $conn->prepare("SELECT * FROM inventory.wholesalersRegistered WHERE wholesalersRegistered.wholesalerEmail = :wholesalerEmail");
        $logwholesaler->bindParam(':wholesalerEmail',$wholesalerEmail, PDO::PARAM_STR);
        $logwholesaler->execute();
        $logwholesaler->rowCount();
            foreach ($logwholesaler->fetchAll(PDO::FETCH_ASSOC) as $wholesalerDetails);
            if ($wholesalerDetails['wholesalerPhone'] == $wholesalerPhone && $wholesalerDetails['wholesalerEmail'] == $wholesalerEmail) {
                $_SESSION['wholesalerId'] = $wholesalerDetails['wholesalerId'];
                ?>
                <script>
                    location.href = "../WHOLESALER/inventoryIndex.php";
                </script>
                <?php
                $conn = null;
            } else {
                ?>
                <script>
                    alert("Error!! Invalid Details.")
                    location.href = "../WHOLESALER/wholesalerLogin.php"
                </script>
                <?php
                $conn = null;
            }
    }

}
?>