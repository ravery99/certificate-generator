<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Training Partisipan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex h-screen bg-gray-100">

    <?php include 'sidebar.php'; ?>

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










----------------------------------

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {}
            }
        }
    </script>
</head>

<body class="flex h-screen bg-gray-100">

    <!-- Navbar -->
    <div class="fixed top-0 left-0 w-full h-14 bg-green-900 flex items-center px-4 shadow-md z-50">
        <!-- Menu Icon -->
        <button class="text-white md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <!-- Search Bar -->
        <div class="flex items-center bg-white rounded-lg p-2 ml-4 w-full md:w-1/3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 4a7 7 0 1 1 0 14 7 7 0 0 1 0-14zm10 10l-3-3" />
            </svg>
            <input type="text" placeholder="Search"
                class="ml-2 bg-transparent outline-none text-gray-700 w-full">
        </div>

        <!-- Profile Icon -->
        <div class="ml-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A12.073 12.073 0 0 1 12 15.5c2.58 0 5.012.79 7.121 2.304M12 3a4 4 0 1 1 0 8 4 4 0 0 1 0-8z" />
            </svg>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="hidden md:flex flex-col w-64 bg-green-950 h-screen pt-14">

        <div class="flex items-center justify-center h-16 bg-green-900">
            <span class="text-white font-bold uppercase">Sidebar</span>
        </div>
        <div class="flex flex-col flex-1 overflow-y-auto">
            <nav class="flex-1 px-2 py-4 bg-green-800">
                <a href="dashboard.php" class="flex items-center px-4 py-2 text-gray-100 hover:bg-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h11M9 21V3m8 18h-8m8-10h-3m3 10V3m0 18h-3" />
                    </svg>
                    Dashboard
                </a>
                <a href="../users/index.php" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12A4 4 0 1 1 8 12a4 4 0 0 1 8 0zM3 20h18" />
                    </svg>
                    Tabel User
                </a>
                <a href="../participants/index.php"
                    class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c1.66 0 3-1.34 3-3s-1.34-3-3-3S9 6.34 9 8s1.34 3 3 3zm0 1c-2.67 0-8 1.34-8 4v1h16v-1c0-2.66-5.33-4-8-4z" />
                    </svg>
                    Tabel Partisipan
                </a>
                <a href="../divisions/index.php"
                    class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h11M9 21V3m8 18h-8m8-10h-3m3 10V3m0 18h-3" />
                    </svg>
                    Tabel Divisi
                </a>
                <a href="../facilities/index.php"
                    class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 3h12M6 9h12M6 15h12m-6 6v-6" />
                    </svg>
                    Tabel Fasilitas
                </a>
            </nav>
        </div>
     

    </div>

</body>

</html>
