<?php
header("Access-Control-Allow-Origin: *"); // Mengizinkan akses dari semua origin
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Menambahkan header yang diperlukan untuk permintaan


$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

if (empty($username) || empty($password)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Username and password are required']);
    exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    http_response_code(409);
    echo json_encode(['status' => 'error', 'message' => 'Username already exists']);
    $stmt->close();
    $conn->close();
    exit;
}

$stmt->close();

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$uuid = uniqid('', true);

$sql = "INSERT INTO users (id, username, password) VALUES ('$uuid', '$username', '$hashedPassword')";
if ($conn->query($sql) === TRUE) {
    http_response_code(201);
    echo json_encode(['status' => 'success', 'message' => 'User successfully registered']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
}
