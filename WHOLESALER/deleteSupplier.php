<?php
require("../CONNECTIONS/inventoryConnection.php");
if ($conn != null) {
$supplierNo=$_GET['supplierNo'];
$supplierDel = $conn->prepare("DELETE FROM inventory.supplierTbl WHERE supplierTbl.supplierNo = :supplierNo");
$supplierDel->bindParam(':supplierNo', $supplierNo, PDO::PARAM_STR);
$supplierDel->execute();
?>
<script>
    alert("Successfully deleted supplier number <?php echo $supplierNo ?>!!");
    location.href = "supplierManagement.php";
</script>
<?php
}else {
    echo "check your connection";
}