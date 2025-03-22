<?php
session_start();

// Jika ada parameter `confirm`, berarti user sudah konfirmasi logout
if (isset($_GET['confirm']) && $_GET['confirm'] == "yes") {
    session_destroy();
    header("Location: ../login.php"); // Redirect ke halaman login setelah logout
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                title: "Yakin ingin logout?",
                text: "Anda akan keluar dari sesi ini.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Ya, Logout!",
                cancelButtonText: "Batal",
                reverseButtons: true,
                backdrop: `rgba(0, 0, 0, 0.5)`,
                customClass: {
                    popup: "max-w-lg",
                    title: "text-xl font-bold text-gray-800",
                    htmlContainer: "text-lg text-gray-600",
                    actions: "flex gap-6 justify-center mt-4",
                    confirmButton: "bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg text-lg font-semibold transition-all",
                    cancelButton: "bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-lg text-lg font-semibold transition-all"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Berhasil Logout!",
                        text: "Anda akan diarahkan ke halaman login.",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                    setTimeout(() => {
                        window.location.href = "logout.php?confirm=yes"; 
                    }, 2000);
                } else {
                    window.location.href = "../participants/index.php";
                }
            });
        });
    </script>
</body>
</html>
