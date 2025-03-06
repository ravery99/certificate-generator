<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Divisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex h-screen bg-gray-100">

    <?php include '../partials/sidebar.php'; ?>

    <div class="flex flex-col flex-1 overflow-y-auto p-8">

        <h1 class="text-3xl font-bold text-gray-700">Tabel Divisi</h1>

        <div class="mt-6 w-40">
            <a href="create_divisi.php" class="flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-800 
                text-white rounded-md hover:opacity-90 transition duration-300 text-sm 
                active:bg-blue-300 active:text-blue-900 font-semibold shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Divisi
            </a>
        </div>

        <div class="overflow-hidden rounded-lg shadow-lg bg-white p-6 mt-6">
            <table class="w-full border border-gray-300 rounded-lg text-sm">
                <thead>
                    <tr class="bg-indigo-700 text-white">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Divisi</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $divisions = [
                        ["id" => 1, "nama_divisi" => "IT"],
                        ["id" => 2, "nama_divisi" => "HR"]
                    ];

                    foreach ($divisions as $division) {
                        echo "<tr class='text-center text-gray-700 hover:bg-gray-200 transition'>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$division['id']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>{$division['nama_divisi']}</td>";
                        echo "<td class='border border-gray-300 px-4 py-2 flex justify-center space-x-2'>
                                <a href='edit_divisi.php?id={$division['id']}' class='bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition shadow-md text-sm'>Edit</a>
                                <a href='delete_divisi.php?id={$division['id']}' class='bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition shadow-md text-sm'>Hapus</a>
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