<!-- formnya panggil file /Views/partials/ -->

<h2>Tambah Fasilitas Baru</h2>

<?php 
    $action = "/facilities";
    $type = "Divisi";
    $name = "";
    $button_text = "Tambah";

    include __DIR__ . "../partials/dropdown_form.php";
?>