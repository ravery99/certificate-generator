<?php

use App\Config\Config;

?>



<div class="flex flex-col sm:flex-row w-full  h-full sm:h-fit max-w-4xl bg-white sm:rounded-xl shadow-2xl overflow-hidden mx-auto">
    <div class="w-full sm:w-1/2 bg-cover bg-center min-h-[300px] sm:min-h-[450px]"
        style="background-image: url('/certificate-generator/src/Views/participants/gambar3.jpg');"></div>
    <div class="w-full sm:w-auto p-4 sm:p-8 flex flex-col justify-center items-center  space-y-10">
        <h1
            class="mt-10 sm:mt-0 text-3xl sm:text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-950 to-green-600 text-center max-w-full">
            <?= $title_text ?>
        </h1>
        <p class="text-center text-md sm:text-lg text-gray-800">
            <?= $desc_text ?>
        </p>
        <button onclick="window.location.href='<?= Config::BASE_URL ?>/participants/create'"
            class="px-6 py-3 bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-md 
                    hover:opacity-90 transition duration-300 text-sm active:bg-green-300 active:text-green-900 font-semibold cursor-pointer">
            Kirim Jawaban Lain
        </button>
    </div>
</div>