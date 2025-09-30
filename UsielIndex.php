<?php
// Usiel Figueroa
// September 22, 2025
// CSD 440-A311 Server-Side Scripting
// Module 9 Programming Assignment
// Purpose: Index page with navigation links to other assignment files
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Module 9 - Index</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 2rem; 
            background-color: #e0e0e0; /* light grey background */
            color: #333;
        }
        .container {
            background-color: #ffffff; /* white content area */
            padding: 2rem;
            border-radius: 10px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #0f0f10ff;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        p {
            text-align: center;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }
        ul { 
            list-style: none; 
            padding: 0; 
            text-align: center;
        }
        li { 
            margin: 1rem 0; 
        }
        a { 
            text-decoration: none; 
            color: #004080; 
            font-weight: bold; 
            font-size: 1.1rem;
        }
        a:hover { 
            text-decoration: underline; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Module 9 Assignment - Index</h1>
        <h2>Usiel Figueroa - CSD 440-A311</h2>
        <p>Welcome! This site demonstrates managing software development technologies, skill levels, and projects using PHP and MySQLi.</p>
        <ul>
            <li><a href="UsielQuery.php">Search Records</a></li>
            <li><a href="UsielForm.php">Add a New Record</a></li>
            <li><a href="UsielCreateTable.php">Create Table</a></li>
            <li><a href="UsielPopulateTable.php">Populate Table</a></li>
            <li><a href="UsielQueryTable.php">Query Table</a></li>
            <li><a href="UsielDropTable.php">Drop Table</a></li>
            <li><a href="UsielManage.php">Manage Table</a></li>
            <li><a href="UsielPDF_link.php">Generate PDF</a></li>
        </ul>
    </div>
</body>
</html>
