<?php
require '../src/helpers/certificate.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

// Debugging: Cek apakah data masuk
$rawData = file_get_contents("php://input");
file_put_contents("debug.log", $rawData . PHP_EOL, FILE_APPEND); // Logging untuk cek payload

$data = json_decode($rawData, true);

// Cek apakah semua data wajib ada
if (
    isset($data['email'], $data['nama_peserta'], $data['tanggal_training'], $data['divisi'], $data['fasilitas_kesehatan'])
) {
    $email = $data['email'];
    $name = $data['nama_peserta'];
    $date = $data['tanggal_training'];
    $division = $data['divisi'];
    $facility = $data['fasilitas_kesehatan'];
    $phone = $data['no_hp'] ?? ''; // Jika tidak ada, set ke string kosong

    // Debugging: Log data setelah parsing
    file_put_contents("debug.log", print_r($data, true) . PHP_EOL, FILE_APPEND);

    // Generate sertifikat
    $file = generateCertificate($name, $date, $division, $facility);

    // Jika data valid, generate sertifikat
    if ($data) {
        $certificateUrl = "http://localhost/certificate-generator/storage/certificates/" . str_replace(' ', '_', $name) . ".png";
        echo json_encode(["status" => "success", "link" => $certificateUrl]);
    } else {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap.", "received" => $data]);
}
?>
