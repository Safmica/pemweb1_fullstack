<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Mendapatkan data yang dikirim dari frontend
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

// Memeriksa jika username dan password tidak kosong
if (empty($username) || empty($password)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Username and password are required']);
    exit;
}

// SQL untuk mencari pengguna berdasarkan username
$sql = "SELECT id, username, password FROM users WHERE username = '$username'";
$result = $conn->query($sql);

// Memeriksa jika pengguna ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPasswordFromDB = $row['password'];

    // Memverifikasi password yang dimasukkan dengan password yang ada di database
    if (password_verify($password, $hashedPasswordFromDB)) {
        // Login berhasil, kirimkan user_id dan username sebagai respons JSON
        echo json_encode([
            'status' => 'success',
            'message' => 'Login successful!',
            'user_id' => $row['id'],
            'username' => $row['username']
        ]);
    } else {
        // Jika password tidak cocok
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid password.'
        ]);
    }
} else {
    // Jika username tidak ditemukan
    echo json_encode([
        'status' => 'error',
        'message' => 'Username not found.'
    ]);
}