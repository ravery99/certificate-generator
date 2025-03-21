<?php
use App\Config\Config;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Sertifikat</title>
    <link href="../output.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="grow overflow-y-auto p-8 bg-gray-100">
        <h1 class="text-4xl font-extrabold uppercase tracking-wide shadow-md 
    bg-gradient-to-r from-[#387478] to-[#6fb3b8] bg-clip-text text-transparent">
            Tabel Sertifikat
        </h1>


        <div class="overflow-hidden rounded-lg shadow-lg bg-white p-6 mt-6">
            <table class="w-full border border-gray-300 rounded-lg text-base">
                <thead>
                    <tr class="bg-[#387478] text-white">
                        <th class="border border-gray-300 px-6 py-3 text-center">ID</th>
                        <th class="border border-gray-300 px-6 py-3 text-center">Nama Sertifikat</th>
                        <th class="border border-gray-300 px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($certificates)): ?>
                        <tr>
                            <td colspan="3" class="text-center text-gray-700 p-4">No certificates found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($certificates as $cert): ?>
                            <tr class="text-gray-700 hover:bg-[#e6f5f5] transition duration-300">
                                <td class="border border-gray-300 px-6 py-3"><?= htmlspecialchars($cert['participant_id']) ?>
                                </td>
                                <td class="border border-gray-300 px-6 py-3">
                                    <?= htmlspecialchars($cert['certificate_filename']) ?></td>
                                <td class="border border-gray-300 px-6 py-3">
                                    <div class="flex justify-center gap-3">

                                        <!-- Tombol Lihat -->
                                        <a href="<?= Config::BASE_URL . htmlspecialchars($cert['certificate_link']) ?>"
                                            target="_blank"
                                            class="bg-[#009990] hover:bg-[#007a7a] text-white p-2 rounded-full transition shadow">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5c-7.5 0-12 7.5-12 7.5s4.5 7.5 12 7.5 12-7.5 12-7.5-4.5-7.5-12-7.5zm0 0a3.5 3.5 0 100 7 3.5 3.5 0 000-7z" />
                                            </svg>
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="<?= Config::BASE_URL . "/certificates/" . $cert['participant_id'] ?>"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus sertifikat ini?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition shadow">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>