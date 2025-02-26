<div class="flex flex-col md:flex-row max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="w-full md:w-1/2 bg-cover bg-center h-40 md:h-auto" style="background-image: url('gambar3.webp');"></div>
    <div class="w-full md:w-1/2 p-6">
        <h1
            class="text-xl sm:text-2xl md:text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-950 to-green-600 whitespace-nowrap text-center mb-4">
            KUISIONER PARTISIPAN
        </h1>



        <p class="text-center text-sm text-gray-600 mb-4">
            Silakan isi formulir kuisioner di bawah ini untuk dapat mengunduh sertifikat Anda. Pastikan semua informasi
            diisi dengan benar.
        </p>
        <form class="flex flex-col" action="submit.php" method="POST">
            <label for="email" class="text-sm font-semibold">Email</label>
            <input type="email" id="email" name="email" placeholder="name@gmail.com" required
                class="w-full p-2 mt-1 mb-2 bg-green-50 text-green-800 rounded-md text-sm focus:ring-2 focus:ring-green-400 focus:outline-none"
                style="-webkit-box-shadow: 0 0 0px 1000px #ECFDF5 inset; -webkit-text-fill-color: #065F46;">

            <label for="phone" class="text-sm font-semibold">Nomor Telepon</label>
            <input type="text" id="phone" name="phone" placeholder="+62 82 8766 9888" required
                class="w-full p-2 mt-1 mb-2 bg-green-50 text-green-800 rounded-md text-sm focus:ring-2 focus:ring-green-400 focus:outline-none"
                style="-webkit-box-shadow: 0 0 0px 1000px #ECFDF5 inset; -webkit-text-fill-color: #065F46;">

            <label for="name" class="text-sm font-semibold">Nama</label>
            <input type="text" id="name" name="name" placeholder="Nama Anda" required
                class="w-full p-2 mt-1 mb-2 bg-green-50 text-green-800 rounded-md text-sm focus:ring-2 focus:ring-green-400 focus:outline-none"
                style="-webkit-box-shadow: 0 0 0px 1000px #ECFDF5 inset; -webkit-text-fill-color: #065F46;">

            <label for="training_date" class="text-sm font-semibold">Tanggal Training</label>
            <input type="date" id="training_date" name="training_date" required
                class="w-full p-2 mt-1 mb-2 bg-green-50 text-green-800 rounded-md text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">

            <label for="fasilitas" class="text-sm font-semibold">Fasilitas Kesehatan</label>
            <select id="fasilitas" name="fasilitas" required
                class="w-full p-2 mt-1 mb-2 bg-green-50 text-green-800 rounded-md text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">
                <option value="Klinik Cahaya Kasih">Klinik Cahaya Kasih</option>
                <option value="Klinik Dua Empat">Klinik Dua Empat</option>
                <option value="RSGM UNAIR">RSGM UNAIR</option>
                <option value="Ristra Clinic">Ristra Clinic</option>
            </select>

            <label for="divisi" class="text-sm font-semibold">Divisi</label>
            <select id="divisi" name="divisi" required
                class="w-full p-2 mt-1 mb-2 bg-green-50 text-green-800 rounded-md text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">
                <option value="Admisi">Admisi</option>
                <option value="Rawat Jalan">Rawat Jalan</option>
                <option value="Rawat Inap">Rawat Inap</option>
                <option value="Rawat Darurat">Rawat Darurat</option>
                <option value="Kecantikan">Kecantikan</option>
                <option value="Farmasi">Farmasi</option>
            </select>

            <button type="submit" class="w-full p-2 mt-3 bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-md 
                hover:opacity-90 transition duration-300 text-sm active:bg-green-300 active:text-green-900">
                Selanjutnya
            </button>
        </form>
    </div>
</div>