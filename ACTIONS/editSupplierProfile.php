<?php
require("../CONNECTIONS/inventoryConnection.php");
if ($conn == null) {
    echo("check your database connection");
} else {
$supplierNo = $_GET['supplierNo'];
if (isset($_POST['submit'])) {
$supplierName = filter_var($_POST['supplierName'], FILTER_SANITIZE_STRING);
$supplierEmail = filter_var($_POST['supplierEmail'], FILTER_SANITIZE_STRING);
$supplierPhone = filter_var($_POST['supplierPhone'], FILTER_SANITIZE_STRING);
$paymentMethods = filter_var($_POST['paymentMethods'], FILTER_SANITIZE_STRING);
$paymentTerms = filter_var($_POST['paymentTerms'], FILTER_SANITIZE_STRING);

    $regSupplier = $conn->prepare("UPDATE inventory.suppliersRegistered SET suppliersRegistered.supplierName = :supplierName,suppliersRegistered.supplierEmail = :supplierEmail,suppliersRegistered.supplierPhone = :supplierPhone,suppliersRegistered.paymentMethods = :paymentMethods,suppliersRegistered.paymentTerms = :paymentTerms WHERE suppliersRegistered.supplierNo = :supplierNo");
    $regSupplier->bindParam(':supplierName',$supplierName, PDO::PARAM_STR);
    $regSupplier->bindParam(':supplierEmail',$supplierEmail, PDO::PARAM_STR);
    $regSupplier->bindParam(':supplierPhone',$supplierPhone, PDO::PARAM_STR);
    $regSupplier->bindParam(':paymentMethods',$paymentMethods, PDO::PARAM_STR);
    $regSupplier->bindParam(':paymentTerms',$paymentTerms, PDO::PARAM_STR);
    $regSupplier->bindParam(':supplierNo',$supplierNo, PDO::PARAM_STR);
    $regSupplier->execute();
    ?>
    <script>
        alert("Update successfull. Login <?php echo $supplierName; ?> to Your New Profile.")
        location="../SUPPLIER/supplierLogin.php"
    </script>
    <?php
    die;
}

}
?>