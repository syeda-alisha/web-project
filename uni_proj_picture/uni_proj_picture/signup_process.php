<?php
// Include database connection
include 'db.php';

// Set header to return JSON
header('Content-Type: application/json');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data and sanitize inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    // Handle picture upload
    $picture_filename = null;
    if (isset($_FILES['picture'])) {
        if ($_FILES['picture']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode([
                'success' => false,
                'message' => 'Upload error: ' . $_FILES['picture']['error']
            ]);
            exit();
        }
        $upload_dir = __DIR__ . '/picture/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
        $picture_filename = uniqid('img_') . '.' . $ext;
        $upload_path = $upload_dir . $picture_filename;
        if (!move_uploaded_file($_FILES['picture']['tmp_name'], $upload_path)) {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to move uploaded file.'
            ]);
            exit();
        }
        
    }
    
    // Validate inputs
    if (empty($name) || empty($email) || empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => 'All fields are required!'
        ]);
        exit();
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'message' => 'Please enter a valid email address!'
        ]);
        exit();
    }
    
    // Check if email already exists
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email);
    
    if ($result->num_rows > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Email already exists! Please use a different email.'
        ]);
        exit();
    }
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert user data into database
    $sql = "INSERT INTO users (name, email, password, picture) VALUES ('$name', '$email', '$hashed_password', '$picture_filename')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            'success' => true,
            'message' => 'Registration successful! Please login.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $conn->error
        ]);
    }
    
} else {
    // If someone tries to access this file directly without form submission
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}

$conn->close();
?> 