<?php

function submitButton(string $button_text = 'simpan perubahan')
{
?>
    <button type="submit"
        class="w-full py-3 bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-xl 
               hover:opacity-90 text-lg active:bg-green-300 active:text-green-900 font-bold cursor-pointer capitalize">
        <?= $button_text ?>
    </button>
<?php
} ?>