<?php

use App\Config\Config;

require_once __DIR__ . "/../components/formField.php";
require_once __DIR__ . "/../components/authSwitch.php";
require_once __DIR__ . "/../components/submitButton.php";

?>

<!-- Konten utama -->
<div class="flex items-center justify-center sm:p-6 w-full h-full">
    <div class="flex flex-col justify-center items-center bg-white h-full sm:h-fit w-full sm:w-md lg:w-lg p-8 rounded-2xl shadow-xl border border-gray-200 space-y-8">
        <h2 class="w-full mb-10 sm:my-0 sm:mt-4 sm:mb-10 text-3xl font-bold text-center text-gray-800">
            <?= $page_title; ?>
        </h2>

        <form action=<?= $form_action ?> method="POST" class="space-y-6 w-full ">

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
            <div class="mb-2 w-full">

                <?php if ($_SERVER['REQUEST_URI'] == Config::BASE_URL . "/register") : ?>
                    <?php authSwitch('Sudah punya akun?', 'Masuk', Config::BASE_URL . '/login'); ?>
                <?php else: ?>
                    <?php authSwitch('Belum punya akun?', 'Daftar', Config::BASE_URL . '/register'); ?>

            </div>
        <?php endif ?>

    <?php endif ?>

    </div>
</div>