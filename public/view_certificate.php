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
        }

        .container-custom {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            padding: 40px;
            width: 100%;
            max-width: 1500px;
            height: auto;
            margin: auto;
            box-sizing: border-box; /* Untuk memastikan padding tidak mempengaruhi lebar */
        }

        .text-section {
            flex: 1;
            padding: 50px;
        }

        .text-section h1 {
            font-size: 48px;
            background: linear-gradient(45deg, #003366, rgb(24, 127, 51));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }

        .text-section p {
            color: #555;
            font-size: 22px;
            margin-top: 20px;
        }

        .btn-download {
            display: inline-block;
            background: #003366;
            color: white;
            padding: 16px 26px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 22px;
            font-weight: bold;
            transition: 0.3s;
            margin-top: 25px;
        }

        .btn-download:hover {
            background: rgb(24, 127, 51);
        }

        .image-section {
            flex: 1.5;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #003366, rgb(24, 127, 51));
            border-radius: 20px;
            padding: 50px;
            position: relative;
            max-width: 100%;
        }

        .image-section img {
            max-width: 100%;
            max-height: 600px;
            object-fit: contain;
            border-radius: 15px;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.25);
        }

        .decor {
            position: absolute;
            right: 25px;
            bottom: 25px;
            width: 60px;
            height: 60px;
            background-color: white;
            border-radius: 50%;
            opacity: 0.3;
        }

        /* Responsivitas */
        @media (max-width: 1024px) {
            .container-custom {
                flex-direction: column;
                padding: 30px;
                max-width: 90%;
                margin: 20px; /* Menambahkan margin supaya ada ruang di kanan dan kiri */
            }

            .text-section {
                padding: 30px;
                text-align: center;
            }

            .text-section h1 {
                font-size: 36px;
            }

            .text-section p {
                font-size: 20px;
            }

            .btn-download {
                font-size: 20px;
                padding: 14px 24px;
            }

            .image-section {
                padding: 40px;
            }

            .image-section img {
                max-height: 500px;
            }
        }

        @media (max-width: 768px) {
            .container-custom {
                flex-direction: column;
                padding: 20px 15px;
                margin: 15px; /* Memberikan ruang di kiri dan kanan */
                max-width: 100%;
            }

            .text-section {
                padding: 20px;
                text-align: center;
            }

            .text-section h1 {
                font-size: 30px;
            }

            .text-section p {
                font-size: 18px;
            }

            .btn-download {
                font-size: 18px;
                padding: 12px 22px;
            }

            .image-section img {
                max-height: 400px;
            }
        }

        @media (max-width: 480px) {
            .container-custom {
                padding: 15px;
                margin: 10px; /* Margin untuk memberikan ruang di sisi kiri dan kanan */
                max-width: 100%;
            }

            .text-section h1 {
                font-size: 26px;
            }

            .text-section p {
                font-size: 14px;
            }

            .btn-download {
                font-size: 16px;
                padding: 12px 20px;
            }

            .image-section img {
                max-height: 300px;
            }
        }
    </style>
</head>
<body>

    <div class="container-custom">
        <div class="text-section">
            <h1>Preview Sertifikat</h1>
            <p>Silakan unduh sekarang sebelum kedaluwarsa! Sertifikat hanya dapat diunduh dalam 30 hari, jadi pastikan untuk menyimpannya sebelum waktu habis</p>
            <a href="<?php echo htmlspecialchars($filepath); ?>" download="<?php echo htmlspecialchars($filename); ?>" class="btn-download">
                Unduh Sertifikat
            </a>
        </div>
        <div class="image-section">
            <img src="<?php echo htmlspecialchars($filepath); ?>" alt="Sertifikat">
            <div class="decor"></div>
        </div>
    </div>

</body>

</html>

