<?php

use App\Config\Config;

function actionButton(string $icon, string $link, string $color, string|null $text = null)
{
    $bg_color = "bg-$color-300";
    $hover_bg_color = "hover:bg-$color-500";
    $icon_color = "text-$color-700";
    $text_color = "text-$color-900";
?>

    <a href="<?= Config::BASE_URL . $link ?>"
        class="flex w-fit items-center justify-center cursor-pointer gap-2 px-4 py-2 rounded-md <?= $bg_color ?> <?= $hover_bg_color ?> <?= $icon_color ?> 
                 capitalize hover:text-white group">
        <span class="material-symbols-outlined">
            <?= $icon ?>
        </span>

        <?php if (isset($text)): ?>
            <p class="<?= $text_color ?> font-bold text-sm group-hover:text-white">
                <?= $text ?>
            </p>
        <?php endif ?>
    </a>

<?php } ?>