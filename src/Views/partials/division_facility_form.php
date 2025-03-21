<?php
use App\Config\Config;


$isFacility = isset($isFacility) && $isFacility;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : ($isFacility ? "Form Fasilitas" : "Form Divisi"); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex h-screen bg-gray-100">
    <!-- Konten utama -->
    <div class="flex flex-grow items-start justify-center px-12 mt-24 ml-64">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-lg border-l-8 border-green-800">
            <h2 class="text-3xl font-bold text-green-900 text-center mb-8">
                <?php echo isset($title) ? $title : ($isFacility ? "Form Fasilitas" : "Form Divisi"); ?>
            </h2>

            <form action=<?= $formAction ?> method="POST" class="space-y-8">



                <div class="flex flex-col">
                    <label
                        for="<?php echo isset($nameInput) ? $nameInput : ($isFacility ? "nama_fasilitas" : "nama_divisi"); ?>"
                        class="block text-green-900 font-semibold mb-3 text-lg">
                        <?php echo isset($nameInput) ? ucfirst(str_replace('_', ' ', $nameInput)) : ($isFacility ? "Nama Fasilitas" : "Nama Divisi"); ?>
                    </label>
                    <input type="text" id="name" name="name"
                        class="w-full max-w-md p-4 border border-green-800 rounded-md bg-green-100 
                                focus:ring-2 focus:ring-green-700 focus:outline-none  placeholder-green-700 placeholder-opacity-70"
                        placeholder="<?php echo $isFacility ? 'Masukkan nama fasilitas' : 'Masukkan nama divisi'; ?>"
                        value="<?= $name ?? '' ?>" required>

                </div>

                <button type="submit" name="submit" value="<?= isset($id) ? 'update' : 'create' ?>"
                    class="w-full py-3 bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-md 
                           hover:opacity-90 transition duration-300 text-lg active:bg-green-300 active:text-green-900 font-bold">
                    <?php echo isset($submitText) ? $submitText : "Simpan"; ?>
                </button>




            </form>
        </div>
    </div>

</body>

</html>