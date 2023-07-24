<?php
try {
    $server = "localhost";
    $database = "polizas_funerarias";
    $username = "root";
    $password = "";

    $conn = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage());
}

return array(
    "driver"    => "mysql",
    "host"      => "localhost",
    "user"      => "root",
    "pass"      => "",
    "database"  => "polizas_funerarias",
    "charset"   => "utf8"
);
