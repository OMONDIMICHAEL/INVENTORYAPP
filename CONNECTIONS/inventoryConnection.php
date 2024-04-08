<?php
// $conn = mysqli_connect('localhost','root','root254.','inventory');
// if(mysqli_connect_errno()){
//     die('connection failed,' .mysqli_connect_error());
// }
// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// $servername = "localhost";
// $username = "root";
// $password = "root254.";
// $dbname = "inventory";

// Create connection
// $conn = new mysqli_connect($servername, $username, $password, $dbname);

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
$host = "localhost";
$db = "inventory";
$user = "root";
$password = "root254.";
// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@

try {
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$password);
} catch (PDOException $err) {
    echo("con prob" . $err->getMessage());
}

// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// $conn = "mysql:host=$host;dbname=$db;charset=UTF8";

// try {
//     $conn = new PDO("mysql:host=" . $host . "; dbname=" . $db ,$user,$password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connected successfully";
// } catch(PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
// @@@@@@@@@@@@@@@
	// $pdo = new PDO($conn, $user, $password);

// 	if ($pdo) {
// 		//echo "Connected to the $db database successfully!";
// 	}
// } catch (PDOException $e) {
// 	echo $e->getMessage();
// }

?>