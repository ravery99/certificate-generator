<?php

<div class="w-full max-w-screen-2xl bg-white shadow-2xl rounded-3xl p-6 sm:p-10 md:p-16 flex flex-col lg:flex-row items-center space-y-10 lg:space-y-0 lg:space-x-10">
    <!-- Bagian Teks -->
    <div class="flex-1 text-center lg:text-left">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-950 to-green-600 leading-tight">
            PREVIEW SERTIFIKAT
        </h1>
        <p class="text-gray-700 mt-6 sm:mt-8 text-lg sm:text-xl md:text-2xl leading-relaxed">
            Unduh sertifikat Anda sebelum kedaluwarsa! Anda hanya memiliki waktu 10 hari untuk menyimpannya.
        </p>
        <a href="' . htmlspecialchars($filepath) . '" download="' . htmlspecialchars($filename) . '" 
           class="inline-block mt-6 sm:mt-8 px-6 sm:px-8 md:px-12 py-4 sm:py-5 md:py-6 w-full sm:w-auto bg-blue-950 text-white text-lg sm:text-xl md:text-2xl font-bold rounded-2xl transition hover:bg-green-600">
            UNDUH SEKARANG
        </a>
    </div>

    <!-- Bagian Gambar -->
    <div class="flex-1 flex justify-center items-center bg-gradient-to-r from-blue-950 to-green-600 rounded-3xl p-6 sm:p-8 md:p-12">
        <img src="' . htmlspecialchars($filepath) . '" alt="Sertifikat" 
             class="max-w-full max-h-[400px] sm:max-h-[500px] md:max-h-[600px] lg:max-h-[700px] rounded-xl shadow-2xl">
    </div>
</div>


?>
