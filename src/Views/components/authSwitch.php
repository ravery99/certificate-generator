<?php

function authSwitch(string $msg, string $link_text, string $link_href)
{
?>
    <div class="flex items-center gap-1 justify-center">
        <p class="text-sm text-gray-700">
            <?= $msg ?>
        </p>
        <a href="<?= $link_href ?>" class="text-sm font-bold text-green-900 underline">
            <?= $link_text ?>
        </a>
    </div>

<?php
} ?>