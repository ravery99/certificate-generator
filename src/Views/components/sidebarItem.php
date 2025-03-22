<?php

use App\Config\Config;

function sidebarItem(string $title, string $link, string $icon, string|null $active_bg_color = 'bg-green-400', string|null $active_text_color = 'text-black')
{
    $is_active = strpos($_SERVER['REQUEST_URI'], Config::BASE_URL . $link) !== false;

    $active_styles = $is_active ? "$active_bg_color $active_text_color shadow-md scale-105" : "text-white";
?>

    <a href="<?= Config::BASE_URL . $link ?>"
        class="flex items-center px-4 py-3 rounded-lg transition-all duration-300 transform <?= $active_styles ?> hover:<?= $active_bg_color ?> hover:<?= $active_text_color ?> hover:shadow-md hover:scale-105">

        <span class="material-symbols-outlined mr-3">
            <?= $icon ?>
        </span>
        <?= $title ?>
    </a>

<?php } ?>