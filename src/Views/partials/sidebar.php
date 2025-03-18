<?php
use App\Config\Config;

?>


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
                extend: {
                    colors: {
                        primary: '#071952',
                        secondary: '#0B666A',
                        accent: '#35A29F',
                        hoverHighlight: '#4ADE80' // Warna hover lebih terang
                    }
                }
            }
        }
    </script>
</head>

<body class="">

    <!-- Sidebar -->
    <div class="fixed top-0 left-0 bg-gradient-to-b from-primary to-secondary shadow-lg rounded-r-2xl flex flex-col
                ">
        <!-- Header Sidebar -->
        <div class="flex items-center justify-center h-16 bg-primary border-b border-gray-600">
            <span class="text-white font-bold uppercase tracking-wide text-lg">Dashboard</span>
        </div>

        <!-- Menu Sidebar -->
        <div class="grow h-full overflow-y-auto ">
            <nav class="px-4 py-4 space-y-2">
                <a href="<?= Config::BASE_URL . '/dashboard' ?>"
                    class="flex items-center px-4 py-3 text-white bg-opacity-20 rounded-lg transition-all duration-300 transform hover:bg-hoverHighlight hover:text-black hover:shadow-md hover:scale-105">
                    <svg class="h-6 w-6 mr-3 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9L12 2L21 9V20H3V9Z"></path>
                        <path d="M9 22V12H15V22"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="<?= Config::BASE_URL . '/users' ?>"
                    class="flex items-center px-4 py-3 text-white bg-opacity-20 rounded-lg transition-all duration-300 transform hover:bg-hoverHighlight hover:text-black hover:shadow-md hover:scale-105">
                    <svg class="h-6 w-6 mr-3 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 20V18C5 16.9 5.9 16 7 16H17C18.1 16 19 16.9 19 18V20"></path>
                        <circle cx="12" cy="10" r="4"></circle>
                    </svg>
                    Tabel User
                </a>
                <a href="<?= Config::BASE_URL . '/participants' ?>"
                    class="flex items-center px-4 py-3 text-white bg-opacity-20 rounded-lg transition-all duration-300 transform hover:bg-hoverHighlight hover:text-black hover:shadow-md hover:scale-105">
                    <svg class="h-6 w-6 mr-3 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21V19C16 17.9 15.1 17 14 17H10C8.9 17 8 17.9 8 19V21"></path>
                        <circle cx="12" cy="10" r="4"></circle>
                    </svg>
                    Tabel Partisipan
                </a>
                <a href="<?= Config::BASE_URL . '/divisions' ?>"
                    class="flex items-center px-4 py-3 text-white bg-opacity-20 rounded-lg transition-all duration-300 transform hover:bg-hoverHighlight hover:text-black hover:shadow-md hover:scale-105">
                    <svg class="h-6 w-6 mr-3 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21V9L12 2L21 9V21H3Z"></path>
                        <path d="M9 21V12H15V21"></path>
                    </svg>
                    Tabel Divisi
                </a>
                <a href="<?= Config::BASE_URL . '/facilities' ?>"
                    class="flex items-center px-4 py-3 text-white bg-opacity-20 rounded-lg transition-all duration-300 transform hover:bg-hoverHighlight hover:text-black hover:shadow-md hover:scale-105">
                    <svg class="h-6 w-6 mr-3 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 3H21V9H3V3Z"></path>
                        <path d="M3 15H21V21H3V15Z"></path>
                    </svg>
                    Tabel fasilitas
                </a>
                <a href="<?= Config::BASE_URL . '/certificates' ?>"
                    class="flex items-center px-4 py-3 text-white bg-opacity-20 rounded-lg transition-all duration-300 transform hover:bg-hoverHighlight hover:text-black hover:shadow-md hover:scale-105">
                    <svg class="h-6 w-6 mr-3 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 12L16 16L22 10"></path>
                        <path d="M20 4H8L4 8V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V4Z"></path>
                        <circle cx="12" cy="14" r="3"></circle>
                    </svg>
                    Tabel Sertifikat
                </a>

            </nav>
        </div>
    </div>