<?php
require("../CONNECTIONS/inventoryConnection.php");
if ($conn == null) {
    echo("check your database connection");
} else {

if (isset($_POST['submit'])) {
    $supplierName = filter_var($_POST['supplierName'], FILTER_SANITIZE_STRING);
    $supplierEmail = filter_var($_POST['supplierEmail'], FILTER_SANITIZE_STRING);
    $supplierPhone = filter_var($_POST['supplierPhone'], FILTER_SANITIZE_STRING);
    $paymentMethods = filter_var($_POST['paymentMethods'], FILTER_SANITIZE_STRING);
    $paymentTerms = filter_var($_POST['paymentTerms'], FILTER_SANITIZE_STRING);
    $supplierPassword = filter_var($_POST['supplierPassword'], FILTER_SANITIZE_STRING);
    $supplierConfirmPassword = filter_var($_POST['supplierConfirmPassword'], FILTER_SANITIZE_STRING);
    if ($supplierPassword !== $supplierConfirmPassword) {
        ?>
        <script>
            alert("password mismatch")
            location.href = "../SUPPLIER/supplierLogin.php";
        </script>
        <?php
        die();
    }
    $checkRegistration = $conn->prepare("SELECT * FROM inventory.suppliersRegistered WHERE suppliersRegistered.supplierName = '$supplierName'");
    $checkRegistration->execute();
    if ($checkRegistration->rowCount() > 0) {
        ?>
        <script>
            alert("there is already a supplier with that name");
            location.href = "../SUPPLIER/supplierLogin.php";
        </script>
        <?php
        die();
    }

    $regSupplier = $conn->prepare("INSERT INTO inventory.suppliersRegistered(supplierName,supplierEmail,supplierPhone,paymentMethods,paymentTerms,supplierPassword) VALUES(:supplierName,:supplierEmail,:supplierPhone,:paymentMethods,:paymentTerms,:supplierPassword)");
    $regSupplier->bindParam(':supplierName',$supplierName, PDO::PARAM_STR);
    $regSupplier->bindParam(':supplierEmail',$supplierEmail, PDO::PARAM_STR);
    $regSupplier->bindParam(':supplierPhone',$supplierPhone, PDO::PARAM_STR);
    $regSupplier->bindParam(':paymentMethods',$paymentMethods, PDO::PARAM_STR);
    $regSupplier->bindParam(':paymentTerms',$paymentTerms, PDO::PARAM_STR);
    $regSupplier->bindParam(':supplierPassword',$supplierPassword, PDO::PARAM_STR);
    $regSupplier->execute();
    ?>
    <script>
        alert("Thank you <?php echo $supplierName; ?> for Registering.")
        location="../SUPPLIER/supplierLogin.php"
    </script>
    <?php
    die;
}



}
?>