<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Training Partisipan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex h-screen bg-gray-100">

    <?php include '../partials/sidebar.php'; ?>

    <div class="flex flex-col flex-1 overflow-y-auto p-8">

        <h1 class="text-3xl font-bold text-gray-700">Tabel Training Partisipan</h1>

        <div class="mt-6 w-40">
            <a href="create_user.php" class="flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-800 
                text-white rounded-md hover:opacity-90 transition duration-300 text-sm 
                active:bg-blue-300 active:text-blue-900 font-semibold shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah User
            </a>
        </div>

        <div class="overflow-hidden rounded-lg shadow-lg bg-white p-6 mt-6">
            <table class="w-full border border-gray-300 rounded-lg text-sm">
                <thead>
                    <tr class="bg-indigo-700 text-white">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Nama</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Training</th>
                        <th class="border border-gray-300 px-4 py-2">Divisi</th>
                        <th class="border border-gray-300 px-4 py-2">Fasilitas</th>
                        <th class="border border-gray-300 px-4 py-2">No Telepon</th>
                        <th class="border border-gray-300 px-4 py-2">Link Sertifikat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $users = [
                        ["id" => 1, "nama" => "Bella Isa", "email" => "nama@example.com", "tanggal_training" => "2024-03-10", "divisi" => "apa", "fasilitas" => "testestestes", "no_telepon" => "081234567890", "link_sertifikat" => "https://example.com/cert1"],
                        ["id" => 2, "nama" => "Lala ", "email" => "lala1@example.com", "tanggal_training" => "2024-04-15", "divisi" => "hayo", "fasilitas" => "Tablet", "no_telepon" => "081298765432", "link_sertifikat" => "https://example.com/cert2"]
                    ];

                    foreach ($users as $user) {
                        echo "<tr class='text-center text-gray-700 hover:bg-gray-200 transition'>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$user['id']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$user['nama']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$user['email']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$user['tanggal_training']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$user['divisi']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$user['fasilitas']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$user['no_telepon']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'><a href='{$user['link_sertifikat']}' target='_blank' class='text-blue-600 hover:underline'>Lihat Sertifikat</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>