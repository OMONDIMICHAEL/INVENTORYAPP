<?php
$host = "localhost";
$db = "inventory";
$user = "root";
$password = "root254.";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    echo("con prob" . $err->getMessage());
}

?>