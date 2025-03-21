<?php use App\Config\Config; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuisioner Partisipan</title>

    <script>
        function validateAndShowModal() {
            let form = document.getElementById('kuisionerForm');
            if (form.checkValidity()) {
                document.getElementById('popup-modal').showModal(); // Buka modal jika valid
            } else {
                form.reportValidity(); // Tampilkan pesan error dari required
            }
        }

        function submitForm() {
            let form = document.getElementById('kuisionerForm');
            form.submit(); // Kirim form setelah konfirmasi di modal
        }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="flex flex-col md:flex-row max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="w-full md:w-1/2 bg-cover bg-center h-40 md:h-auto"
            style="background-image: url('/certificate-generator/src/Views/participants/gambar3.jpg');background-size: cover;">
        </div>

        <div class="w-full md:w-1/2 p-6">
            <h1 class="text-xl sm:text-2xl md:text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-950 to-green-600 text-center mb-4">
                KUISIONER PARTISIPAN
            </h1>

            <p class="text-center text-sm text-gray-600 mb-4">
                Silakan isi formulir kuisioner di bawah ini untuk dapat mengunduh sertifikat Anda. Pastikan semua informasi diisi dengan benar.
            </p>

            <form id="kuisionerForm" action="<?= Config::BASE_URL ?>/participants" method="POST" class="flex flex-col">

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
                <button type="button" class="w-full p-2 mt-3 bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-md 
                    hover:opacity-90 transition duration-300 text-sm active:bg-green-300 active:text-green-900 font-bold"
                    onclick="validateAndShowModal()">
                    Selanjutnya
                </button>
            </form>
        </div>
    </div>

    <!-- MODAL -->
    <dialog id="popup-modal"
        class="p-6 sm:p-8 rounded-lg shadow-lg max-w-[90%] sm:max-w-md md:max-w-lg w-full bg-white">
        <form method="dialog" class="relative">
            <div id="modal-content" class="text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 sm:w-14 md:w-16 h-12 sm:h-14 md:h-16" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-sm sm:text-base md:text-lg font-normal text-gray-700">
                    Apakah data yang Anda isi sudah benar?
                </h3>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button"
                        class="flex-1 border-2 border-red-700 text-red-700 bg-white rounded-md hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-400 font-medium text-sm sm:text-base px-5 py-2.5 sm:px-6 sm:py-3"
                        onclick="document.getElementById('popup-modal').close()">
                        Tidak, Perbaiki
                    </button>
                    <button type="button" onclick="submitForm()"
                        class="flex-1 bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-md hover:bg-green-800 focus:outline-none focus:ring-0 font-medium text-sm sm:text-base px-5 py-2.5 sm:px-6 sm:py-3">
                        Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </form>
    </dialog>

</body>
</html>
