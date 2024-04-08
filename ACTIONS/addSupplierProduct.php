<?php
session_start();
require("../CONNECTIONS/inventoryConnection.php");
require("../FUNCTIONS/supplierFunction.php");
if ($conn == null) {
    echo("check your database connection");
} else {

if (isset($_POST['submit'])) {

    $supplierDetails = loginDetails($conn);
    $supplierName = $supplierDetails['supplierName'];
    $productName = filter_var($_POST['productName'], FILTER_SANITIZE_STRING);
    $productQuantity = filter_var($_POST['productQuantity'], FILTER_SANITIZE_STRING);
    $productSellingPrice = filter_var($_POST['productSellingPrice'], FILTER_SANITIZE_STRING);
    $sellingPriceDescription = filter_var($_POST['sellingPriceDescription'], FILTER_SANITIZE_STRING);
    $productDescription = filter_var($_POST['productDescription'], FILTER_SANITIZE_STRING);
    $productTerms = filter_var($_POST['productTerms'], FILTER_SANITIZE_STRING);
    $productId = mt_rand(100000,100000000);

    $addProduct = $conn->prepare("INSERT INTO inventory.supplierProduct(productId,productName,productQuantity,productDescription,productSellingPrice,sellingPriceDescription,productTerms,supplierName) VALUES(:productId,:productName,:productQuantity,:productDescription,:productSellingPrice,:sellingPriceDescription,:productTerms,:supplierName)");
    $addProduct->bindParam(':productId',$productId, PDO::PARAM_INT);
    $addProduct->bindParam(':productName',$productName, PDO::PARAM_STR);
    $addProduct->bindParam(':productQuantity',$productQuantity, PDO::PARAM_STR);
    $addProduct->bindParam(':productDescription',$productDescription, PDO::PARAM_STR);
    $addProduct->bindParam(':productSellingPrice',$productSellingPrice, PDO::PARAM_STR);
    $addProduct->bindParam(':sellingPriceDescription',$sellingPriceDescription, PDO::PARAM_STR);
    $addProduct->bindParam(':productTerms',$productTerms, PDO::PARAM_STR);
    $addProduct->bindParam(':supplierName',$supplierName, PDO::PARAM_STR);
    $addProduct->execute();
    ?>
    <script>
        alert("Thank you <?php echo $supplierName ?> for adding <?php echo $productName ?> to IMS.");
        location="../SUPPLIER/supplierIndex.php";
    </script>
    <?php
    die;
}



}
?>