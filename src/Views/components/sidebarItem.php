<?php

use App\Config\Config;

function sidebarItem(string $title, string $link, string $icon, string|null $active_bg_color = 'bg-green-400', string|null $active_text_color = 'text-black')
{
    $is_active = strpos($_SERVER['REQUEST_URI'], Config::BASE_URL . $link) !== false;
    $active_styles = $is_active ? "$active_bg_color $active_text_color shadow-md scale-105" : "text-white";

    $href = $link === '/logout' ? "javascript:void(0);" : Config::BASE_URL . $link;
    $on_click = $link === '/logout' ? "showModal('Apakah Anda yakin ingin keluar?', () => { window.location.href = '" . Config::BASE_URL . "/logout'; }, { 
        confirmText: 'Keluar', 
        cancelText: 'Batal',
        icon: 'logout',
        confirmBg: 'bg-red-600',
        confirmHover: 'hover:bg-red-800',
        cancelBorder: 'border-gray-400',
        cancelBg: 'bg-white',
        cancelTextColor: 'text-gray-500',
        cancelHover: 'hover:bg-gray-200'
    });" : "";

?>

    <a href="<?= $href ?>"
        class="flex items-center px-4 py-3 rounded-lg transition-all duration-300 transform <?= $active_styles ?> hover:<?= $active_bg_color ?> hover:<?= $active_text_color ?> hover:shadow-md hover:scale-105 whitespace-nowrap"
        onclick="<?= $on_click ?>">

        <span class="material-symbols-outlined mr-3">
            <?= $icon ?>
        </span>
        <?= $title ?>
    </a>
    <script src="<?= Config::BASE_URL . "/../assets/js/modal.js" ?>"></script>

<?php } ?>