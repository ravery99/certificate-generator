
<div class="flex flex-col items-center justify-center min-h-screen px-4 text-center ">
    <div
        class="relative text-white text-4xl sm:text-5xl lg:text-6xl font-bold px-8 sm:px-10 py-5 sm:py-6 rounded-lg 
               bg-gradient-to-r from-blue-950 to-green-600 shadow-lg">
               <?= $data['title'] ?>
    </div>
    <h2 class="mt-6 text-xl sm:text-2xl lg:text-3xl font-extrabold bg-clip-text text-transparent 
               bg-gradient-to-r from-blue-950 to-green-600 leading-snug sm:leading-tight">
               <?= $data['desc'] ?>
    </h2>
</div>



        <!-- JavaScript -->
        <script>
    let originalForm = document.body.innerHTML; // Simpan form asli

    function showThankYou() {
        document.body.innerHTML = `
        <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-xl shadow-2xl overflow-hidden mx-auto mt-10">
            <div class="w-full md:w-1/2 bg-cover bg-center min-h-[300px] md:min-h-[450px]" style="background-image: url('gambar3.webp');"></div>
            <div class="w-full md:w-1/2 p-8 flex flex-col justify-center items-center">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-950 to-green-600 text-center whitespace-nowrap max-w-full mb-4">
                    TERIMA KASIH
                </h1>
                <p class="text-center text-lg sm:text-xl md:text-2xl text-gray-800 font-medium mb-6">
                    Terima kasih, Anda sudah mengisi formulir. Silakan cek email Anda untuk informasi lebih lanjut.
                </p>
                <button onclick="resetForm()" 
                    class="mt-4 px-6 py-3 bg-gradient-to-r from-green-600 to-blue-950 text-white rounded-md 
                    hover:opacity-90 transition duration-300 text-sm active:bg-green-300 active:text-green-900 font-bold">
                    Kirim Jawaban Lain
                </button>
            </div>
        </div>


        
    `;
    }

    function resetForm() {
        document.body.innerHTML = originalForm;
    }
</script>
