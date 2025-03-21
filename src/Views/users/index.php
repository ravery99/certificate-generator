<?php
use App\Config\Config;


$limit = 6; 
$page = max(1, (int) ($_GET['page'] ?? 1));
$totalPages = ceil(count($users) / $limit);
$usersPaginated = array_slice($users, ($page - 1) * $limit, $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Admin</title>
    <link href="../output.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-6xl p-10 bg-white shadow-2xl rounded-3xl border border-gray-200">
        <div class="mb-6">
            <h1 class="text-3xl font-extrabold text-[#508C9B] mb-4">Tabel Admin</h1>
            <a href="<?= Config::BASE_URL . '/users/create' ?>"
                class="flex items-center justify-center gap-2 px-5 py-2 min-w-[140px] bg-[#508C9B] text-white rounded-md hover:bg-[#417A89] transition text-sm font-bold shadow-md w-fit">
                ➕ Tambah Admin
            </a>
        </div>

        <div class="overflow-hidden rounded-xl shadow-xl bg-white p-6 border border-gray-200">
            <table class="w-full border border-gray-300 rounded-xl text-sm">
                <thead>
                    <tr class="bg-[#508C9B] text-white">
                        <th class="border px-6 py-3">ID</th>
                        <th class="border px-6 py-3">Nama Pengguna</th>
                        <th class="border px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($usersPaginated)): ?>
                        <tr>
                            <td colspan="3" class="text-center text-gray-700 p-4 italic">Pengguna Tidak Ditemukan</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($usersPaginated as $user): ?>
                            <tr class="text-center text-gray-700 hover:bg-gray-100 transition">
                                <td class="border px-6 py-3"><?= htmlspecialchars($user['id']) ?></td>
                                <td class="border px-6 py-3"><?= htmlspecialchars($user['username']) ?></td>
                                <td class="border px-6 py-3 flex justify-center gap-2">
                                    <a href="<?= Config::BASE_URL . "/users/" . $user['id'] . "/edit" ?>"
                                        class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 text-xs">Edit</a>
                                    <form action="<?= Config::BASE_URL . "/users/" . $user['id'] ?>" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>

        <!-- Navigasi Halaman -->
        <div class="mt-6 flex justify-center gap-2">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>" class="px-3 py-1 border rounded-md bg-gray-200 hover:bg-gray-300">‹
                    Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>"
                    class="px-3 py-1 border rounded-md <?= ($i == $page) ? 'bg-[#508C9B] text-white' : 'bg-gray-200 hover:bg-gray-300' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>" class="px-3 py-1 border rounded-md bg-gray-200 hover:bg-gray-300">Next
                    ›</a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>