<!-- ini form create/edit untuk divisi & fasilitas -->
<!-- file ini dipanggil di create.php & edit.php pada folder /Views/divisions dan /Views/facilities -->
<!-- jadi nanti di kedua file itu, tinggal kirim variabel2 yg dibutuhin -->




<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Tambah Data</h2>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-600">Pilih Jenis Data</label>
                <select name="jenis" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="divisi">Divisi</option>
                    <option value="fasilitas">Fasilitas</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Nama</label>
                <input type="text" name="nama" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit" name="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600">Simpan</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $jenis = $_POST['jenis'];
            $nama = $_POST['nama'];

            if ($jenis == "divisi") {
                header("Location: create_divisi.php?nama=" . urlencode($nama));
            } else {
                header("Location: create_fasilitas.php?nama=" . urlencode($nama));
            }
            exit();
        }
        ?>
    </div>
</body>
</html>
