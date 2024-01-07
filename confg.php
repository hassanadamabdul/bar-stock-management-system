<?php
// Database configuration
$host = 'localhost'; // Change this to your database host (e.g., 'localhost')
$username = 'root'; // Change this to your database username
$password = ''; // Change this to your database password
$database = 'hi5'; // Change this to your database name

// Create a connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
 hi