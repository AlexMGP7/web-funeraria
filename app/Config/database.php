<?php

// Define the database connection parameters
$db_host = 'localhost';
$db_name = 'polizas_funerarias';
$db_username = 'root';
$db_password = '';

// Create a new database connection
$db = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check if the connection was successful
if ($db->connect_error) {
    die('Error connecting to the database: ' . $db->connect_error);
}

// Set the database encoding
$db->set_charset('utf8');

// Return the database connection object
return $db;

?>
