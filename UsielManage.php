<?php
// Usiel Figueroa
// September 30, 2025
// CSD 440-A311 Server-Side Scripting
// Purpose: Manage software_practices table - View, Add, Edit, Delete rows

require_once "db_config.php";

// --- Handle POST actions ---

// Add new row
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $stmt = $conn->prepare("
        INSERT INTO software_practices
        (language_name, category, used_for, skill_level, completed_project, favorite_order)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        "sssssi",
        $_POST['language_name'],
        $_POST['category'],
        $_POST['used_for'],
        $_POST['skill_level'],
        $_POST['completed_project'],
        $_POST['favorite_order']
    );
    $stmt->execute();
    $stmt->close();
}

// Update existing row
if (isset($_POST['action']) && $_POST['action'] === 'edit') {
    $stmt = $conn->prepare("
        UPDATE software_practices
        SET language_name=?, category=?, used_for=?, skill_level=?, completed_project=?, favorite_order=?
        WHERE id=?
    ");
    $stmt->bind_param(
        "sssssii",
        $_POST['language_name'],
        $_POST['category'],
        $_POST['used_for'],
        $_POST['skill_level'],
        $_POST['completed_project'],
        $_POST['favorite_order'],
        $_POST['id']
    );
    $stmt->execute();
    $stmt->close();
}

// Delete row
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $stmt = $conn->prepare("DELETE FROM software_practices WHERE id=?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    $stmt->close();
}

// --- Fetch all rows ---
$result = $conn->query("SELECT * FROM software_practices ORDER BY favorite_order");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Software Practices</title>
<style>
body { font-family: Arial, sans-serif; margin: 20px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
th { background: #333; color: white; }
tr:nth-child(even) { background: #f2f2f2; }
form { margin: 0; }
input[type="text"], input[type="number"] { width: 100%; }
button { padding: 4px 8px; }
</style>
</head>
<body>
<h2>Manage Software Practices Table</h2>

<!-- Add New Row Form -->
<h3>Add New Row</h3>
<form method="post">
<input type="hidden" name="action" value="add">
<table>
<tr>
<td><input type="text" name="language_name" placeholder="Language Name" required></td>
<td><input type="text" name="category" placeholder="Category" required></td>
<td><input type="text" name="used_for" placeholder="Used For"></td>
<td><input type="text" name="skill_level" placeholder="Skill Level"></td>
<td><input type="text" name="completed_project" placeholder="Project URL"></td>
<td><input type="number" name="favorite_order" placeholder="Favorite Order"></td>
<td><button type="submit">Add</button></td>
</tr>
</table>
</form>

<!-- Display Existing Rows -->
<h3>Existing Rows</h3>
<table>
<tr>
<th>ID</th>
<th>Language Name</th>
<th>Category</th>
<th>Used For</th>
<th>Skill Level</th>
<th>Completed Project</th>
<th>Favorite Order</th>
<th>Actions</th>
</tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
<form method="post">
<input type="hidden" name="id" value="<?= $row['id'] ?>">
<td><?= $row['id'] ?></td>
<td><input type="text" name="language_name" value="<?= htmlspecialchars($row['language_name']) ?>"></td>
<td><input type="text" name="category" value="<?= htmlspecialchars($row['category']) ?>"></td>
<td><input type="text" name="used_for" value="<?= htmlspecialchars($row['used_for']) ?>"></td>
<td><input type="text" name="skill_level" value="<?= htmlspecialchars($row['skill_level']) ?>"></td>
<td><input type="text" name="completed_project" value="<?= htmlspecialchars($row['completed_project']) ?>"></td>
<td><input type="number" name="favorite_order" value="<?= $row['favorite_order'] ?>"></td>
<td>
<button type="submit" name="action" value="edit">Save</button>
<button type="submit" name="action" value="delete" onclick="return confirm('Are you sure?')">Delete</button>
</td>
</form>
</tr>
<?php endwhile; ?>
</table>
<div style="text-align: center; margin-top: 20px;">
    <a href="UsielIndex.php">Back to Index</a>
</div>
<div style="text-align: center; margin-top: 20px;">
    <a href="UsielPDF_link.php" class="nav-link">PDF</a>
</div>
</body>
</html>
<?php $conn->close(); ?>
