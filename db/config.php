<?php
session_start();

$db_host = "localhost:3306";
$db_user = "root";
$db_pass = "";
$db_name = "presenskiel-db";

$isdev = true;
$devtime = date("2022-11-28 07:10:00");

try {    
    //create PDO connection 
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}
