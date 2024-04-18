<?php
session_start();
require("../CONNECTIONS/inventoryConnection.php");
require("../FUNCTIONS/supplierFunction.php");
if ($conn == null) {
    echo("check your database connection");
} else {

    if (isset($_POST['submit'])) {
        $supplierEmail = filter_var($_POST['supplierEmail'], FILTER_SANITIZE_STRING);
        $supplierPassword = filter_var($_POST['supplierPassword'], FILTER_SANITIZE_STRING);

        $logSupplier = $conn->prepare("SELECT * FROM inventory.suppliersRegistered WHERE suppliersRegistered.supplierEmail = :supplierEmail");
        $logSupplier->bindParam(':supplierEmail',$supplierEmail, PDO::PARAM_STR);
        $logSupplier->execute();
        $logSupplier->rowCount();
            foreach ($logSupplier->fetchAll(PDO::FETCH_ASSOC) as $supplierDetails);
            if ($supplierDetails['supplierPassword'] == $supplierPassword && $supplierDetails['supplierEmail'] == $supplierEmail) {
                $_SESSION['supplierId'] = $supplierDetails['supplierId'];
                ?>
                <script>
                    location.href = "../SUPPLIER/supplierIndex.php";
                </script>
                <?php
                $conn = null;
            } else {
                ?>
                <script>
                    alert("Error!! Invalid Details.")
                    location.href = "../SUPPLIER/supplierLogin.php"
                </script>
                <?php
                $conn = null;
            }
    }

}
?>