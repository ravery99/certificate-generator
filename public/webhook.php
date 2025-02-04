<?php
require '../src/helpers/certificate.php';
require '../src/helpers/email.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (
    isset($data['email']) && isset($data['name']) &&
    isset($data['date']) && isset($data['division']) &&
    isset($data['facility']) && isset($data['phone'])
) {
    $email = $data['email'];
    $name = $data['name'];
    $date = $data['date'];
    $division = $data['division'];
    $facility = $data['facility'];
    $phone = $data['phone'];

    // Generate sertifikat
    $file = generateCertificate($name, $date, $division, $facility);

    // Kirim email
    if (sendCertificate($email, $file)) {
        echo json_encode(["status" => "success", "message" => "Sertifikat terkirim!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal mengirim email."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap."]);
}
?>
