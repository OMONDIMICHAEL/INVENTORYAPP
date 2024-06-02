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

$supplierLogo = $_FILES['supplierLogo']['name'];
$supplierLogo_type = $_FILES['supplierLogo']['type'];
$supplierLogo_size = $_FILES['supplierLogo']['size'];
$supplierLogo_tem_loc = $_FILES['supplierLogo']['tmp_name'];
$supplierLogo_store = "../SUPPLIER/SUPPLIERIMAGE/SUPPLIERLOGO/".$supplierLogo;
$supplierLogoExt = $_FILES['supplierLogo']['name'];
$logoExtenstion = pathinfo($supplierLogoExt, PATHINFO_EXTENSION);
if($logoExtenstion !== 'jpg' && $logoExtenstion !== 'jpeg' && $logoExtenstion !== 'png') {
    ?>
    <script>
        alert("Failed!! Unaccepted image file extension. Use jpg,png,jpeg instead");
        location="../SUPPLIER/supplierLogin.php";
    </script>
    <?php
    die();
}
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);
if ($_FILES['supplierLogo']['size'] > 5*MB) {
    ?>
    <script>
        alert("Error! The File Is Bigger Than The Maximum(5Mb).");
        location= "../SUPPLIER/supplierLogin.php";
    </script>
    <?php
    die();
}

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
    try{
        $checkSupplierNameRegistration = $conn->prepare("SELECT * FROM inventory.suppliersRegistered WHERE suppliersRegistered.supplierName = :supplierName");
        $checkSupplierNameRegistration->bindParam(':supplierName', $supplierName, PDO::PARAM_STR);
        $checkSupplierNameRegistration->execute();
        if ($checkSupplierNameRegistration->rowCount() >= 1) {
            ?>
            <script>
                alert("Error! Supplier Name Already Registered by someone");
                location="../SUPPLIER/supplierLogin.php";
            </script>
            <?php
            die();
        }
    } catch (PDOException $e) {
        // Handle PDOException
        echo "Error: " . $e->getMessage();
    }
    $checkSupplierEmailRegistration = $conn->prepare("SELECT * FROM inventory.suppliersRegistered WHERE suppliersRegistered.supplierEmail = :supplierEmail");
    $checkSupplierEmailRegistration->bindParam(':supplierEmail',$supplierEmail, PDO::PARAM_STR);
    $checkSupplierEmailRegistration->execute();
    if ($checkSupplierEmailRegistration->rowCount() >= 1) {
        ?>
        <script>
            alert("Error! Email Already Registered by someone");
            location="../SUPPLIER/supplierLogin.php";
        </script>
        <?php
        die();
    }
    $checkSupplierPhoneRegistration = $conn->prepare("SELECT * FROM inventory.suppliersRegistered WHERE suppliersRegistered.supplierPhone = :supplierPhone");
    $checkSupplierPhoneRegistration->bindParam(':supplierPhone',$supplierPhone, PDO::PARAM_STR);
    $checkSupplierPhoneRegistration->execute();
    if ($checkSupplierPhoneRegistration->rowCount() >= 1) {
        ?>
        <script>
            alert("Error! Phone Number Already Registered by someone");
            location="../SUPPLIER/supplierLogin.php";
        </script>
        <?php
        die();
    }

    $regSupplier = $conn->prepare("INSERT INTO inventory.suppliersRegistered(supplierName,supplierEmail,supplierPhone,paymentMethods,paymentTerms,supplierPassword,supplierLogo,supplierLogoPath) VALUES(:supplierName,:supplierEmail,:supplierPhone,:paymentMethods,:paymentTerms,:supplierPassword,:supplierLogo,:supplierLogoPath)");
    $regSupplier->bindParam(':supplierName',$supplierName, PDO::PARAM_STR);
    $regSupplier->bindParam(':supplierEmail',$supplierEmail, PDO::PARAM_STR);
    $regSupplier->bindParam(':supplierPhone',$supplierPhone, PDO::PARAM_STR);
    $regSupplier->bindParam(':paymentMethods',$paymentMethods, PDO::PARAM_STR);
    $regSupplier->bindParam(':paymentTerms',$paymentTerms, PDO::PARAM_STR);
    $regSupplier->bindParam(':supplierPassword',$supplierPassword, PDO::PARAM_STR);
    $regSupplier->bindParam(':supplierLogo',$supplierLogo);
    $regSupplier->bindParam(':supplierLogoPath',$supplierLogo_store);
    move_uploaded_file($supplierLogo_tem_loc,$supplierLogo_store);
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