<div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-xl shadow-2xl overflow-hidden mx-auto">
    <div class="w-full md:w-1/2 bg-cover bg-center min-h-[300px] md:min-h-[450px]"
        style="background-image: url('gambar3.webp');"></div>
    <div class="w-full md:w-1/2 p-8 flex flex-col justify-center items-center">
        <h1
            class="text-2xl sm:text-3xl md:text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-950 to-green-600 text-center whitespace-nowrap max-w-full mb-4">
            TERIMA KASIH
        </h1>

        <p id="message" class="text-center text-lg sm:text-xl md:text-2xl text-gray-800 font-medium mb-6">
            Terima kasih, Anda sudah mengisi formulir. Silakan cek kembali data yang telah diisi sebelum mengirimkan.
        </p>

        <form id="form" class="flex flex-col w-full">
            <button type="button" id="backBtn"
                class="w-full p-4 text-lg sm:text-xl bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-lg hover:opacity-90 transition duration-300">
                Cek Kembali
            </button>
            <button type="button" id="submitBtn"
                class="w-full p-4 text-lg sm:text-xl bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-lg hover:opacity-90 transition duration-300 mt-4">
                Submit
            </button>
        </form>
    </div>
</div>

<script>
    document.getElementById("submitBtn").addEventListener("click", function () {
        document.getElementById("message").innerText = "Silakan unduh sertifikat Anda di link yang sudah dikirim melalui email.";
        document.getElementById("message").classList.add("text-xl", "sm:text-2xl", "font-semibold"); 
        document.getElementById("form").style.display = "none"; 
    });

    document.getElementById("backBtn").addEventListener("click", function () {
        history.back(); 
    });
</script>
