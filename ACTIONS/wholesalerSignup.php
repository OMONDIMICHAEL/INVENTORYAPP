<?php
require("../CONNECTIONS/inventoryConnection.php");
if ($conn == null) {
    echo("check your database connection");
} else {

if (isset($_POST['submit'])) {
$wholesalerName = filter_var($_POST['wholesalerName'], FILTER_SANITIZE_STRING);
$wholesalerEmail = filter_var($_POST['wholesalerEmail'], FILTER_SANITIZE_STRING);
$wholesalerPhone = filter_var($_POST['wholesalerPhone'], FILTER_SANITIZE_STRING);
$wholesalerPassword = filter_var($_POST['wholesalerPassword'], FILTER_SANITIZE_STRING);

    $regwholesaler = $conn->prepare("INSERT INTO inventory.wholesalersRegistered(wholesalerName,wholesalerEmail,wholesalerPhone,wholesalerPassword) VALUES(:wholesalerName,:wholesalerEmail,:wholesalerPhone,:wholesalerPassword)");
    $regwholesaler->bindParam(':wholesalerName',$wholesalerName, PDO::PARAM_STR);
    $regwholesaler->bindParam(':wholesalerEmail',$wholesalerEmail, PDO::PARAM_STR);
    $regwholesaler->bindParam(':wholesalerPhone',$wholesalerPhone, PDO::PARAM_STR);
    $regwholesaler->bindParam(':wholesalerPassword',$wholesalerPassword, PDO::PARAM_STR);
    $regwholesaler->execute();
    ?>
    <script>
        alert("Thank you <?php echo $wholesalerName; ?> for Registering.")
        location="../WHOLESALER/wholesalerLogin.php"
    </script>
    <?php
    die;
}



}
?>