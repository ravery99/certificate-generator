<?php
// Ambil nama file dari parameter GET dengan keamanan tambahan
$filename = isset($_GET['file']) ? basename($_GET['file']) : '';
$filepath = "../storage/certificates/" . $filename;

// Cek apakah file ada
if (!file_exists($filepath) || empty($filename)) {
    die("File tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Sertifikat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        

        .container-custom {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
            padding: 50px;
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        .text-section h1 {
            font-size: 3rem;
            background: linear-gradient(45deg, #003366, rgb(24, 127, 51));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }

        .text-section p {
            color: #555;
            font-size: 1.5rem;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .container-custom {
                max-width: 95%;
                padding: 30px;
            }

            .text-section h1 {
                font-size: 2.5rem;
            }

            .text-section p {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>

    <div class="container-custom">
        <div class="text-section">
            <h1>Mohon Maaf!!</h1>
            <p>Sertifikat tidak dapat diakses karena masa unduhan telah melewati batas 30 hari.</p>
        </div>
    </div>

</body>
</html>
