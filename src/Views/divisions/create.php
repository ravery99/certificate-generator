<!-- formnya panggil file /Views/partials/ -->

<h2>Tambah Divisi Baru</h2>

<?php 
    $action = "/divisions";
    $type = "Divisi";
    $name = "";
    $button_text = "Tambah";

    include __DIR__ . "../partials/dropdown_form.php";
?>