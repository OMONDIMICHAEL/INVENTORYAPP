<?php

session_start();
header("Location:wholesalerLogin.php");
session_unset();
session_destroy();
die;

?>