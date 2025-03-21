<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body {
            background-color: #f9fafb;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-100" x-data="{ sidebarOpen: false }">


    <div x-show="sidebarOpen" class="fixed inset-0 bg-black bg-opacity-50 z-40 sm:hidden" @click="sidebarOpen = false">
    </div>

    <!-- Sidebar -->

    <div class="flex   fixed inset-y-0 left-0 shadow-md transition-transform duration-300 ease-in-out sm:relative sm:translate-x-0 z-50"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full sm:translate-x-0'">
        <?php require_once __DIR__ . '../../partials/sidebar.php'; ?>
    </div>

    <!-- Konten utama -->
    <div class="flex flex-col flex-1 transition-all duration-300 sm:ml-64">

        <!-- Navbar -->
        <div
            class="fixed top-0 left-0 w-full sm:left-64 sm:w-[calc(100%-16rem)] h-16 bg-green-900 flex items-center px-4 shadow-md z-50">
            <?php require_once __DIR__ . '../../partials/navbar.php'; ?>
        </div>

        <!-- View -->
        <div class="flex flex-1 p-6 pt-20">
            <?php require_once "../src/Views/$view_path.php"; ?>
        </div>
    </div>

</body>

</html>