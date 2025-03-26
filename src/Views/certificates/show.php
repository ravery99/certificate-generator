<!-- Halaman liat & unduh sertif -->

<?php

use App\Config\Config;

?>

<div class="flex size-full items-center">
    <?php
    if (isset($_SESSION['user'])) {
        $height = 'h-fit sm:h-full';
    } else {
        $height = 'sm:h-fit h-screen';
    }
    ?>

    <div class="hidden">
        h-fit sm:h-full
        sm:h-fit h-screen
    </div>
    <div class="flex items-center justify-center <?= $height ?>">
        <div class="h-full sm:h-fit bg-white shadow-xl rounded-2xl p-8 sm:p-10 md:p-16 flex flex-col lg:flex-row items-center justify-center space-y-10 lg:space-y-0 lg:space-x-10">
            <!-- Bagian Teks -->
            <div class="flex flex-col lg:w-1/2 text-center lg:text-left">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-950 to-green-600 leading-tight">
                    PREVIEW SERTIFIKAT
                </h1>
                <p class="text-gray-700 mb-8 sm:mb-10 md:mb-12 lg:mb-14 mt-6 text-sm sm:text-lg md:text-xl leading-relaxed">
                    Unduh sertifikat Anda sebelum kedaluwarsa! Anda hanya memiliki waktu 10 hari untuk menyimpannya.
                </p>
                <a href="<?= Config::BASE_URL . "/certificates/$id/download" ?>" download="Sertifikat Trustmedis"
                    class="inline-block whitespace-nowrap px-2 sm:px-8 md:px-12 py-2 sm:py-5 md:py-6 w-full lg:w-fit bg-blue-950 text-white text-sm sm:text-lg md:text-xl font-bold rounded-xl sm:rounded-2xl transition hover:bg-green-600 justify-center items-center">
                    UNDUH SEKARANG
                </a>
            </div>

            <!-- Bagian Gambar -->
            <div class="flex lg:w-1/2 justify-center items-center bg-gradient-to-r from-blue-950 to-green-600 rounded-xl sm:rounded-2xl p-6 sm:p-8 lg:p-10">
                <img src="<?= Config::BASE_URL . "/certificates/$id/download" ?>" alt="Gambar Sertifikat"
                    class="max-w-full sm:rounded-xl shadow-2xl">
            </div>
        </div>
    </div>
</div>