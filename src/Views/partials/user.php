<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex h-screen bg-gray-100">

    <?php include '../partials/sidebar.php'; ?>

    <div class="flex flex-col flex-1 overflow-y-auto p-8">

        <h1 class="text-3xl font-bold text-gray-700">Tabel User</h1>


        <div class="mt-8 w-40">
            <a href="create_user.php" class="flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-green-600 to-blue-950 
     text-white rounded-md hover:opacity-90 transition duration-300 text-sm 
     active:bg-green-300 active:text-green-900 font-semibold shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah User
            </a>

        </div>




        <!-- Tabel (lebih kecil dan lebih dekat ke tombol) -->
        <div class="overflow-hidden rounded-lg shadow-lg bg-white p-4 mt-8">
            <table class="w-full border border-gray-300 rounded-lg text-base">
                <thead>
                    <tr class="bg-green-600 text-white">
                        <th class="border border-gray-300 px-6 py-3">No</th>
                        <th class="border border-gray-300 px-6 py-3">Username</th>
                        <th class="border border-gray-300 px-6 py-3">Password</th>
                        <th class="border border-gray-300 px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $users = [
                        ["id" => 1, "username" => "john_doe", "password" => "password123"],
                        ["id" => 2, "username" => "jane_doe", "password" => "12345678"]
                    ];

                    $no = 1;
                    foreach ($users as $user) {
                        echo "<tr class='text-center text-gray-700 hover:bg-gray-100 transition'>";
                        echo "<td class='border border-gray-300 px-6 py-3'>{$no}</td>";
                        echo "<td class='border border-gray-300 px-6 py-3'>{$user['username']}</td>";
                        echo "<td class='border border-gray-300 px-6 py-3'>********</td>";
                        echo "<td class='border border-gray-300 px-6 py-3 flex justify-center space-x-2'>
                        <a href='edit.php?id={$user['id']}' class='bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition shadow-md text-sm'>Edit</a>
                        <a href='delete.php?id={$user['id']}' class='bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition shadow-md text-sm'>Hapus</a>
                      </td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>


</body>

</html>