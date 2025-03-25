<?php
use App\Config\Config;

?>

<!-- <body class="flex justify-center items-center h-screen"> -->
<div id="popup"  class="p-6 sm:p-8 rounded-lg shadow-lg max-w-[90%] sm:max-w-md md:max-w-lg w-full bg-white">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm text-center">
    <svg class="mx-auto mb-4 text-gray-400 w-12 sm:w-14 md:w-16 h-12 sm:h-14 md:h-16" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
        <h2 class="mb-5 text-sm sm:text-base md:text-lg font-normal text-gray-700">Anda yakin ingin keluar?</h2>
      
        <div class="flex flex-col sm:flex-row gap-3">
        <button type="button" class="close-btn flex-1 border-2 border-red-700 text-red-700 bg-white rounded-md hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-400 
                font-medium text-sm sm:text-base px-5 py-2.5 sm:px-6 sm:py-3">
                Tidak, Batal
            </button>
            <button type="button" onclick="window.location.href='<?php echo Config::BASE_URL . '/logout'; ?>'"
                class="flex-1 bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-md hover:bg-green-800 focus:outline-none focus:ring-0 font-medium text-sm sm:text-base px-5 py-2.5 sm:px-6 sm:py-3">
                Ya, Keluar
            </button>
        </div>
    </div>
</div>

<script>
    document.getElementById("logout-btn").addEventListener("click", () => {
        document.getElementById("popup").classList.remove("hidden");
    });

    document.querySelectorAll(".close-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            document.getElementById("popup").classList.add("hidden");
        });
    });
</script>



