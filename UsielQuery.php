<?php
// Usiel Figueroa
// September 22, 2025
// CSD 440-A311 Server-Side Scripting
// Purpose: Query software_practices table based on user input

require_once "db_config.php";

$results = null;
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $searchLanguage = trim($_POST["language_name"]);

    if (!empty($searchLanguage)) {
        $stmt = $conn->prepare("
            SELECT id, language_name, category, used_for, skill_level, completed_project, favorite_order 
            FROM software_practices 
            WHERE language_name LIKE ?
        ");

        $likeSearch = "%" . $searchLanguage . "%";
        $stmt->bind_param("s", $likeSearch);
        $stmt->execute();
        $results = $stmt->get_result();

        if ($results->num_rows === 0) {
            $message = "No results found for \"" . htmlspecialchars($searchLanguage) . "\".";
        }

        $stmt->close();
    } else {
        $message = "Please enter a language name to search.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Query Software Practices</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 20px; }
        input[type="text"] { padding: 8px; width: 250px; }
        button { padding: 8px 12px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .message { margin-top: 15px; font-weight: bold; color: red; }
        a { display: inline-block; margin-top: 15px; }
    </style>
</head>
<body>
    <h2>Search Software Practices</h2>

    <form method="post" action="">
        <label for="language_name">Enter Language Name:</label>
        <input type="text" id="language_name" name="language_name" required>
        <button type="submit">Search</button>
    </form>

    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <?php if ($results && $results->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Language Name</th>
                <th>Category</th>
                <th>Used For</th>
                <th>Skill Level</th>
                <th>Completed Project</th>
                <th>Favorite Order</th>
            </tr>
            <?php while ($row = $results->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['language_name']) ?></td>
                    <td><?= htmlspecialchars($row['category']) ?></td>
                    <td><?= htmlspecialchars($row['used_for']) ?></td>
                    <td><?= htmlspecialchars($row['skill_level']) ?></td>
                    <td><a href="<?= htmlspecialchars($row['completed_project']) ?>" target="_blank">View</a></td>
                    <td><?= htmlspecialchars($row['favorite_order']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>

    <a href="UsielIndex.php">Back to Index</a>
</body>
</html>
<?php $conn->close(); ?>
