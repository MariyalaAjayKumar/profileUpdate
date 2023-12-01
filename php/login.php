<?php
// Include database connection
include_once 'mysql/db.php'; // Update with your actual database connection file

// Process login data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userId, $dbUsername, $dbPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify password
    if ($dbUsername && password_verify($password, $dbPassword)) {
        // Login successful
        session_start();
        $_SESSION['user_id'] = $userId;
        $response = ['status' => 'success', 'message' => 'Login successful'];
        echo json_encode($response);
    } else {
        // Login failed
        $response = ['status' => 'error', 'message' => 'Invalid username or password'];
        echo json_encode($response);
    }

    // Close the connection
    $conn->close();
} else {
    // Invalid request method
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
