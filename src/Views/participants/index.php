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
    <div class=" grow overflow-y-auto p-8 bg-gray-100  ">
        <h1 class="text-3xl font-bold text-gray-700">Tabel Peserta</h1>

        <div class=" mt-8 w-40">
            <a href="<?= Config::BASE_URL . '/participants/create' ?>" class="flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-green-600 to-blue-950 
        text-white rounded-md hover:opacity-90 transition duration-300 text-sm 
        active:bg-green-300 active:text-green-900 font-semibold shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Peserta
            </a>
        </div>

        <div class="overflow-x-auto rounded-lg shadow-lg bg-white p-6 mt-10">
            <table class="w-full border border-gray-300 rounded-lg text-sm">
                <thead>
                    <tr class="bg-green-800 text-white">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Training Date</th>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Division</th>
                        <th class="border border-gray-300 px-4 py-2">Facility</th>
                        <th class="border border-gray-300 px-4 py-2">Phone Number</th>
                        <th class="border border-gray-300 px-4 py-2">Created At</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($participants)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-gray-700 p-4">No participants found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($participants as $participant): ?>
                            <tr class="text-center text-gray-700 hover:bg-gray-100 transition">
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($participant['id']) ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($participant['email']) ?></td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?= htmlspecialchars($participant['training_date']) ?>
                                </td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($participant['p_name']) ?>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?= htmlspecialchars($participant['division_id']) ?>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?= htmlspecialchars($participant['facility_id']) ?>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?= htmlspecialchars($participant['phone_number'] ?? '-') ?>
                                </td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($participant['created_at']) ?>
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