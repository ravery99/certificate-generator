<?php

use App\Config\Config;

require_once __DIR__ . "/../components/formField.php";
require_once __DIR__ . "/../components/authSwitch.php";
require_once __DIR__ . "/../components/submitButton.php";

?>

<!-- Konten utama -->
<div class="flex h-full items-center justify-center p-6 ">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full min-w-md max-w-lg border border-gray-200 space-y-8">
        <h2 class="text-3xl font-bold text-center text-gray-800">
            <?= $page_title; ?>
        </h2>

        <form action=<?= $form_action ?> method="POST" class="space-y-6">

            <!-- Hidden input untuk ID (hanya ada saat edit) -->
            <?php if (isset($id)): ?>
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $id ?>">
            <?php endif; ?>

            <?php

            formField('nama pengguna', 'username', 'text', $username ?? '', 'Masukkan nama pengguna');
            formField('kata sandi', 'password', 'password', '', 'Masukkan kata sandi');

            if ($_SERVER['REQUEST_URI'] != Config::BASE_URL . "/login") {
                formField('konfirmasi kata sandi', 'password_confirmation', 'password', '', 'Masukkan ulang kata sandi');
            }

            submitButton($button_text);

            ?>

        </form>

        <?php if (empty($_SESSION['user'])) : ?>
            <div class="mt-8 mb-2">

                <?php if ($_SERVER['REQUEST_URI'] == Config::BASE_URL . "/register") : ?>
                    <?php authSwitch('Sudah punya akun?', 'Masuk', Config::BASE_URL . '/login'); ?>
                <?php else: ?>
                    <?php authSwitch('Belum punya akun?', 'Daftar', Config::BASE_URL . '/register'); ?>

            </div>
        <?php endif ?>

    <?php endif ?>

    </div>
</div>