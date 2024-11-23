<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

function generateUUID() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid JSON format!'
        ]);
        exit;
    }


    if (isset($data['fullName'], $data['nickname'], $data['gender'], $data['nisn'], $data['nik'], 
            $data['birthPlace'], $data['birthDate'], $data['religion'], $data['bloodType'], 
            $data['homeAddress'], $data['phoneNumber'], $data['registrationEmail'])) {

        $id_user = $data['id_user'];
        $id = generateUUID();
        $fullName = $data['fullName'];
        $nickname = $data['nickname'];
        $gender = $data['gender'];
        $nisn = $data['nisn'];
        $nik = $data['nik'];
        $birthPlace = $data['birthPlace'];
        $birthDate = $data['birthDate'];
        $religion = $data['religion'];
        $bloodType = isset($data['bloodType']) ? $data['bloodType'] : '';
        $homeAddress = $data['homeAddress'];
        $phoneNumber = $data['phoneNumber'];
        $registrationEmail = $data['registrationEmail'];

        $stmt = $conn->prepare("INSERT INTO pendaftaran (id, id_user, nama_lengkap, nama_panggilan, jenis_kelamin, nisn, nik, tempat_lahir, 
                              tanggal_lahir, agama, golongan_darah, alamat_rumah, nomor_hp, email_pendaftaran) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssssssssss", $id, $id_user, $fullName, $nickname, $gender, $nisn, $nik, $birthPlace, 
                          $birthDate, $religion, $bloodType, $homeAddress, $phoneNumber, $registrationEmail);

        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Register successful!',
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to insert data!',
                'error' => $stmt->error
            ]);
        }                        
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Data Not Complete!',
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Method is not POST!',
    ]);
}
?>
