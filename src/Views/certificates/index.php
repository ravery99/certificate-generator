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
        <h1 class="text-3xl font-bold text-gray-700">Tabel Sertifikat</h1>

        <div class="overflow-hidden rounded-lg shadow-lg bg-white p-4 mt-6">
            <table class="w-full border border-gray-300 rounded-lg text-base">
                <thead>
                    <tr class="bg-green-600 text-white">
                        <th class="border border-gray-300 px-6 py-3">ID</th>
                        <th class="border border-gray-300 px-6 py-3">Nama Sertifikat</th>
                        <th class="border border-gray-300 px-6 py-3">Link Sertifikat</th>
                        <th class="border border-gray-300 px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($certificates)): ?>
                        <tr>
                            <td colspan="4" class="text-center text-gray-700 p-4">No certificates found.</td>
                        </tr>


                    <?php else: ?>
                        <?php foreach ($certificates as $cert): ?>
                            <tr class='text-center text-gray-700 hover:bg-gray-100 transition'>
                                <td class='border border-gray-300 px-6 py-3'><?= htmlspecialchars($cert['participant_id']) ?>
                                </td>
                                <td class='border border-gray-300 px-6 py-3'>
                                    <?= htmlspecialchars($cert['certificate_filename']) ?>
                                </td>
                                <td class='border border-gray-300 px-6 py-3'>
                                    <a href="<?= Config::BASE_URL . htmlspecialchars($cert['certificate_link']) ?>" target="_blank"
                                        class="text-blue-500 underline">Lihat Sertifikat</a>
                                </td>
                                <td class='border border-gray-300 px-6 py-3'>
                                    <form action='delete_certificate.php?id=<?= $cert["participant_id"] ?>' method='POST'
                                        onsubmit='return confirm("Apakah Anda yakin ingin menghapus sertifikat ini?");'>
                                        <button type='submit'
                                            class='bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition shadow-md text-sm'>
                                            Hapus
                                        </button>
                                    </form>
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