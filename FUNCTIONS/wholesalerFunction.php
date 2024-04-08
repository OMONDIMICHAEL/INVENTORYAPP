<?php
function loginDetails($conn){
    if(isset($_SESSION['wholesalerId'])){
        $wholesaler_id = $_SESSION['wholesalerId'];
        $query = $conn->prepare("SELECT * FROM inventory.wholesalersRegistered where wholesalerId = '$wholesaler_id' limit 1");
        $query->execute();
        $query->rowCount();
            foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $wholesalerDetails) {
                return $wholesalerDetails;
            }
    }
}
?>