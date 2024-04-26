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
$supplierPassword = filter_var($_POST['supplierPassword'], FILTER_SANITIZE_STRING);
$paymentMethods = filter_var($_POST['paymentMethods'], FILTER_SANITIZE_STRING);
$paymentTerms = filter_var($_POST['paymentTerms'], FILTER_SANITIZE_STRING);

    $updateSupplierProfile = $conn->prepare("UPDATE inventory.suppliersRegistered SET suppliersRegistered.supplierName = :supplierName,suppliersRegistered.supplierEmail = :supplierEmail,suppliersRegistered.supplierPhone = :supplierPhone,suppliersRegistered.paymentMethods = :paymentMethods,suppliersRegistered.paymentTerms = :paymentTerms,suppliersRegistered.supplierPassword = :supplierPassword WHERE suppliersRegistered.supplierNo = :supplierNo");
    $updateSupplierProfile->bindParam(':supplierName',$supplierName, PDO::PARAM_STR);
    $updateSupplierProfile->bindParam(':supplierEmail',$supplierEmail, PDO::PARAM_STR);
    $updateSupplierProfile->bindParam(':supplierPhone',$supplierPhone, PDO::PARAM_STR);
    $updateSupplierProfile->bindParam(':supplierPassword',$supplierPassword, PDO::PARAM_STR);
    $updateSupplierProfile->bindParam(':paymentMethods',$paymentMethods, PDO::PARAM_STR);
    $updateSupplierProfile->bindParam(':paymentTerms',$paymentTerms, PDO::PARAM_STR);
    $updateSupplierProfile->bindParam(':supplierNo',$supplierNo, PDO::PARAM_STR);
    $updateSupplierProfile->execute();
    if ($updateSupplierProfile->execute()) {
        ?>
        <script>
            alert("Update successfull. Login <?php echo $supplierName; ?> to Your New Profile.")
            location="../SUPPLIER/supplierLogin.php"
        </script>
        <?php
        die;
    } else{
        echo "Error! Try again";
    }
}

}
?>