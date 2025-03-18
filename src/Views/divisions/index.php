<?php
use App\Config\Config;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Divisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">



    <!-- Content Area -->
    <div class=" grow overflow-y-auto p-8 bg-gray-100  ">
        <h1 class="text-3xl font-bold text-gray-700">Tabel Divisi</h1>

        <div class="mt-8 w-40">
            <a href="<?= Config::BASE_URL . '/divisions/create' ?>" class="flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-green-600 to-blue-600
                text-white rounded-md hover:opacity-90 transition duration-300 text-sm 
                active:bg-green-800 font-semibold shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Divisi
            </a>
        </div>




        <div class="overflow-hidden rounded-lg shadow-lg bg-white p-6 mt-6">
            <table class="w-full border border-gray-300 rounded-lg text-sm">
                <thead>
                    <tr class="bg-pink-700 text-white">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Fasilitas</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($divisions)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-gray-700 p-4">Divisi Tidak Ditemukan</td>
                        </tr>
                    <?php else: ?>

                        <?php foreach ($divisions as $division): ?>
                            <tr class='text-center text-gray-700 hover:bg-gray-200 transition'>
                                <td class='border border-gray-300 px-4 py-2'><?= htmlspecialchars($division['id']) ?></td>
                                <td class='border border-gray-300 px-4 py-2'><?= htmlspecialchars($division['name']) ?></td>
                                <td class='border border-gray-300 px-4 py-2 flex justify-center space-x-2'>


                                <td class='border border-gray-300 px-4 py-2 flex justify-center space-x-2'>
                                     <a href="<?= Config::BASE_URL . "/divisions/" . $division['id'] . "/edit" ?>"
                                        class='bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition shadow-md text-sm whitespace-nowrap'>
                                        Edit
                                    </a>
                                    <form action="<?= Config::BASE_URL . "/divisions/" . $division['id']?>" method='POST'
                                        onsubmit='return confirm("Apakah Anda yakin ingin menghapus divisi ini?");'>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type='submit'
                                            class='bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition shadow-md text-sm'>
                                            Hapus
                                        </button>
                                    </form>




                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>