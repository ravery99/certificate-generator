<?php

require_once __DIR__ . "/../components/formField.php";
require_once __DIR__ . "/../components/submitButton.php";

?>

<!-- Konten utama -->
<div class="flex h-full items-center justify-center px-12">
    <div class="bg-white p-10 rounded-2xl shadow-lg w-full max-w-lg border-l-8 border-green-800 space-y-8">
        <h2 class="text-3xl font-bold text-gray-800 text-center">
            <?= $page_title ?>
        </h2>

        <form action=<?= $form_action ?> method="POST" class="space-y-6">

            <!-- Hidden input untuk ID (hanya ada saat edit) -->
            <?php if (isset($id)): ?>
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $id ?>">
            <?php endif; ?>

            <?=
            formField($name_label, 'name', 'text', $value ?? '', $placeholder);
            submitButton($button_text ?? 'Simpan Perubahan');
            ?>

        </form>
    </div>
</div>