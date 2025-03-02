<!-- formnya panggil file /Views/partials/ -->

<h2>Edit Nama Divisi</h2>

<?php 
    $action = "/divisions/$id";
    $type = "Divisi";
    $name = $division_name;
    $button_text = "Edit";

    include __DIR__ . "../partials/dropdown_form.php";
?>