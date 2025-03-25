<div class="bg-[#071952] items-center py-4 px-6 flex flex-row justify-between xl:justify-end">

    <!-- Tombol buka sidebar di HP -->
    <a class="text-white xl:hidden flex items-center justify-center cursor-pointer" @click="sidebarOpen = !sidebarOpen">
        <span class="material-symbols-outlined mr-3">
            menu
        </span>
    </a>

    <!-- Profile Icon -->
    <div class="text-white flex flex-row items-center justify-center gap-3 cursor-default">
        <p class="cursor-default">
            <?= $_SESSION['user']['username'] ?>
        </p>
        <span class="material-symbols-outlined mr-3">
            account_circle
        </span>
    </div>
</div>