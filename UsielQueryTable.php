<?php
// Usiel Figueroa
// September 20, 2025
// CSD 440-A311 Server-Side Scripting
// Purpose: Query and display data from software_practices table

require_once "db_config.php";

// Prepare select query
$stmt = $conn->prepare("
    SELECT id, language_name, category, used_for, skill_level, completed_project, favorite_order
    FROM software_practices
    ORDER BY favorite_order
");

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Query Table</title>
    <style>
        body { font-family: Arial, sans-serif; background: #ffffffff; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #bab8b8ff; padding: 10px; text-align: left; }
        th { background-color: #333537ff; color: white; }
        tr:nth-child(even) { background-color: #cac8c8ff; }
        h2 { color: #252b31ff; }
    </style>
</head>
<body>
    <h2>Software Development Practices Table</h2>

    <?php if ($result->num_rows > 0): ?>
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
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['language_name']) ?></td>
                    <td><?= htmlspecialchars($row['category']) ?></td>
                    <td><?= htmlspecialchars($row['used_for']) ?></td>
                    <td><?= htmlspecialchars($row['skill_level']) ?></td>
                    <td><a href="<?= htmlspecialchars($row['completed_project']) ?>" target="_blank">Project</a></td>
                    <td><?= htmlspecialchars($row['favorite_order']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No records found.</p>
    <?php endif; ?>
  <div style="text-align: center; margin-top: 20px;">
    <a href="UsielIndex.php">Back to Index</a>
</div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
