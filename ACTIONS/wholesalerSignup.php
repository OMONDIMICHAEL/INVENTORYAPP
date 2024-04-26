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

$wholesalerLogo = $_FILES['wholesalerLogo']['name'];
$wholesalerLogo_type = $_FILES['wholesalerLogo']['type'];
$wholesalerLogo_size = $_FILES['wholesalerLogo']['size'];
$wholesalerLogo_tem_loc = $_FILES['wholesalerLogo']['tmp_name'];
$wholesalerLogo_store = "../WHOLESALER/WHOLESALERIMAGE/WHOLESALERLOGO/".$wholesalerLogo;
$wholesalerLogoExt = $_FILES['wholesalerLogo']['name'];
$logoExtenstion = pathinfo($wholesalerLogoExt, PATHINFO_EXTENSION);
if($logoExtenstion !== 'jpg' && $logoExtenstion !== 'jpeg' && $logoExtenstion !== 'png') {
    ?>
    <script>
        alert("Failed!! Unaccepted image file extension. Use jpg,png,jpeg instead");
        location="../WHOLESALER/wholesalerSignup.php";
    </script>
    <?php
    die();
}
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);
if ($_FILES['wholesalerLogo']['size'] > 5*MB) {
    ?>
    <script>
        alert("Error! The File Is Bigger Than The Maximum(5Mb).");
        location= "../WHOLESALER/wholesalerSignup.php";
    </script>
    <?php
    die();
}

    $checkWholesalerNameRegistration = $conn->prepare("SELECT * FROM inventory.wholesalersRegistered WHERE wholesalersRegistered.wholesalerName = :wholesalerName");
    $checkWholesalerNameRegistration->bindParam(':wholesalerName',$wholesalerName, PDO::PARAM_STR);
    $checkWholesalerNameRegistration->execute();
    if ($checkWholesalerNameRegistration->rowCount() >= 1) {
        ?>
        <script>
            alert("Error! Wholesale Name Already Registered by someone");
            location="../WHOLESALER/wholesalerSignup.php";
        </script>
        <?php
        die();
    }
    $checkWholesalerEmailRegistration = $conn->prepare("SELECT * FROM inventory.wholesalersRegistered WHERE wholesalersRegistered.wholesalerEmail = :wholesalerEmail");
    $checkWholesalerEmailRegistration->bindParam(':wholesalerEmail',$wholesalerEmail, PDO::PARAM_STR);
    $checkWholesalerEmailRegistration->execute();
    if ($checkWholesalerEmailRegistration->rowCount() >= 1) {
        ?>
        <script>
            alert("Error! Email Already Registered by someone");
            location="../WHOLESALER/wholesalerSignup.php";
        </script>
        <?php
        die();
    }$checkWholesalerPhoneRegistration = $conn->prepare("SELECT * FROM inventory.wholesalersRegistered WHERE wholesalersRegistered.wholesalerPhone = :wholesalerPhone");
    $checkWholesalerPhoneRegistration->bindParam(':wholesalerPhone',$wholesalerPhone, PDO::PARAM_STR);
    $checkWholesalerPhoneRegistration->execute();
    if ($checkWholesalerPhoneRegistration->rowCount() >= 1) {
        ?>
        <script>
            alert("Error! Phone Number Already Registered by someone");
            location="../WHOLESALER/wholesalerSignup.php";
        </script>
        <?php
        die();
    }
    $regwholesaler = $conn->prepare("INSERT INTO inventory.wholesalersRegistered(wholesalerName,wholesalerEmail,wholesalerPhone,wholesalerPassword,wholesalerLogo,wholesalerLogoPath) VALUES(:wholesalerName,:wholesalerEmail,:wholesalerPhone,:wholesalerPassword,:wholesalerLogo,:wholesalerLogoPath)");
    $regwholesaler->bindParam(':wholesalerName',$wholesalerName, PDO::PARAM_STR);
    $regwholesaler->bindParam(':wholesalerEmail',$wholesalerEmail, PDO::PARAM_STR);
    $regwholesaler->bindParam(':wholesalerPhone',$wholesalerPhone, PDO::PARAM_STR);
    $regwholesaler->bindParam(':wholesalerPassword',$wholesalerPassword, PDO::PARAM_STR);
    $regwholesaler->bindParam(':wholesalerLogo',$wholesalerLogo);
    $regwholesaler->bindParam(':wholesalerLogoPath',$wholesalerLogo_store);
    move_uploaded_file($wholesalerLogo_tem_loc,$wholesalerLogo_store);
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