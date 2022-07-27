<?php

$host = 'localhost';
$dbname = 'agenda';
$user = 'root';
$pass = '';

try {

    $conn = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    $errorMsg = $e->getMessage();
    echo "ERRO: $errorMsg";
}