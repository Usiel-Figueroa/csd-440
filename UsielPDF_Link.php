<?php
// Usiel Figueroa
// September 29, 2025
// CSD 440-A311 Server-Side Scripting
// Module 11 Programming Assignment
//
// Purpose: Provide a link/button for users to generate the PDF report
// of the software_practices table from the baseball_01 database.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate PDF Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #cac8c8ff; /* light grey */
            text-align: center;
            padding: 50px;
        }
        h2 {
            color: #003366;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #0073e6;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #005bb5;
        }
        .nav-link {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            color: #003366;
            text-decoration: none;
        }
        .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Generate Software Practices PDF Report</h2>
    <p>Click the button below to create and download the PDF report of the software_practices table.</p>

    <!-- Button to call UsielPDF.php -->
    <a href="UsielPDF.php" class="btn" target="_blank">Generate PDF</a>

    <!-- Link back to index -->
    <a href="UsielIndex.php" class="nav-link">Back to Index</a>
    <div style="text-align: center; margin-top: 20px;">
    <a href="UsielManage.php" class="nav-link">Manage Table</a>
</div>
</body>
</html>
