<?php
$host = "sql109.infinityfree.com";
$db = "if0_41605610_if0_1234";
$user = "if0_41605610";
$pass = "Manzana24680";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>