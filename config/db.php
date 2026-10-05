<?php

$secrets = require __DIR__ . '/secrets.php';

$host = $secrets['db_host'];
$user = $secrets['db_user'];
$password = $secrets['db_password'];
$database = $secrets['db_name'];

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database Connection Failed : " . $conn->connect_error);
}

?>
