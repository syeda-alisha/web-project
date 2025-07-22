<?php
// Start session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Set header to return JSON
header('Content-Type: application/json');

// Return success response
echo json_encode([
    'success' => true,
    'message' => 'Logged out successfully'
]);
?> 