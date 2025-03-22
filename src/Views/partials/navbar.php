<!-- bg-[#102C57] -->
<div class="bg-[#071952] items-center py-4 px-6 flex flex-row justify-between lg:justify-end">

    <!-- Tombol buka sidebar di HP -->
    <button class="text-white lg:hidden" @click="sidebarOpen = !sidebarOpen">
        <svg class="size-5 lg:size-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
    </button>

    <!-- Profile Icon -->
    <div class="">
        <svg class="size-5 lg:size-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5.121 17.804A12.073 12.073 0 0 1 12 15.5c2.58 0 5.012.79 7.121 2.304M12 3a4 4 0 1 1 0 8 4 4 0 0 1 0-8z" />
        </svg>
    </div>
    <span class="text-white text-lg font-sans font-semibold tracking-wide">{{ bella }}</span>
</div>

<script>
    new Vue({
        el: '#app',
        data: {
            userName: 'Bella' 
        }
    });
</script>




</div>



-----------------

  <!-- Tombol Logout -->
   <!-- Tombol Logout -->
   <a href="javascript:void(0);" onclick="openModal()"
        class="flex items-center px-4 py-3 text-white bg-blue-600 rounded-lg transition-all duration-300 transform hover:bg-blue-700 hover:text-white hover:shadow-md hover:scale-105">
        <svg class="h-6 w-6 mr-3 text-white" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 12L16 16L22 10"></path>
            <path d="M20 4H8L4 8V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V4Z"></path>
            <circle cx="12" cy="14" r="3"></circle>
        </svg>
        Logout
    </a>

    <!-- Overlay Gelap & Modal -->
    <div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center mt-10">
            <h2 class="text-lg font-semibold mb-4">Apakah Anda yakin?</h2>
            <p class="text-sm text-gray-500 mb-4">Data yang dihapus tidak bisa dikembalikan!</p>
            <div class="flex justify-center space-x-4">
                <button onclick="logout()" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Hapus Data!</button>
                <button onclick="closeModal()" class="px-4 py-2 bg-red-600 text-white rounded-lg">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("logoutModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("logoutModal").classList.add("hidden");
        }

        function logout() {
            window.location.href = "logout-url"; // Ganti dengan URL logout yang benar
        }
    </script>
