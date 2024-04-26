<?php
require("../CONNECTIONS/inventoryConnection.php");
if ($conn == null) {
    echo("check your database connection");
} else {
$wholesalerNum = $_GET['wholesalerNum'];
if (isset($_POST['submit'])) {
$wholesalerName = filter_var($_POST['wholesalerName'], FILTER_SANITIZE_STRING);
$wholesalerEmail = filter_var($_POST['wholesalerEmail'], FILTER_SANITIZE_STRING);
$wholesalerPhone = filter_var($_POST['wholesalerPhone'], FILTER_SANITIZE_STRING);
$wholesalerPassword = filter_var($_POST['wholesalerPassword'], FILTER_SANITIZE_STRING);
// $paymentMethods = filter_var($_POST['paymentMethods'], FILTER_SANITIZE_STRING);
// $paymentTerms = filter_var($_POST['paymentTerms'], FILTER_SANITIZE_STRING);

    $updateWholesalerProfile = $conn->prepare("UPDATE inventory.wholesalersRegistered SET wholesalersRegistered.wholesalerName = :wholesalerName,wholesalersRegistered.wholesalerEmail = :wholesalerEmail,wholesalersRegistered.wholesalerPhone = :wholesalerPhone,wholesalersRegistered.wholesalerPassword = :wholesalerPassword WHERE wholesalersRegistered.wholesalerNum = :wholesalerNum");
    $updateWholesalerProfile->bindParam(':wholesalerName',$wholesalerName, PDO::PARAM_STR);
    $updateWholesalerProfile->bindParam(':wholesalerEmail',$wholesalerEmail, PDO::PARAM_STR);
    $updateWholesalerProfile->bindParam(':wholesalerPhone',$wholesalerPhone, PDO::PARAM_STR);
    $updateWholesalerProfile->bindParam(':wholesalerPassword',$wholesalerPassword, PDO::PARAM_STR);
    // $updateWholesalerProfile->bindParam(':paymentTerms',$paymentTerms, PDO::PARAM_STR);
    $updateWholesalerProfile->bindParam(':wholesalerNum',$wholesalerNum, PDO::PARAM_STR);
    $updateWholesalerProfile->execute();
    if ($updateWholesalerProfile->execute()) {
        ?>
        <script>
            alert("Update successfull. Login <?php echo $wholesalerName; ?> to Your New Profile.")
            location="../WHOLESALER/wholesalerLogin.php"
        </script>
        <?php
        die;
    }else{
        echo "Error! Failed to update profile";
    }
}

}
?>