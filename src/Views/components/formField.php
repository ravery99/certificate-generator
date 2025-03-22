<?php

function formField(string $label, string $name, string $input_type, string|null $value = '', string|null $placeholder = '')
{
?>

    <div class="space-y-2">
        <label class="block text-sm font-medium text-gray-700 capitalize" for="<?= strtolower($name) ?>">
            <?= $label ?>
        </label>
        <input type="<?= $input_type ?>" name="<?= strtolower($name) ?>" value="<?= $value ?>" id="<?= strtolower($name) ?>" autocomplete="on" required
            placeholder="<?= $placeholder ?>"
            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
    </div>

<?php
} ?>