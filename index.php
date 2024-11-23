<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Menangani preflight request (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Menambahkan header untuk izin CORS
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    exit(0); // Menutup preflight request dan keluar
}


header("Access-Control-Allow-Origin: *"); // Mengizinkan akses dari semua origin
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Menambahkan header yang diperlukan untuk permintaan


include('php/db.php');

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/signup' && $requestMethod === 'POST') {
    include('php/signup.php');
} elseif ($requestUri === '/login' && $requestMethod === 'POST') {
    include('php/login.php');
} elseif ($requestUri === '/ppdb' && $requestMethod === 'POST') {
    include('php/ppdb.php');
} elseif ($requestUri === '/valid' && $requestMethod === 'POST') {
    include('php/check_registration.php');
}else {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'Route not found']);
}
