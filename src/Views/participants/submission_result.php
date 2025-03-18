<?php

use App\Config\Config;

?>



<div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-xl shadow-2xl overflow-hidden mx-auto mt-10">
    <div class="w-full md:w-1/2 bg-cover bg-center min-h-[300px] md:min-h-[450px]"
        style="background-image: url('gambar3.webp');"></div>
    <div class="w-full md:w-1/2 p-8 flex flex-col justify-center items-center">
        <h1
            class="text-2xl sm:text-3xl md:text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-950 to-green-600 text-center whitespace-nowrap max-w-full mb-4">
            TERIMA KASIH
        </h1>
        <p class="text-center text-lg sm:text-xl md:text-2xl text-gray-800 font-medium mb-6">
            Terima kasih, Anda sudah mengisi formulir. Silakan cek email Anda untuk informasi lebih lanjut.
        </p>
        <button onclick="window.location.href='<?= Config::BASE_URL ?>/participants/create'"
            class="mt-4 px-6 py-3 bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-md 
                    hover:opacity-90 transition duration-300 text-sm active:bg-green-300 active:text-green-900 font-bold">
            Kirim Jawaban Lain
        </button>
    </div>
</div>