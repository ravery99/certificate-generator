<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Fasilitas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex h-screen bg-gray-50">

    <?php include 'sidebar.php'; ?>

    <div class="flex flex-col flex-1 overflow-y-auto p-8">

        <h1 class="text-3xl font-bold text-gray-800">Tabel Fasilitas</h1>

        <div class="mt-6 w-40">
            <a href="create_fasilitas.php" class="flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 
                text-white rounded-md hover:opacity-90 transition duration-300 text-sm 
                active:bg-purple-300 active:text-purple-900 font-semibold shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Fasilitas
            </a>
        </div>

        <div class="overflow-hidden rounded-lg shadow-lg bg-white p-6 mt-6">
            <table class="w-full border border-gray-300 rounded-lg text-sm">
                <thead>
                    <tr class="bg-pink-700 text-white">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Fasilitas</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fasilitas = [
                        ["id" => 1, "nama_fasilitas" => "Laptop"],
                        ["id" => 2, "nama_fasilitas" => "Proyektor"],
                        ["id" => 3, "nama_fasilitas" => "Ruang Meeting"]
                    ];

                    foreach ($fasilitas as $item) {
                        echo "<tr class='text-center text-gray-700 hover:bg-gray-200 transition'>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$item['id']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$item['nama_fasilitas']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2 flex justify-center space-x-2'>
                                <a href='edit.php?id={$item['id']}' class='bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition shadow-md text-sm'>Edit</a>
                                <a href='delete.php?id={$item['id']}' class='bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition shadow-md text-sm'>Hapus</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
