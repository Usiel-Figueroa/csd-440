
<?php
// Usiel Figueroa
// September 20, 2025
// CSD 440-A311 Server-Side Scripting
// Purpose: Create software_practices table

require_once "db_config.php";

// Drop table if exists (safely)
$conn->query("DROP TABLE IF EXISTS software_practices");

// Create table
$sql = "
CREATE TABLE software_practices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    language_name VARCHAR(50) NOT NULL,
    category VARCHAR(50) NOT NULL,
    used_for VARCHAR(400),
    skill_level VARCHAR(20),
    completed_project VARCHAR(255),
    favorite_order INT
)";

if ($conn->query($sql) === TRUE) {
    echo "Table software_practices created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
