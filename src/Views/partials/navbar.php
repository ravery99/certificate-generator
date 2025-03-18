
        <!-- Navbar -->
        <div class="fixed top-0 left-0 w-full sm:left-64 sm:w-[calc(100%-16rem)] h-16 bg-[#102C57] flex items-center px-4 shadow-md z-50">
            <!-- Tombol buka sidebar di HP -->
            <button class="text-white sm:hidden" @click="sidebarOpen = !sidebarOpen">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
            
            <!-- Search Bar -->
            <div class="flex items-center bg-white rounded-lg p-2 ml-4 w-full max-w-md">
                <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 4a7 7 0 1 1 0 14 7 7 0 0 1 0-14zm10 10l-3-3" />
                </svg>
                <input type="text" placeholder="Search" class="ml-2 bg-transparent outline-none text-gray-700 w-full">
            </div>

            <!-- Profile Icon -->
            <div class="ml-auto">
                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A12.073 12.073 0 0 1 12 15.5c2.58 0 5.012.79 7.121 2.304M12 3a4 4 0 1 1 0 8 4 4 0 0 1 0-8z" />
                </svg>
            </div>
        </div>