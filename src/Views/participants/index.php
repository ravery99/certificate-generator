<?php

use App\Config\Config;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Peserta</title>
    <link href="../output.css" rel="stylesheet">
</head>

<body class="bg-gray-50 flex">

    <!-- Konten Utama -->
    <div class="grow overflow-y-auto p-8 bg-gray-100">
        <h1 class="text-4xl font-extrabold uppercase tracking-wide shadow-md 
            bg-gradient-to-r from-[#006A67] to-[#38A69D] bg-clip-text text-transparent">
            Tabel Peserta
        </h1>

<<<<<<< HEAD
        <div class="mt-8">
            <a href="<?= Config::BASE_URL . '/participants/create' ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#006A67] to-[#38A69D] 
        text-white rounded-lg hover:brightness-110 transition duration-300 text-base 
        active:scale-95 font-semibold shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
=======
        <div class=" mt-8 w-40">
            <a href="<?= Config::BASE_URL . '/participants/create' ?>" class="flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-green-600 to-blue-950 
        text-white rounded-md hover:opacity-90 transition duration-300 text-sm 
        active:bg-green-300 active:text-green-900 font-semibold shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
>>>>>>> 7dbaa110ae7cbec935e75031511b63e66790f254
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Peserta
            </a>
        </div>

<<<<<<< HEAD

=======
>>>>>>> 7dbaa110ae7cbec935e75031511b63e66790f254
        <div class="overflow-x-auto rounded-lg shadow-lg bg-white p-6 mt-10">
            <table class="w-full border border-gray-200 rounded-lg text-sm">
                <thead>
                    <tr class="bg-[#006A67] text-white">
                        <th class="border border-gray-300 px-6 py-3">ID</th>
                        <th class="border border-gray-300 px-6 py-3">Email</th>
                        <th class="border border-gray-300 px-6 py-3">Tanggal Pelatihan</th>
                        <th class="border border-gray-300 px-6 py-3">Nama</th>
                        <th class="border border-gray-300 px-6 py-3">Divisi</th>
                        <th class="border border-gray-300 px-6 py-3">Fasiliti</th>
                        <th class="border border-gray-300 px-6 py-3">No Telepon</th>
                        <th class="border border-gray-300 px-6 py-3">Tanggal Dibuat</th>
                        <th class="border border-gray-300 px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($participants)): ?>
                        <tr>
                            <td colspan="9" class="text-center text-gray-600 p-4">Peserta Tidak Ditemukan</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($participants as $participant): ?>
                            <tr class="text-center text-gray-700 hover:bg-gray-100 transition duration-200">
                                <td class="border border-gray-300 px-6 py-3"><?= htmlspecialchars($participant['id']) ?></td>
                                <td class="border border-gray-300 px-6 py-3"><?= htmlspecialchars($participant['email']) ?></td>
                                <td class="border border-gray-300 px-6 py-3">
                                    <?= htmlspecialchars($participant['training_date']) ?></td>
                                <td class="border border-gray-300 px-6 py-3"><?= htmlspecialchars($participant['p_name']) ?>
                                </td>
                                <td class="border border-gray-300 px-6 py-3">
                                    <?= htmlspecialchars($participant['division_id']) ?></td>
                                <td class="border border-gray-300 px-6 py-3">
                                    <?= htmlspecialchars($participant['facility_id']) ?></td>
                                <td class="border border-gray-300 px-6 py-3">
                                    <?= htmlspecialchars($participant['phone_number'] ?? '-') ?></td>
                                <td class="border border-gray-300 px-6 py-3"><?= htmlspecialchars($participant['created_at']) ?>
                                </td>
                                <td class="border border-gray-300 px-6 py-3">
                                    <form action="<?= Config::BASE_URL . "/participants/" . $participant['id'] ?>" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition shadow-md text-sm font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>