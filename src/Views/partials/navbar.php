<div class="bg-[#071952] items-center py-4 px-6 flex flex-row justify-between xl:justify-end">

    <!-- Tombol buka sidebar di HP -->
    <button class="text-white xl:hidden" @click="sidebarOpen = !sidebarOpen">
        <svg class="size-5 xl:size-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
    </button>

    <!-- Profile Icon -->
    <div class="">
        <svg class="size-5 xl:size-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5.121 17.804A12.073 12.073 0 0 1 12 15.5c2.58 0 5.012.79 7.121 2.304M12 3a4 4 0 1 1 0 8 4 4 0 0 1 0-8z" />
        </svg>
    </div>
</div>