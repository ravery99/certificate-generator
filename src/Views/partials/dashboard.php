<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex h-screen bg-gray-100">

    <?php include 'sidebar.php'; ?>



    <div class="flex flex-col flex-1 overflow-y-auto p-6">
        <!-- Header -->
        <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200 px-6 shadow-md rounded-lg">
            <h1 class="text-xl font-semibold text-green-700">Dashboard</h1>
            <input class="w-80 border rounded-md px-4 py-2 focus:ring-2 focus:ring-green-400 outline-none" type="text"
                placeholder="Search...">
        </div>

        
        <!-- Card Welcome -->
        <div class="bg-gradient-to-r from-green-400 to-green-600 p-6 rounded-lg shadow-md mt-6 text-white">
            <h2 class="text-2xl font-bold">Welcome, Admin! 🎉</h2>
            <p class="mt-2">Kelola data user, partisipan, dan sertifikat dengan mudah di dashboard ini.</p>
        </div>

        <!-- Card Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <!-- Jumlah User -->
            <div
                class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between border-l-8 border-green-500">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Jumlah User</h3>
                    <p class="text-3xl font-bold text-green-700">120</p>
                </div>
                <div class="text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm7 2a3 3 0 110 6 3 3 0 010-6zm0 8c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                </div>
            </div>

            <!-- Jumlah Partisipan -->
            <div
                class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between border-l-8 border-yellow-500">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Jumlah Partisipan</h3>
                    <p class="text-3xl font-bold text-yellow-700">300</p>
                </div>
                <div class="text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M12 2a10 10 0 100 20 10 10 0 000-20zm-1 14v-4H8v4h3zm5 0v-4h-3v4h3zm-5-6V6H8v4h3zm5 0V6h-3v4h3z" />
                    </svg>
                </div>
            </div>

            <!-- Jumlah Sertifikat -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between border-l-8 border-blue-500">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Jumlah Sertifikat</h3>
                    <p class="text-3xl font-bold text-blue-700">250</p>
                </div>
                <div class="text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4 14H8v-2h8v2zm0-4H8v-2h8v2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

</body>

</html>