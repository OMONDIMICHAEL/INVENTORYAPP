<?php

session_start();
header("Location:supplierLogin.php");
session_unset();
session_destroy();
die;

?>