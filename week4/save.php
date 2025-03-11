<?php
// Database configuration
$host = 'sql313.infinityfree.com'; // Replace with your host
$dbname = 'if0_37529137_db_441week4';  // Replace with your database name
$username = 'if0_37529137';  // Replace with your MySQL username
$password = 'hdrcNPsBjn5';      // Replace with your MySQL password
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read JSON data from POST request
$data = file_get_contents('php://input');
$classes = json_decode($data, true);

if (!empty($classes)) {
    // Prepare SQL statement with all fields (subject, day, time, teacher)
    $stmt = $conn->prepare("INSERT INTO timetable (subject, day, time, teacher) VALUES (?, ?, ?, ?)");

    foreach ($classes as $class) {
        $subject = $class['subject'];
        $day = $class['day'];
        $time = $class['time'];
        $teacher = $class['teacher']; // Include teacher data

        // Bind parameters and execute
        $stmt->bind_param("ssss", $subject, $day, $time, $teacher);

        if (!$stmt->execute()) {
            echo json_encode(['status' => 'error', 'message' => 'Error inserting data: ' . $stmt->error]);
            exit;
        }
    }

    // Close statement
    $stmt->close();

    // Return success response
    echo json_encode(['status' => 'success', 'message' => 'Data saved successfully!']);
} else {
    // Return error response if no data received
    echo json_encode(['status' => 'error', 'message' => 'No data received!']);
}

// Close database connection
$conn->close();
?>