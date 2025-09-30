<?php
// Usiel Figueroa
// September 29, 2025
// CSD 440-A311 Server-Side Scripting
// Module 11 Programming Assignment
//
// Purpose: Provide a MySQLi connection to the baseball_01 database
// for use in PDF generation and queries.

// Enable error reporting for development (can be turned off in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection settings
$servername = "localhost";
$username   = "student1";
$password   = "pass";
$dbname     = "baseball_01";
$port       = 3307;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
