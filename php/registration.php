<?php
// Include database connection
include_once 'mysql/db.php'; // Update with your actual database connection file

// Process registration data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        // Registration successful
        $response = ['status' => 'success', 'message' => 'Registration successful'];
        echo json_encode($response);
    } else {
        // Registration failed
        $response = ['status' => 'error', 'message' => 'Registration failed'];
        echo json_encode($response);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request method
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
