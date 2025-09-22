<?php
// Usiel Figueroa
// September 22, 2025
// CSD 440-A311 Server-Side Scripting
// Purpose: Provide a form to add new records into software_practices table

require_once "db_config.php";

$insertMessage = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $languageName   = trim($_POST["language_name"]);
    $category       = trim($_POST["category"]);
    $usedFor        = trim($_POST["used_for"]);
    $skillLevel     = trim($_POST["skill_level"]);
    $completedProj  = trim($_POST["completed_project"]);
    $favoriteOrder  = intval($_POST["favorite_order"]);

    $stmt = $conn->prepare("
        INSERT INTO software_practices 
        (language_name, category, used_for, skill_level, completed_project, favorite_order)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    if ($stmt) {
        $stmt->bind_param("sssssi", $languageName, $category, $usedFor, $skillLevel, $completedProj, $favoriteOrder);
        if ($stmt->execute()) {
            $insertMessage = "Record for $languageName added successfully.";
        } else {
            $insertMessage = "Error inserting record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $insertMessage = "Prepare failed: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Language</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 500px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px; background-color: #007BFF; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .message { margin-top: 15px; font-weight: bold; color: green; }
    </style>
</head>
<body>
    <h2>Add New Language Record</h2>

    <?php if ($insertMessage): ?>
        <div class="message"><?= htmlspecialchars($insertMessage) ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="language_name">Language Name:</label>
        <input type="text" name="language_name" id="language_name" required>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required>

        <label for="used_for">Used For:</label>
        <input type="text" name="used_for" id="used_for" required>

        <label for="skill_level">Skill Level:</label>
        <select name="skill_level" id="skill_level" required>
            <option value="">--Select--</option>
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Advanced">Advanced</option>
        </select>

        <label for="completed_project">Completed Project (link):</label>
        <input type="url" name="completed_project" id="completed_project" placeholder="https://example.com/project">

        <label for="favorite_order">Favorite Order:</label>
        <input type="number" name="favorite_order" id="favorite_order" min="1" required>

        <button type="submit">Add Record</button>
    </form>
    <div style="text-align: center; margin-top: 20px;">
    <a href="UsielIndex.php">Back to Index</a>
</div>
</body>
</html>
<?php $conn->close(); ?>
