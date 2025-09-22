
<?php
// Usiel Figueroa
// September 20, 2025
// CSD 440-A311 Server-Side Scripting
// Purpose: Drop software_practices table

require_once "db_config.php";

$sql = "DROP TABLE IF EXISTS software_practices";
if ($conn->query($sql) === TRUE) {
    echo "Table software_practices dropped successfully.";
} else {
    echo "Error dropping table: " . $conn->error;
}

$conn->close();
?>
