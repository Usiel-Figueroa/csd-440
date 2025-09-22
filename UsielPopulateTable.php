<?php
// Usiel Figueroa
// September 20, 2025
// CSD 440-A311 Server-Side Scripting
// Purpose: Populate software_practices table with sample data using prepared statements

require_once "db_config.php";

// Define data set
$data = [
    ["Java", "Programming Language", "Enterprise applications", "Advanced", "https://usiel-figueroa.github.io/Usiel-profile-site/projects.html", 1],
    ["Python", "Programming Language", "Data science, scripting", "Advanced", "https://usiel-figueroa.github.io/Usiel-profile-site/projects.html", 2],
    ["CSS", "Stylesheet Language", "Web styling", "Advanced", "https://usiel-figueroa.github.io/Usiel-profile-site/projects.html", 3],
    ["HTML", "Markup Language", "Web structure", "Advanced", "https://usiel-figueroa.github.io/Usiel-profile-site/projects.html", 4],
    ["JavaScript", "Programming Language", "Interactive web pages", "Intermediate", "https://usiel-figueroa.github.io/Usiel-profile-site/projects.html", 5],
    ["PHP", "Programming Language", "Server-side scripting", "Intermediate", "https://usiel-figueroa.github.io/Usiel-profile-site/projects.html", 6],
];

// Prepare insert statement
$stmt = $conn->prepare("
    INSERT INTO software_practices 
    (language_name, category, used_for, skill_level, completed_project, favorite_order)
    VALUES (?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters (5 strings + 1 integer)
$stmt->bind_param("sssssi", $name, $category, $used_for, $skill, $project, $favorite_order);

// Loop through and execute
foreach ($data as $row) {
    [$name, $category, $used_for, $skill, $project, $favorite_order] = $row;
    if (!$stmt->execute()) {
        echo "Error inserting $name: " . $stmt->error . "<br>";
    } else {
        echo "Inserted: $name<br>";
    }
}

$stmt->close();
$conn->close();
?>

