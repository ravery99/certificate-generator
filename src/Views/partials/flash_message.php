<?php if (isset($_SESSION['flash'])): ?>
    <div class="p-2 flex flex-col gap-5 items-center w-full">
        <div
            class="flex bg-white flex-row shadow-lg border border-gray-200 rounded-xl overflow-hidden  w-full transition-transform transform scale-100 hover:scale-105">
            <div
                class="flex w-3 
                <?= $_SESSION['flash']['type'] === 'success' ? 'bg-gradient-to-b from-green-500 to-emerald-400' : 'bg-gradient-to-b from-red-500 to-rose-400' ?>">
            </div>
            <div class="flex-1 p-2 w-full">
                <h1 class="md:text-xl font-semibold 
                    <?= $_SESSION['flash']['type'] === 'success' ? 'text-green-600' : 'text-red-600' ?>">
                    <?= $_SESSION['flash']['type'] === 'success' ? 'Success!' : 'Error!' ?>
                </h1>
                <p class="text-gray-500 text-sm md:text-base font-medium">
                    <?= htmlspecialchars($_SESSION['flash']['message']) ?>
                </p>
            </div>
            <div class="cursor-pointer border-l border-gray-200 bg-gray-100 hover:bg-gray-200 px-5 flex items-center transition-all duration-300 ease-in-out "
                onclick="this.parentElement.parentElement.remove();">
                <p class="text-gray-500 text-xs font-bold tracking-wide uppercase">Close</p>
            </div>
        </div>
    </div>

    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
