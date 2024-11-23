<?php
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id']) || empty($data['id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'You must log in to access this page.'
    ]);
    exit;
}

$id = $data['id'];

$stmt = $conn->prepare("SELECT id FROM pendaftaran WHERE id_user = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode([
        'status' => 'success',
        'message' => 'You have already registered.',
        'id'=> $id,
        'registered' => true
    ]);
} else {
    echo json_encode([
        'status' => 'success',
        'message' => 'You can fill the registration form.',
        'registered' => false
    ]);
}

$stmt->close();
?>
