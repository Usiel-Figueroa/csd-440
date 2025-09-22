<?php
// Usiel Figueroa
// September 13, 2025
// CSD 440-A311 Server-Side Scripting
// Database configuration file for Module 8 Assignment
// Purpose: Provide MySQLi connection to baseball_01 database
?>

<?php
// Database connection 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username   = "student1";
$password   = "pass";
$dbname     = "baseball_01";
$port       = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connection successful!";
}
?>

