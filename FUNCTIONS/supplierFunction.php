<?php
function loginDetails($conn){
    if(isset($_SESSION['supplierId'])){
        $supplier_id = $_SESSION['supplierId'];
        $query = $conn->prepare("SELECT * FROM inventory.suppliersRegistered where supplierId = '$supplier_id' limit 1");
        $query->execute();
        $query->rowCount();
            foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $supplierDetails) {
                return $supplierDetails;
            }
    }
}
?>