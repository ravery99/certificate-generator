<?php

use App\Config\Config;

require_once __DIR__ . '/../partials/modal.php';

if (isset($_SESSION['user'])) {
    $height = 'h-full';
} else {
    $height = 'h-screen md:h-fit';
}

?>
<div class="hidden">
    md:h-fit
</div>

<div class="flex flex-col <?= $height ?> md:flex-row max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="w-full md:w-1/2 bg-cover bg-center h-full md:h-auto hidden md:block"
        style="background-image: url('/certificate-generator/src/Views/participants/gambar3.jpg');background-size: cover;">
    </div>

    <div class="w-full md:w-1/2 p-6 my-auto md:my-0">
        <h1 class="text-xl sm:text-2xl md:text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-950 to-green-600 text-center mb-4">
            KUISIONER PARTISIPAN
        </h1>

        <p class="text-center text-sm text-gray-600 mb-4">
            Silakan isi formulir kuisioner di bawah ini untuk dapat mengunduh sertifikat Anda. Pastikan semua informasi diisi dengan benar.
        </p>

        <form id="participant-form" action="<?= Config::BASE_URL ?>/participants" method="POST" class="flex flex-col"
            onsubmit="submitForm(event)">

            <input type="hidden" name="user_role" value="<?= isset($_SESSION['user']) ? 'admin' : 'public' ?>">

            <label for="email" class="text-sm font-semibold">Email</label>
            <input type="email" id="email" name="email" placeholder="name@gmail.com" required
                class="w-full p-2 mt-1 mb-2 bg-green-50 text-green-800 rounded-md text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">

            <label for="phone" class="text-sm font-semibold">Nomor Telepon</label>
            <input type="text" id="phone" name="phone" placeholder="+62 82 8766 9888"
                class="w-full p-2 mt-1 mb-2 bg-green-50 text-green-800 rounded-md text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">

            <label for="p_name" class="text-sm font-semibold">Nama</label>
            <input type="text" id="p_name" name="p_name" placeholder="Nama Anda" required
                class="w-full p-2 mt-1 mb-2 bg-green-50 text-green-800 rounded-md text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">

            <label for="training_date" class="text-sm font-semibold">Tanggal Training</label>
            <input type="date" id="training_date" name="training_date" required
                class="w-full p-2 mt-1 mb-2 bg-green-50 text-green-800 rounded-md text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">

            <label for="facility" class="text-sm font-semibold">Fasilitas Kesehatan</label>
            <select id="facility" name="facility_id" required
                class="w-full p-2 mt-1 mb-2 bg-green-50 text-green-800 rounded-md text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">
                <option value="" disabled selected>Pilih Fasilitas Kesehatan</option>
                <?php foreach ($facilities as $facility): ?>
                    <option value="<?= $facility['id'] ?>"><?= htmlspecialchars($facility['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="division" class="text-sm font-semibold mt-1">Divisi</label>
            <select id="division" name="division_id" required
                class="w-full p-2 mt-1 mb-2 bg-green-50 text-green-800 rounded-md text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">
                <option value="" disabled selected>Pilih Divisi Anda</option>
                <?php foreach ($divisions as $division): ?>
                    <option value="<?= $division['id'] ?>"><?= htmlspecialchars($division['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Tombol untuk membuka modal dengan validasi -->
            <button type="button" class="w-full p-2 mt-3 bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-md cursor-pointer
                    hover:opacity-90 transition duration-300 text-sm active:bg-green-300 active:text-green-900 font-bold"
                onclick="validateAndShowModal()">

                Selanjutnya
            </button>
        </form>
    </div>
</div>
<script src="<?= Config::BASE_URL . "/../assets/js/modal.js" ?>"></script>
<script src="<?= Config::BASE_URL . "/../assets/js/formValidator.js" ?>"></script>