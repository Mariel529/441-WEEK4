<?php
// Database configuration
$servername = "sql313.infinityfree.com"; // Replace with your server name or IP address
$username = "if0_37529137"; // Replace with your MySQL username
$password = "hdrcNPsBjn5"; // Replace with your MySQL password
$dbname = "if0_37529137_db_441week4"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$stmt = $conn->prepare("SELECT id, subject, day, time FROM timetable");
$stmt->execute();
$result = $stmt->get_result();

// Close statement
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Timetable Data</h1>
    <?php
    if ($result && $result->num_rows > 0) {
        // Output data of each row
        echo "<table>";
        echo "<tr><th>ID</th><th>Subject</th><th>Day</th><th>Time</th><th>teacher</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["subject"] . "</td>";
            echo "<td>" . $row["day"] . "</td>";
            echo "<td>" . $row["time"] . "</td>";
            echo "<td>" . $row["teacher"] . "</td>";

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found in the timetable table.";
    }
    // Close the database connection
    $conn->close();
    ?>
</body>

</html>