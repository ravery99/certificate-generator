<?php
// Ambil nama file dari URL
$filename = $_GET['file'];
$filepath = "../storage/certificates/" . basename($filename);

if (!file_exists($filepath)) {
    die("File tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Sertifikat</title>
</head>
<body>
    <h2>Preview Sertifikat</h2>
    <img src="<?php echo $filepath; ?>" alt="Sertifikat" style="max-width: 100%; height: auto;">
    <br><br>
    <a href="<?php echo $filepath; ?>" download="<?php echo basename($filepath); ?>">
        <button>Unduh Sertifikat</button>
    </a>
</body>
</html>
