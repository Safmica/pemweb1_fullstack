<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

if (empty($username) || empty($password)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Username and password are required']);
    exit;
}

$sql = "SELECT id, username, password FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPasswordFromDB = $row['password'];

    if (password_verify($password, $hashedPasswordFromDB)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Login successful!',
            'user_id' => $row['id'],
            'username' => $row['username']
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid password.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Username not found.'
    ]);
}