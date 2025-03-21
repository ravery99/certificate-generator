<!-- Form buat create/edit user -->
<!-- file ini dipanggil di create.php dan edit.php pada folder /Views/users -->
<!-- jadi nanti di kedua file itu, tinggal kirim variabel2 yg dibutuhin -->

<!-- coba liat dropdown_form.php -->

<?php use App\Config\Config; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex h-screen bg-gradient-to-br from-gray-100 to-gray-300">
    <!-- Konten utama -->
    <div class="flex-1 flex items-center justify-center p-6">
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-200">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6"> <?php echo $formTitle; ?> </h2>
            <form action=<?= $formAction ?> method="POST" class="space-y-6">

                <!-- Hidden input untuk ID (hanya ada saat edit) -->
                <?php if (isset($id)): ?>
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <?php endif; ?>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Nama Pengguna</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($username ?? '') ?>" required
                        class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" <?= isset($id) ? '' : 'required' ?>
                        class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="confirm_password" <?= isset($id) ? '' : 'required' ?>
                        class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <button type="submit" name="action" value="<?= isset($id) ? 'update' : 'create' ?>" class="w-full py-3 bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-md 
               hover:opacity-90 transition duration-300 text-lg active:bg-green-300 active:text-green-900 font-bold">
                    <?= isset($id) ? "Update User" : "Tambah User" ?>
                </button>
            </form>

        </div>
    </div>

</body>

</html>