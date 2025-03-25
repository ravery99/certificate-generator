<div id="global-overlay" class="hidden fixed inset-0 bg-black opacity-50 z-40" onclick="closeModal()"></div>

<div id="global-modal" class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 
    p-6 sm:p-8 rounded-lg shadow-lg max-w-[90%] sm:max-w-md md:max-w-lg w-full bg-white">
    <div class="text-center">
        <span class="material-symbols-outlined text-gray-400 !text-6xl mb-4" id="modal-icon">
            info
        </span>
        <h2 id="modal-message" class="mb-5 text-gray-700 text-lg font-medium">
            Pesan modal
        </h2>

        <div class="flex flex-col sm:flex-row gap-3">
            <button id="modal-cancel"
                class="flex-1 border border-red-700 text-red-700 bg-white hover:bg-red-100 
                    rounded-lg transition-all duration-300 transform text-sm sm:text-base px-5 py-2.5 sm:px-6 sm:py-3 cursor-pointer">
                Batal
            </button>
            <button id="modal-confirm"
                class="flex-1 bg-gradient-to-r from-green-600 to-blue-950 text-white hover:bg-green-800 
                    rounded-lg transition-all duration-300 transform sm:text-base px-5 py-2.5 sm:px-6 sm:py-3 cursor-pointer">
                Ya, Lanjutkan
            </button>
        </div>
    </div>
</div>